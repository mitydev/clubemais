<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BannersController;
use App\Http\Controllers\BeneficiosController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FooterSettingsController;
use App\Http\Controllers\OqueEController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageSectionController;
use App\Http\Controllers\PageShowController;
use App\Http\Controllers\ParceirosController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function (){
    Route::get('/', function () {
        if(auth()->user()->hasRole("admin")){
            return view('admin.painel');
        }
        return response()->redirectToRoute('home');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('pages', PageController::class);              
    Route::resource('pages.sections', PageSectionController::class);
    Route::get ('banners/groups',                 [BannerController::class, 'groupsIndex'])->name('banners.groups');
    Route::get ('banners/groups/{group}',         [BannerController::class, 'groupsEdit'])->name('banners.groups.edit');
    Route::post('banners/groups/{group}/bulk',    [BannerController::class, 'groupsBulk'])->name('banners.groups.bulk');
    Route::post('banners/groups/{group}/upload',  [BannerController::class, 'groupsUpload'])->name('banners.groups.upload');     
    Route::resource('banners', BannerController::class);


    Route::post   ('pages/{page}/sections',                [PageSectionController::class, 'store' ])->name('page_sections.store');
    Route::put    ('pages/{page}/sections/{section}',      [PageSectionController::class, 'update'])->name('page_sections.update');
    Route::delete ('pages/{page}/sections/{section}',      [PageSectionController::class, 'destroy'])->name('page_sections.destroy');

    
    Route::get ('destinos/groups',                 [DestinationController::class, 'groupsIndex'])->name('destinos.groups');
    Route::get ('destinos/groups/{group}',         [DestinationController::class, 'groupsEdit'])->name('destinos.groups.edit');
    Route::post('destinos/groups/{group}/bulk',    [DestinationController::class, 'groupsBulk'])->name('destinos.groups.bulk');
    Route::post('destinos/groups/{group}/upload',  [DestinationController::class, 'groupsUpload'])->name('destinos.groups.upload');

    Route::resource('destinos', DestinationController::class);

    Route::get('/settings/footer', [FooterSettingsController::class, 'edit'])->name('admin.footer.edit');
    Route::put('/settings/footer', [FooterSettingsController::class, 'update'])->name('admin.footer.update');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/o-que-e', [OqueEController::class, 'OqueE'])->name('o-que-e');

Route::get('/beneficios', [BeneficiosController::class, 'show'])->name('beneficios');

// Route::get('/beneficios', function () {
//     return view('beneficios');
// })->name("beneficios");

Route::get('/parceiros', [ParceirosController::class, 'show'])->name('parceiros');

// Route::get('/parceiros', function () {
//     return view('parceiros');
// })->name('parceiros');

Route::post('/ajax/get-taxonomy-slug', [LocalController::class, 'slugById'])
    ->name('ajax.taxonomy.slug');


Route::get('/local/{term:slug}', [LocalController::class, 'byTerm'])
    ->name('local.byTerm');


Route::get('/hotel/{local:slug}', [LocalController::class, 'show'])
    ->name('hotel.show');

Route::get('{slug}', PageShowController::class)
  ->where('slug', '^(?!admin|dashboard|login|logout|register|password.*|api/.*).*$')
  ->name('site.page');

require __DIR__.'/auth.php';
