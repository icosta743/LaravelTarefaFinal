<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
    //página inicial
    public function loadHomepage() {

        return view('home');
    }

    //página de erro quando a rota não existe
    public function pageNotFound() {

        return view('fallback');
    }
}
