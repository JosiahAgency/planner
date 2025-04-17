<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
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

    private function getUserTaskStats()
    {
        $userId = Auth::id();
        $taskList = Tasks::where('owner_id', $userId)->paginate(10);
        $completed = $taskList->where('status', 1)->count();
        $pending = $taskList->where('status', 0)->count();

        return compact('taskList', 'completed', 'pending');
    }

    private function getUserCalendar(Request $request)
    {
        $allowedViews = ['day', 'week', 'month'];
        $view = in_array($request->get('view'), $allowedViews) ? $request->get('view') : 'week';
        $date = $request->get('date', Carbon::now()->toDateString());
        $carbonDate = Carbon::parse($date);

        if ($view === 'day') {
            $dates = collect([$carbonDate]);
        } elseif ($view === 'month') {
            $dates = collect(range(1, $carbonDate->daysInMonth))
                ->map(fn($d) => $carbonDate->copy()->startOfMonth()->addDays($d - 1));
        } else {
            $startOfWeek = $carbonDate->copy()->startOfWeek();
            $dates = collect(range(0, 6))->map(fn($d) => $startOfWeek->copy()->addDays($d));
        }

        $tasks = Tasks::whereBetween('due_date', [
            $dates->first()->startOfDay(),
            $dates->last()->endOfDay()
        ])->get();

        $groupedTasks = $tasks->groupBy(fn($task) => Carbon::parse($task->due_date)->toDateString());

        return compact('view', 'carbonDate', 'dates', 'groupedTasks');
    }

    public function dashboard(Request $request)
    {
        return view('welcome', $this->getUserTaskStats(), $this->getUserCalendar($request));
    }

    public function loadContent() {}
}
