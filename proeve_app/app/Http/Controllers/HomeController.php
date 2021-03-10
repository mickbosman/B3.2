<?php

namespace App\Http\Controllers;

use App\Models\Client;

class HomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if(auth()->user()->controlling !== null) {
            $client = Client::find(auth()->user()->controlling);
            if($client !== null) { // Check if client actualy exists
                if($client->user_id == auth()->id()) return view('client_calander', ['client' => $client]); // Check if client belongs to user
            }
            auth()->user()->controlling = null; // If check fail reset the controlling client
            auth()->user()->save();
        }

        return view('home');
    }
}
