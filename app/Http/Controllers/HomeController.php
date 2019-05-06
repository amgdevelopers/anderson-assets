<?php

namespace App\Http\Controllers;

use App\Client;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::with('assets')->get();
        
        $data = [
            'clients' => $clients,
        ];
        
        return view('home')->with($data);
    }
}
