<?php

namespace App\View\Components;

use App\Models\KanbanTask;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskCard extends Component
{
    public KanbanTask $task;

    public function __construct(KanbanTask $task)
    {
        $this->task = $task;
    }

    public function render(): View|Closure|string
    {
        return view('components.task-card');
    }
}