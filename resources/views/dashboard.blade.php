<!DOCTYPE html>
<html>

<head>
    <title>Maverick</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="navbar">
        <h1>Maverick</h1>

        <div class="nav-controls">
            <form action="{{ route('dashboard.search') }}" method="GET">
                <div class="search-group">
                    <input type="text" class="search-input" name="search" placeholder="Search tasks">

                    <button type="submit">Search</button>

                    <details class="dropdown">
                        <summary class="nav-action">Filter</summary>

                        <div class="dropdown-panel">
                            <label for="time-range">Time Range</label>
                            <input type="datetime-local" id="time-range" name="time_range">

                            <label for="task-name">Task Name</label>
                            <input type="text" id="task-name" name="task_name" placeholder="Task Name">

                            <label for="task-type">Task Type</label>
                            <input type="text" id="task-type" name="task_type" placeholder="Task Type">
                        </div>
                    </details>

                    <details class="dropdown">
                        <summary class="nav-action">Sort</summary>

                        <div class="dropdown-panel">
                            <label class="checkbox-row">
                                <input type="checkbox" name="sort[]" value="time" checked>
                                Time
                            </label>

                            <label class="checkbox-row">
                                <input type="checkbox" name="sort[]" value="name">
                                Name
                            </label>

                            <label class="checkbox-row">
                                <input type="checkbox" name="sort[]" value="type">
                                Type
                            </label>
                        </div>
                    </details>
                </div>
            </form>
        </div>

        <div>
            <form action="{{ route('dashboard.action') }}" method="POST">
                @csrf

                <button type="submit" name="action" value="notifications">
                    Notifications
                </button>

                <button type="submit" name="action" value="help">
                    Help
                </button>

                <button type="submit" name="action" value="settings">
                    Settings
                </button>

                @if(session()->has('username'))
                    <span class="profile-name">Profile Name : {{ session('username') }}</span>
                @endif

                <button type="submit" name="action" value="logout">Logout</button>
            </form>
        </div>
    </div>

    <div class="content">

        <div class="sidebar">
            <form action="{{ route('space.add') }}" method="POST">
                @csrf

                <div class="sidebar-header">

                    <div class="sidebar-header-buttons">

                        <button type="submit">
                            Add Space
                        </button>

                    </div>

                    <div class="sidebar-header-input">

                        <input type="text" name="space_name" placeholder="New Space Name" required>

                    </div>

                </div>

            </form>

            <div class="space">
                @foreach($spaces as $space)

                    <a href="{{ route('dashboard', $space->space_id) }}"
                        class="space-button {{ optional($selectedSpace)->space_id == $space->space_id ? 'selected-space' : '' }}">

                        {{ $space->space_name }}

                    </a>

                @endforeach
            </div>
        </div>

        <div class="main">

            <div class="column">
                <h2>Todo</h2>

                <form action="{{ route('todo.add', $selectedSpace->space_id) }}" method="POST">
                    @csrf
                    <button>Add Row</button>
                </form>

                <div class="rows">

                    @foreach($todoTasks as $task)

                        <x-task-card :task="$task" />

                    @endforeach

                </div>
            </div>

            <div class="column">
                <h2>In Progress</h2>

                    <form action="{{ route('ongoing.add', $selectedSpace->space_id) }}" method="POST">
                        @csrf
                        <button>Add Row</button>
                    </form>

                    <div class="rows">

                        @foreach($ongoingTasks as $task)

                            <x-task-card :task="$task" />

                        @endforeach

                    </div>
            </div>

            <div class="column">
                <h2>Done</h2>

                <form action="{{ route('done.add', $selectedSpace->space_id) }}" method="POST">
                    @csrf
                    <button>Add Row</button>
                </form>

                <div class="rows">

                    @foreach($doneTasks as $task)

                        <x-task-card :task="$task" />

                    @endforeach

                </div>
            </div>

        </div>

    </div>

</body>

</html>