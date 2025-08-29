<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/beneficios', function () {
    $heroTitle = 'O programa';

    // Cole aqui o SEU texto grandão
    $heroText = <<<TXT
Optaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae que nonecul luptionempos a nossi sum autaers pictori buscium laborest, ut volorenim illuptu repudaeris repernatur sum coratem porrum quam nisquat urestrunt et verepe quaessint occatis ma cuOptaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae que nonecul luptionempos a nossi sum autaers pictori buscium laborest, ut volorenim illuptu repudaeris repernatur sum coratem porrum quam nisquat urestrunt et verepe quaessint occatis ma casert. Optaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae .
TXT;

    return view('beneficios', compact('heroTitle','heroText'));
})->name("beneficios");

require __DIR__.'/auth.php';
