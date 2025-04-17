<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentSwitcher extends Component
{
    public $currentView = 'task_list';

    public function showMainBody()
    {
        $this->currentView = 'task_list';
    }

    public function showCalendarTasks()
    {
        $this->currentView = 'calendar_tasks';
    }

    public function render()
    {
        return view('livewire.content-switcher');
    }
}
