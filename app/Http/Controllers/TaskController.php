<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public $taskId;

    public function createTask(Request $request)
    {
        Tasks::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'due_date' => $request['due_date'],
            'priorities' => $request['priorities'],
            'status' => $request['status'],
            'owner_id' => $request['owner_id']
        ]);

        return redirect('/')->with('success', 'Task created successfully');
    }


    public function dashboard()
    {
        return view('welcome');
    }
}
