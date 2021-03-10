<?php

namespace App\Http\Controllers;

use App\Models\Client;

class ClientController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function control_client(Client $client) {
        if($client->user_id !== auth()->id()) abort(401);

        auth()->user()->controlling = $client->user_id;
        auth()->user()->save();

        return redirect('/home');
    }
}
