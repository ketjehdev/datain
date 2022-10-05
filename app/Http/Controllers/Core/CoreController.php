<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoreController extends Controller
{
    // tampilan dashboard
    public function dashboard()
    {
        return view('core.dashboard');
    }
}
