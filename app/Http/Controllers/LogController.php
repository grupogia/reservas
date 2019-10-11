<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logView()
    {
        if (!auth()->user()->can('index.log'))
        abort(401);

        return view('seguimiento.index');
    }
}
