<?php
namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;

class OperadorDashboardController extends Controller
{
    public function index()
    {
        return view('operador.dashboard');
    }
}