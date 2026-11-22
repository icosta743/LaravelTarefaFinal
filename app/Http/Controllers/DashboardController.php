<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //página do dashboard (só para users autenticados)
    public function loadDashboard() {

        return view('backoffice.dashboard');
    }
}
