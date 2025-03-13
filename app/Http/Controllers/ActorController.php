<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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
}