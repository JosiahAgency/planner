<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCalendarView extends Component
{
    public $view = 'month';

    private function getUserCalendar(Request $request)
    {
        $userId = Auth::id();
        $allowedViews = ['day', 'week', 'month'];
        $view = in_array($request->get('view'), $allowedViews) ? $request->get('view') : 'week';
        $date = $request->get('date', Carbon::now()->toDateString());
        $carbonDate = Carbon::parse($date);

        if ($view === 'day') {
            $dates = collect([$carbonDate]);
        } elseif ($view === 'month') {
            // Get the start and end of the current month
            $startOfMonth = $carbonDate->copy()->startOfMonth();
            $endOfMonth = $carbonDate->copy()->endOfMonth();

            // Get the start of the week containing the first day of the month
            $startOfCalendar = $startOfMonth->copy()->startOfWeek();

            // Get the end of the week containing the last day of the month
            $endOfCalendar = $endOfMonth->copy()->endOfWeek();

            // Generate all dates between the start and end of the calendar
            $dates = collect();
            $currentDate = $startOfCalendar->copy();
            while ($currentDate->lte($endOfCalendar)) {
                $dates->push($currentDate->copy());
                $currentDate->addDay();
            }
        } else {
            $startOfWeek = $carbonDate->copy()->startOfWeek();
            $dates = collect(range(0, 6))->map(fn($d) => $startOfWeek->copy()->addDays($d));
        }

        $tasks = Tasks::where('owner_id', $userId)->whereBetween('due_date', [
            $dates->first()->startOfDay(),
            $dates->last()->endOfDay()
        ])->get();

        $groupedTasks = $tasks->groupBy(fn($task) => Carbon::parse($task->due_date)->toDateString());

        return compact('view', 'carbonDate', 'dates', 'groupedTasks');
    }

    public function render(Request $request)
    {
        return view('livewire.task-calendar-view', $this->getUserCalendar($request));
    }
}
