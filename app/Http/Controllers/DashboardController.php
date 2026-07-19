<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Space;
use App\Models\KanbanBoard;

class DashboardController extends Controller
{
    public function show()
    {
        return view('dashboard', [
            'spaces' => $this->getSpaces(),
            'selectedSpace' => session('selected_space')
        ]);
    }

    public function selectSpace($id)
    {
        $space = Space::where('space_id', $id)
            ->where('username', session('username'))
            ->firstOrFail();

        session([
            'selected_space' => $space->space_id
        ]);

        return redirect()->back();
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

        session([
            'selected_space' => $space->space_id
        ]);

        return redirect()->back();
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
            case 'notifications':

                break;

            case 'help':

                break;

            case 'settings':

                break;

            case 'logout':
                $request->session()->flush();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login');
        }

        return redirect()->back();
    }
}
