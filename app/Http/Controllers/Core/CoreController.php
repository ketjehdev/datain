<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CoreController extends Controller
{
    // tampilan dashboard
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'total_user' => User::count(),
            'users' => User::all(),
        ];
        return view('core.dashboard', $data);
    }
}
