<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class FilmController extends Controller
{
    public function listFilms()
    {
        $title = "Listado de todas las pelis";
        $films = Film::all();
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function listOldFilms($year = 2000)
    {
        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $old_films = Film::where('year', '<', $year)->get();
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }

    public function listNewFilms($year = 2000)
    {
        $title = "Listado de Pelis Nuevas (Después de $year)";
        $new_films = Film::where('year', '>=', $year)->get();
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    public function listFilmsByYear($year = null)
    {
        $title = "Listado de películas por año";
        if ($year) {
            $films = Film::where('year', $year)->get();
            $title = "Listado de películas del año $year";
        } else {
            $films = Film::all();
        }
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function listFilmsByGenre($genre = null)
    {
        $title = "Listado de películas por género";
        if ($genre) {
            $films = Film::where('genre', 'LIKE', '%' . $genre . '%')->get();
            $title = "Listado de películas del género: $genre";
        } else {
            $films = Film::all();
        }
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function listFilmsByYearDescending()
    {
        $title = "Listado de todas las pelis de más nuevas a más viejas";
        $films = Film::orderBy('year', 'desc')->get();
        return view("films.list", ["films" => $films, "title" => $title]);
    }

    public function countFilms()
    {
        $totalFilms = Film::count();
        $title = "Contador de Películas";
        return view('films.count', ['totalFilms' => $totalFilms, 'title' => $title]);
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
        ]);

        try {
            Film::create($validatedData);
            Log::info('Película añadida correctamente en la base de datos.');
            return redirect('/filmout/films')->with('success', 'Película añadida correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al añadir la película: ' . $e->getMessage());
            return redirect('/')->with('error', 'Error al añadir la película: ' . $e->getMessage());
        }
    }

    public function editFilm($id)
    {
        $film = Film::findOrFail($id);
        return view('films.edit', ['film' => $film]);
    }

    public function updateFilm(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'year' => 'required|integer|min:1900|max:2024',
                'genre' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'duration' => 'required|integer|min:1|max:500',
                'img_url' => 'required|url|max:65535',
            ]);

            $film = Film::findOrFail($id);
            $film->update($validatedData);

            Log::info('Película actualizada correctamente.');
            return redirect()->route('listFilms')->with('success', 'Película actualizada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar la película: ' . $e->getMessage());
            return redirect()->route('listFilms')->with('error', 'Error al actualizar la película: ' . $e->getMessage());
        }
    }

    public function deleteFilm($id)
    {
        try {
            $film = Film::findOrFail($id);
            $film->delete();
            Log::info("Película con ID $id eliminada.");
            return redirect()->route('listFilms')->with('success', 'Película eliminada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar la película: ' . $e->getMessage());
            return redirect()->route('listFilms')->with('error', 'Error al eliminar la película: ' . $e->getMessage());
        }
    }

    public function getFilmsWithActors(): JsonResponse
    {
        try {
            $films = Film::with('actors')->get();
            return response()->json($films, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener películas: ' . $e->getMessage()], 500);
        }
    }

    public function showCreateForm()
{
    return view('films.create');
}

}
