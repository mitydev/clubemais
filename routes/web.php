<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    if(auth()->user()->hasRole("admin")){
        return view('dashboard');
    }
    return response()->redirectToRoute('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/o-que-e', function () {
    $heroTitle = 'O programa';

    // Cole aqui o SEU texto grandão
    $heroText = <<<TXT
    Optaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae que nonecul luptionempos a nossi sum autaers pictori buscium laborest, ut volorenim illuptu repudaeris repernatur sum coratem porrum quam nisquat urestrunt et verepe quaessint occatis ma cuOptaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae que nonecul luptionempos a nossi sum autaers pictori buscium laborest, ut volorenim illuptu repudaeris repernatur sum coratem porrum quam nisquat urestrunt et verepe quaessint occatis ma casert. Optaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae .
    TXT;

    return view('o-que-e', compact('heroTitle','heroText'));
})->name("o-que-e");

Route::get('/beneficios', function () {
    return view('beneficios');
})->name("beneficios");

Route::get('/parceiros', function () {
    return view('parceiros');
})->name('parceiros');

// Ajax: ID -> slug de Term
Route::post('/ajax/get-taxonomy-slug', [LocalController::class, 'slugById'])
    ->name('ajax.taxonomy.slug');

// LISTAGEM por TERMO (é essa rota que seu JS carrega no #search-results-container)
Route::get('/local/{term:slug}', [LocalController::class, 'byTerm'])
    ->name('local.byTerm');

// DETALHE de um hotel/local (opcional)
Route::get('/hotel/{local:slug}', [LocalController::class, 'show'])
    ->name('hotel.show');

require __DIR__.'/auth.php';
