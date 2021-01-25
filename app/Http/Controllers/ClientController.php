<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Models\Client;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
        /** @var Collection $clients */
        $clients = Client::where('user_id', Auth::id())->with(['tasks.times' => function($q){
            return $q->orderBy('start_time', 'created_at');
        }])->get();

        // Sort the clients so the latest updated client shows up first.
        $clients->sort(function ($a, $b){
            $aLatest = $a->tasks->max(function ($t){
                return strtotime($t->times->first()->start_date ?? $t->times->first()->created_at);
            });
            $bLatest = $b->tasks->max(function ($t){
                return strtotime($t->times->first()->start_date ?? $t->times->first()->created_at);
            });
            return $aLatest - $bLatest;
        });
        return Inertia::render('Dashboard', ['clients'=> $clients]);
    }


    public function view(Request $request, $id){
        $client = Client::where('id', $id)->where('user_id', Auth::id())->with(['tasks.times' => function($q){
            return $q->orderBy('start_time', 'created_at');
        }])->first();
        if (count($client->tasks) == 0){
            return Inertia::render('ClientWizard', compact('client'));
        }
        return Inertia::render('Client', compact('client'));
    }
}
