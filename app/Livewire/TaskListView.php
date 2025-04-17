<?php

namespace App\Livewire;

use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskListView extends Component
{
    public function deleteTask($taskId)
    {
        $task = Tasks::find($taskId);
        if ($task) {
            $task->delete();
            session()->flash('message', 'Task deleted successfully!');
        }
    }

    private function getUserTaskStats()
    {
        $userId = Auth::id();
        $taskList = Tasks::where('owner_id', $userId)->paginate(10);
        $completed = $taskList->where('status', 1)->count();
        $pending = $taskList->where('status', 0)->count();

        return compact('taskList', 'completed', 'pending');
    }

    public function render()
    {
        return view('livewire.task-list-view',  $this->getUserTaskStats());
    }
}
