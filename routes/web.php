<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrashController;

//rota de homepage
Route::get('/', [UtilController::class, 'loadHomepage'])->name('home');

//rota de todos os países
Route::get('/destinations', [CountryController::class, 'allCountries'])->name('countries.all');

//rota das cidades de um país
Route::get('/destinations/{id}', [CityController::class, 'citiesByCountry'])->name('cities.country');


//rotas dos países (protegidas, só para users autenticados)
//rota de apagar países
Route::get('/delete-countries/{id}', [CountryController::class, 'deleteCountries'])->name('countries.delete')->middleware('auth');

//rota para adicionar países
Route::get('/add-countries', [CountryController::class, 'addCountries'])->name('countries.add')->middleware('auth');

//rota para guardar países
Route::post('/store-countries', [CountryController::class, 'storeCountry'])->name('countries.store')->middleware('auth');

//rota para ver / editar países
Route::get('/edit-countries/{id}', [CountryController::class, 'editCountries'])->name('countries.edit')->middleware('auth');

//rota de actualizar países
Route::put('/update-countries', [CountryController::class, 'updateCountry'])->name('countries.update')->middleware('auth');


//rotas das cidades (protegidas, só para users autenticados)
//rota de apagar cidades
Route::get('/delete-cities/{id}', [CityController::class, 'deleteCities'])->name('cities.delete')->middleware('auth');

//rota para adicionar cidades
Route::get('/add-cities/{id}', [CityController::class, 'addCities'])->name('cities.add')->middleware('auth');

//rota para guardar cidades
Route::post('/store-cities', [CityController::class, 'storeCity'])->name('cities.store')->middleware('auth');

//rota para ver / editar cidades
Route::get('/edit-cities/{id}', [CityController::class, 'editCities'])->name('cities.edit')->middleware('auth');

//rota de actualizar cidades
Route::put('/update-cities', [CityController::class, 'updateCity'])->name('cities.update')->middleware('auth');


//rota do dashboard (só para users autenticados)
Route::get('/dashboard', [DashboardController::class, 'loadDashboard'])->name('dashboard')->middleware('auth');

//rotas da lixeira (protegidas, só para users autenticados)
//rota da página lixeira
Route::get('/trash', [TrashController::class, 'allTrash'])->name('trash.all')->middleware('auth');

//rota de restaurar países
Route::get('/restore-countries/{id}', [TrashController::class, 'restoreCountry'])->name('countries.restore')->middleware('auth');

//rota de restaurar cidades
Route::get('/restore-cities/{id}', [TrashController::class, 'restoreCity'])->name('cities.restore')->middleware('auth');


//rota de fallback (quando a página não existe)
Route::fallback([UtilController::class, 'pageNotFound']);
