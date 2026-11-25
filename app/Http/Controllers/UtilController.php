<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//controller criado com: php artisan make:controller UtilController
class UtilController extends Controller
{
    //página inicial (chamada pela rota '/')
    public function loadHomepage() {

        //devolve a view resources/views/home.blade.php
        return view('home');
    }

    //página de erro quando a rota não existe (chamada pelo Route::fallback)
    public function pageNotFound() {

        //devolve a view resources/views/fallback.blade.php
        return view('fallback');
    }
}
