<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;




class FilmController extends Controller
{

    public static function readFilms(): array
    {
        $db_films = DB::table('films')->get()->map(function ($film) {
            return (array) $film;
        })->toArray();
    
        $json_films = json_decode(Storage::get('public/films.json'), true);
    
        // Asegurar que cada película en el JSON tenga un ID
        foreach ($json_films as &$film) {
            if (!isset($film['id']) || empty($film['id'])) {
                $film['id'] = uniqid();
            }
        }
    
        $combined_films = array_merge($db_films, $json_films);
    
        return $combined_films;
    }
    

    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function listFilmsByYear($year = null)
    {

        $films_filtered = [];

        $title = "Listado de películas por año";
        $films = FilmController::readFilms();

        if (is_null($year))
            return view('films.list', ["films" => $films, "title" => $title]);

        foreach ($films as $film) {
            if ((!is_null($year) && $film['year'] == $year)) {
                $title = "Listado de todas las pelis filtrado por año: $year";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }


    public function listFilmsByGenre($genre = null)
    {

        $films_filtered = [];

        $title = "Listado de películas por género";
        $films = FilmController::readFilms();

        if (is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        foreach ($films as $film) {
            if (($film['genre'] == $genre)) {
                $title = "Listado de todas las pelis filtrado por género: $genre";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }


    public function listFilmsByYearDescending()
    {


        $title = "Listado de todas las pelis de más nuevas a más viejas";
        $films = FilmController::readFilms();
        $films = collect($films);
        $sorted = [];
        $sorted = $films->sortBy([
            ['year', 'desc']
        ]);

        return view("films.list", ["films" => $sorted, "title" => $title]);
    }

    public function countFilms()
    {

        $films = self::readFilms();


        $totalFilms = count($films);


        $title = "Contador de Películas";


        return view('films.count', ['totalFilms' => $totalFilms, 'title' => $title]);
    }


    public function createFilm(Request $request)
    {
        // Validar los datos del formulario (sin 'id')
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2024',
            'genre' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'duration' => 'required|integer|min:1|max:500',
            'img_url' => 'required|url|max:65535',
            'options' => 'required|in:db,json',
        ], [
            'img_url.required' => 'La URL de la imagen es obligatoria.',
            'img_url.url' => 'La URL de la imagen no es válida. Asegúrate de incluir "http://" o "https://".',
        ]);

        // Verificar si la película ya existe
        if ($this->isFilm($validatedData['name'])) {
            Log::error('La película ya existe.');
            return redirect('/')->with('error', 'La película ya existe.');
        }

        try {
            // Generar ID único
            $filmData = [
                'id' => uniqid(),  // Se genera el ID aquí
                'name' => $validatedData['name'],
                'year' => $validatedData['year'],
                'genre' => $validatedData['genre'],
                'country' => $validatedData['country'],
                'duration' => $validatedData['duration'],
                'img_url' => $validatedData['img_url'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insertar en la base de datos o en el archivo JSON
            if ($validatedData['options'] === 'db') {
                DB::table('films')->insert($filmData);
                Log::info('Película añadida correctamente en la base de datos.');
                return redirect('/filmout/films')->with('success', 'Película añadida correctamente en la base de datos.');
            } elseif ($validatedData['options'] === 'json') {
                $this->insertFilmIntoJson($filmData);
                Log::info('Película añadida correctamente en el archivo JSON.');
                return redirect('/filmout/films')->with('success', 'Película añadida correctamente en el archivo JSON.');
            }
        } catch (\Exception $e) {
            Log::error('Error al añadir la película: ' . $e->getMessage());
            return redirect('/')->with('error', 'Hubo un problema al añadir la película: ' . $e->getMessage());
        }
    }

    /**
     * Verifica si una película ya existe en la base de datos.
     */
    private function isFilm($name)
    {
        return DB::table('films')->where('name', $name)->exists();
    }

    private function insertFilmIntoJson($filmData)
    {
        // Ruta del archivo JSON en el directorio de almacenamiento
        $filePath = storage_path('app/public/films.json');
    
        // Asegurar que la película tiene un 'id'
        if (!isset($filmData['id'])) {
            $filmData['id'] = uniqid();
        }
    
        // Leer el contenido actual del archivo JSON
        if (file_exists($filePath)) {
            $existingData = json_decode(file_get_contents($filePath), true);
        } else {
            $existingData = [];
        }
    
        // Agregar los nuevos datos al array existente
        $existingData[] = $filmData;
    
        // Guardar el array actualizado en el archivo JSON
        file_put_contents($filePath, json_encode($existingData, JSON_PRETTY_PRINT));
    }
    


    public function editFilm($id)
    {
        // Busca la película por ID
        $film = Film::findOrFail($id);

        return view('films.edit', ['film' => $film]);
    }

    public function updateFilm(Request $request, $id)
    {
        try {

            // Validación de datos
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'year' => 'required|integer|min:1900|max:2024',
                'genre' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'duration' => 'required|integer|min:1|max:500',
                'img_url' => 'required|url|max:65535',
            ], [
                'img_url.required' => 'La URL de la imagen es obligatoria.',
                'img_url.url' => 'La URL de la imagen no es válida. Asegúrate de incluir "http://" o "https://".',

            ]);

            // Busca la película por ID y actualiza sus datos
            $film = Film::findOrFail($id);

            $film->update([
                'name' => $validatedData['name'],
                'year' => $validatedData['year'],
                'genre' => $validatedData['genre'],
                'country' => $validatedData['country'],
                'duration' => $validatedData['duration'],
                'img_url' => $validatedData['img_url'],
            ]);

            Log::info('Película actualizada correctamente.');
            return redirect()->route('listFilms')->with('success', 'Película actualizada correctamente.');
        } catch (\Exception $e) {
            Log::error('La película no se pudo actualizar.');
            return redirect()->route('listFilms')->with('error', 'Hubo un problema al eliminar la película: ' . $e->getMessage());
        }
    }

    public function deleteFilm($id)
    {
        try {
            $film = Film::find($id);
    
            if ($film) {
                $film->delete();
                Log::info("Película con ID $id eliminada de la base de datos.");
            } else {

                if ($this->deleteFilmFromJson($id)) {
                    Log::info("Película con ID $id eliminada del archivo JSON.");
                } else {
                    Log::warning("No se encontró la película con ID $id en la base de datos ni en el JSON.");
                    return redirect()->route('listFilms')->with('error', 'La película no se encontró.');
                }
            }
    
            return redirect()->route('listFilms')->with('success', 'Película eliminada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar la película: ' . $e->getMessage());
            return redirect()->route('listFilms')->with('error', 'Hubo un problema al eliminar la película: ' . $e->getMessage());
        }
    }
    private function deleteFilmFromJson($id)
    {
        $filePath = storage_path('app/public/films.json');
    
        if (!file_exists($filePath)) {
            return false;
        }
    
        $films = json_decode(file_get_contents($filePath), true);
    
        $filteredFilms = array_filter($films, function ($film) use ($id) {
            return isset($film['id']) && $film['id'] !== $id;
        });
    
        if (count($films) === count($filteredFilms)) {
            return false;
        }
    
        file_put_contents($filePath, json_encode(array_values($filteredFilms), JSON_PRETTY_PRINT));
    
        return true;
    }
        
    public function showCreateForm()
    {

        return view('films.create');
    }
}
