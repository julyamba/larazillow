<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {   
        // dd(Auth::check());
        return Inertia::render('Index/Index',[
            'message' => 'Dashboard'
        ]);
    }

    public function hello()
    {
        return Inertia::render('Index/Show',[
            'message' => 'Hello'
        ]);
    }
}
