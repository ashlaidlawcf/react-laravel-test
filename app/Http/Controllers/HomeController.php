<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends AuthController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'name' => $this->user->name
        ]);
    }
}
