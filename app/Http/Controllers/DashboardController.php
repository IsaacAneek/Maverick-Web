<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show() {
        return view('dashboard');
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

    public function action(Request $request)
    {
        switch ($request->action) {
            case 'notifications':
                
                break;

            case 'help':
                
                break;

            case 'settings':
                
                break;
        }

        return redirect()->back();
    }
}
