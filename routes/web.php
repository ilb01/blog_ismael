<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/hello/{name}/{apellido}/{cole}/{curso}', function ($name, $apellido, $cole, $curso) {
    return '<h1>Hola, bienvenido!</h1>
            <ul>
                <li><strong>Nombre:</strong> ' . $name . '</li>
                <li><strong>Apellido:</strong> ' . $apellido . '</li>
                <li><strong>Colegio:</strong> ' . $cole . '</li>
                <li><strong>Curso:</strong> ' . $curso . '</li>
            </ul>';
});

Route::get('/ourselves', function () {

    })->name('ourselves');

Route::get('/hello/{name}', function($name) {
    return "Hello ".$name;
    })->name('greeting');

Route::get('/testing', function () {
    return route('ourselves');
    });

Route::get('/Profile/{id}', function ($id) {
    return "Profile # <a href='".route('greeting', ['name'=>'Toni'])."' >greeting</a>".$id;
    });

Route::get('/hello/{name}', function ($name) {
    return 'hello '.$name;
    })->where('name', '[A-Za-z]+');

Route::get('/hello/{name}', function ($name) {
    return 'hello '.$name;
    })->whereAlpha('name');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
