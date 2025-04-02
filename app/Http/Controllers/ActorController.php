<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ActorController extends Controller
{
    /**
     * Obtiene todos los actores desde la base de datos usando Eloquent.
     *
     * @return \Illuminate\Support\Collection
     */
    public function readActors()
    {
        return Actor::all();
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

    /**
     * Lista actores por década.
     *
     * @return \Illuminate\View\View
     */
    public function listActorsByDecade(Request $request): View
    {
        $title = "Listado de actores por década";

        $validatedData = $request->validate([
            'decades' => 'required|integer',
        ]);

        $decade = $validatedData['decades'];
        $startYear = $decade;
        $endYear = $decade + 9;

        $actors = Actor::whereYear('birthdate', '>=', $startYear)
            ->whereYear('birthdate', '<=', $endYear)
            ->get();

        return view('actors.list', [
            'actors' => $actors,
            'title' => $title,
        ]);
    }

    /**
     * Cuenta el total de actores en la base de datos.
     */
    public function countActors()
    {
        $totalActors = Actor::count();
        $title = "Contador de Actores";

        return view('actors.count', ['totalActors' => $totalActors, 'title' => $title]);
    }

    /**
     * Elimina un actor por ID usando Eloquent.
     */
    public function destroy($id)
    {
        try {
            $actor = Actor::findOrFail($id);
            $actor->delete();

            return response()->json([
                'action' => 'delete',
                'status' => true,
                'message' => 'Actor eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'action' => 'delete',
                'status' => false,
                'message' => 'Error al eliminar el actor: ' . $e->getMessage()
            ], 500);
        }
    }
}
