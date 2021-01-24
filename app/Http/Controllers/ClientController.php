<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function store(CreateClientRequest $request){
        $request->validated();
        $vals = $request->all();
        $vals['user_id'] = Auth::id();
        Client::create(
            $vals
        );
        return Redirect::route('dashboard', ['clients'=>Client::where('user_id', Auth::id())->get()]);
    }

    public function index(){

        $clients = Client::where('user_id', Auth::id())->get();
        return Inertia::render('Dashboard', ['clients'=> $clients]);

    }
}
