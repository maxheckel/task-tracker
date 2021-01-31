<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\GetBilledRequest;
use App\Models\Client;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function store(CreateClientRequest $request)
    {
        $request->validated();
        $vals = $request->all();
        $vals['user_id'] = Auth::id();
        Client::create(
            $vals
        );
        return Redirect::route('dashboard', ['clients' => Client::where('user_id', Auth::id())->get()]);
    }

    public function index()
    {
        /** @var Collection $clients */
        $clients = Client::where('user_id', Auth::id())->with(['tasks.times' => function ($q) {
            return $q->orderBy('start_time', 'desc')->orderBy('created_at', 'desc');
        }])->get();

        // Sort the clients so the latest updated client shows up first.
        $clients->sort(function ($a, $b) {
            $timeCheck = function ($t) {
                if ($t->times->first() == null) {
                    return 0;
                }
                return strtotime($t->times->first()->start_date ?? $t->times->first()->created_at);
            };
            $aLatest = $a->tasks->max($timeCheck);
            $bLatest = $b->tasks->max($timeCheck);
            return $aLatest - $bLatest;
        });
        return Inertia::render('Dashboard', ['clients' => $clients]);
    }


    public function view(Request $request, $id)
    {
        $client = Client::where('id', $id)->where('user_id', Auth::id())->with(['tasks.times' => function ($q) {
            return $q->orderBy('start_time', 'desc')->orderBy('created_at', 'desc');
        }])->first();
        if (count($client->tasks) == 0) {
            return Inertia::render('ClientWizard', compact('client'));
        }
        return Inertia::render('Client', compact('client'));
    }

    public function billed(GetBilledRequest $request, $id)
    {
        $totalBilled = 0;
        $totalPending = 0;
        $hours = 0;
        foreach ($request->client->tasks()->with('times')->get() as $task) {
            foreach ($task->times as $time) {
                $hours += $time->time;
                if ($time->was_billed) {
                    $totalBilled += ($time->time * $task->rate);
                } else {
                    $totalPending += ($time->time * $task->rate);
                }
            }
        }
        return [
            'billed' => $totalBilled,
            'pending' => $totalPending,
            'hours' => $hours
        ];
    }
}
