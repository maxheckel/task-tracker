<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTaskRequest;
use App\Models\Task;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(AddTaskRequest $request){
        $vals = $request->validated();
        $task = Task::make($vals);
        $task->user_id = Auth::id();
        $task->save();
        $logNow = $request->get('logNow');
        if ($logNow){
            $time = new Time();
            $time->task_id = $task->id;
            $time->user_id = Auth::id();
            $time->time = $vals['time'];
            $time->start_time = $vals['start_date'];
            $time->billable = true;
            $time->was_billed = false;
            $time->invoice_id = null;
            $time->save();
        }
        if ($logNow){
            return redirect('/clients/'.$request->get('client_id'));
        }
        return redirect('/task/'.$task->id.'/log');
    }


}
