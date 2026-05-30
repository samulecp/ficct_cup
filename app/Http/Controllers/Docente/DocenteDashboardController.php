<?php
namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;

class DocenteDashboardController extends Controller
{
    public function index()
    {
        return view('docente.dashboard');
    }
}