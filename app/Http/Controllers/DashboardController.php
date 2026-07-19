<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KanbanTask;
use App\Models\Space;
use App\Models\KanbanBoard;
use App\Services\HolidayService;

class DashboardController extends Controller
{
    public function addTodo(Request $request, Space $space)
    {
        return $this->addTask($request, $space, 'todo');
    }

    public function addOngoing(Request $request, Space $space)
    {
        return $this->addTask($request, $space, 'ongoing');
    }

    public function addDone(Request $request, Space $space)
    {
        return $this->addTask($request, $space, 'done');
    }

    private function addTask(Request $request, Space $space, string $column)
    {
        $request->validate([
            'task_name' => 'required|max:255'
        ]);

        $board = $space->board;

        KanbanTask::create([
            'kanban_board_id' => $board->kanban_board_id,
            'task_name' => $request->task_name,
            'column_name' => $column,
            'position' => KanbanTask::where('kanban_board_id', $board->kanban_board_id)
                ->where('column_name', $column)
                ->count()
        ]);

        return back();
    }

    public function deleteTask(KanbanTask $task)
    {
        $task->delete();

        return back();
    }

    public function moveTaskRight(KanbanTask $task)
    {
        switch ($task->column_name) {
            case 'todo':
                $task->column_name = 'ongoing';
                break;

            case 'ongoing':
                $task->column_name = 'done';
                break;
        }

        $task->save();

        return back();
    }

    public function moveTaskLeft(KanbanTask $task)
    {
        switch ($task->column_name) {
            case 'ongoing':
                $task->column_name = 'todo';
                break;

            case 'done':
                $task->column_name = 'ongoing';
                break;
        }

        $task->save();

        return back();
    }

    public function show(Space $space)
    {
        if ($space->username !== session('username')) {
            abort(403);
        }

        $board = $space->board;

        return view('dashboard', [
            'spaces' => $this->getSpaces(),
            'selectedSpace' => $space,

            'todoTasks' => $board
                ? $board->tasks()->where('column_name', 'todo')->orderBy('position')->get()
                : collect(),

            'ongoingTasks' => $board
                ? $board->tasks()->where('column_name', 'ongoing')->orderBy('position')->get()
                : collect(),

            'doneTasks' => $board
                ? $board->tasks()->where('column_name', 'done')->orderBy('position')->get()
                : collect(),
        ]);
    }

    public function addSpace(Request $request)
    {
        $request->validate([
            'space_name' => 'required|max:100'
        ]);

        $space = Space::create([
            'space_name' => $request->space_name,
            'username' => session('username')
        ]);

        KanbanBoard::create([
            'space_id' => $space->space_id,
            'board_name' => 'Kanban Board'
        ]);

        return redirect()->route('dashboard', $space->space_id);
    }

    public function holiday(HolidayService $holidayService)
    {
        return response()->json(
            $holidayService->getNextHoliday()
        );
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $timeRange = $request->time_range;
        $taskName = $request->task_name;
        $taskType = $request->task_type;
        $sort = $request->sort;

        return view('dashboard');
    }

    private function getSpaces()
    {
        return Space::where('username', session('username'))
            ->orderBy('created_at')
            ->get();
    }

    public function action(Request $request)
    {
        switch ($request->action) {
            case 'logout':
                $request->session()->flush();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login');
        }

        return back();
    }
}