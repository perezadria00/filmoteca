<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ActorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidateUrl;


Route::get('/', function () {
    return view('welcome');
});



Route::middleware('year')->group(function () {
    Route::prefix('filmout')->group(function () {
        // Rutas con el prefijo "filmout"
        Route::get('filmMenu', function () {
            return view('films.filmMenu');
        });
        Route::get('oldFilms/{year?}', [FilmController::class, 'listOldFilms'])->name('oldFilms');
        Route::get('newFilms/{year?}', [FilmController::class, 'listNewFilms'])->name('newFilms');
        Route::get('films', [FilmController::class, 'listFilms'])->name('listFilms');

        Route::get('listFilmsByYear/{year?}', [FilmController::class, 'listFilmsByYear']);
        Route::get('listFilmsByGenre/{genre?}', [FilmController::class, 'listFilmsByGenre']);
        Route::get('sortFilms', [FilmController::class, 'listFilmsByYearDescending']);
        Route::get('countFilms', [FilmController::class, 'countFilms']);
        Route::get('edit/{id}', [FilmController::class, 'editFilm'])->name('editFilm');
        Route::put('update/{id}', [FilmController::class, 'updateFilm'])->name('updateFilm');
        Route::delete('delete/{id}', [FilmController::class, 'deleteFilm'])->name('deleteFilm');
    });
});


Route::prefix('filmin')->middleware('ValidateUrl')->group(function () {
    Route::get('/create', [FilmController::class, 'showCreateForm'])->name('showCreateFilmForm');
    Route::post('/create', [FilmController::class, 'createFilm'])->name('createFilm');
});


Route::middleware('year')->group(function () {
    Route::prefix('actorout')->group(function () {
        Route::get('actorMenu', function () {
            return view('actors.actorMenu');
        });
        Route::get('actorDecadeFilter', function () {
            return view('actors.actorDecadeFilter');
        });
        Route::get('actors', [ActorController::class, 'listActors'])->name('listActors');
        Route::get('listActorsByDecade', [ActorController::class, 'listActorsByDecade'])->name('listActorsByDecade');
        Route::get('countActors', [ActorController::class, 'countActors'])->name('countActors');
    });
});

Route::delete('/actors/{id}', [ActorController::class, 'destroy']);

Route::prefix('api')->group(function () {
    Route::get('/films-with-actors', [FilmController::class, 'getFilmsWithActors'])->name('api.films');
});