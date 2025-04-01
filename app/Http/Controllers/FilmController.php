<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function readFilms()
    {
        // Obtener películas desde la base de datos utilizando Eloquent
        $db_films = Film::all()->toArray();

        // Leer películas desde el archivo JSON
        $filePath = storage_path('app/public/films.json');

        if (file_exists($filePath)) {
            $json_films = json_decode(file_get_contents($filePath), true);

            // Verificar si el archivo JSON está correctamente estructurado
            if (is_array($json_films)) {
                foreach ($json_films as &$film) {
                    if (!isset($film['id']) || empty($film['id'])) {
                        $film['id'] = uniqid();
                    }
                }
            } else {
                $json_films = [];
                Log::warning("El archivo JSON está vacío o mal estructurado.");
            }
        } else {
            $json_films = [];
            Log::warning("El archivo JSON no existe: $filePath");
        }

        // Combinar resultados evitando duplicados
        $combined_films = collect($db_films)->merge(collect($json_films)->unique('id'))->toArray();

        return $combined_films;
    }

    public function listFilms()
    {
        $title = "Listado de todas las pelis";
        $films = $this->readFilms();
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function createFilm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2024',
            'genre' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'duration' => 'required|integer|min:1|max:500',
            'img_url' => 'required|url|max:65535',
            'options' => 'required|in:db,json',
        ]);

        try {
            if ($validatedData['options'] === 'db') {
                Film::create($validatedData);
                Log::info('Película añadida correctamente en la base de datos.');
            } elseif ($validatedData['options'] === 'json') {
                $this->insertFilmIntoJson($validatedData);
                Log::info('Película añadida correctamente en el archivo JSON.');
            }
            return redirect('/filmout/films')->with('success', 'Película añadida correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al añadir la película: ' . $e->getMessage());
            return redirect('/')->with('error', 'Hubo un problema al añadir la película: ' . $e->getMessage());
        }
    }

    private function insertFilmIntoJson($filmData)
    {
        $filePath = storage_path('app/public/films.json');
        $filmData['id'] = uniqid();

        $existingData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];
        $existingData[] = $filmData;

        file_put_contents($filePath, json_encode($existingData, JSON_PRETTY_PRINT));
    }

    public function deleteFilm($id)
    {
        try {
            $film = Film::findOrFail($id);
            $film->delete();
            Log::info("Película con ID $id eliminada de la base de datos.");
            return redirect()->route('listFilms')->with('success', 'Película eliminada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar la película: ' . $e->getMessage());
            return redirect()->route('listFilms')->with('error', 'Hubo un problema al eliminar la película: ' . $e->getMessage());
        }
    }
}
