<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Obtiene todos los actores desde la base de datos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function readActors()
    {
        return DB::table('actors')->get();
    }

    /**
     * Muestra la lista de actores.
     *
     * @return \Illuminate\View\View
     */
    public function listActors(): View
    {
        $title = "Listado de todos los actores";
        $actors = $this->readActors();

        return view('actors.list', [
            'actors' => $actors,
            'title' => $title,
        ]);
    }

    public function listActorsByDecade(Request $request): View
    {
        $title = "Listado de actores por década";

        // Validar la década seleccionada
        $validatedData = $request->validate([
            'decades' => 'required|integer',
        ]);

        $decade = $validatedData['decades'];

        // Calcular el rango de años para la década seleccionada
        $startYear = $decade;
        $endYear = $decade + 9;

        // Filtrar actores por década
        $actors = DB::table('actors')
            ->whereYear('birthdate', '>=', $startYear)
            ->whereYear('birthdate', '<=', $endYear)
            ->get();

        return view('actors.list', [
            'actors' => $actors,
            'title' => $title,
        ]);
    }

    public function countActors()
    {

        $totalActors = DB::table('actors')->count();



        $title = "Contador de Películas";


        return view('actors.count', ['totalActors' => $totalActors, 'title' => $title]);
    }

public function destroy($id)
{
    try {
        $actor = DB::table('actors')->where('id', $id)->first();

        if (!$actor) {
            return response()->json([
                'action' => 'delete',
                'status' => false,
                'message' => 'Actor no encontrado'
            ], 404);
        }

        DB::table('actors')->where('id', $id)->delete();

        return response()->json([
            'action' => 'delete',
            'status' => true,
            'message' => 'Actor eliminado correctamente'
        ], 200);
    } catch (\Exception $e) {

        return response()->json([
            'action' => 'delete',
            'status' => false,
            'message' => 'Error al eliminar el actor'
        ], 500);
    }
}

}
