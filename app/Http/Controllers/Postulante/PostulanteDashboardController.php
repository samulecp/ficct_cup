<?php
namespace App\Http\Controllers\Postulante;

use App\Http\Controllers\Controller;

class PostulanteDashboardController extends Controller
{
    public function index()
    {
        return view('postulante.dashboard');
    }
}