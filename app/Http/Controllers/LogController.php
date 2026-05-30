<?php

namespace App\Http\Controllers;

use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::with('user')
    ->latest()
    ->paginate(20);

        return view(
            'admin.logs.index',
            compact('logs')
        );
    }
}