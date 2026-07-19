<!DOCTYPE html>
<html>

<head>
    <title>Maverick</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        fetch("{{ route('api.holiday') }}")
            .then(response => response.json())
            .then(data => {

                if (!data) return;

                document.getElementById("holiday-alert").innerHTML = `
                    <div class="holiday-alert">
                        <strong>Next Public Holiday</strong><br>
                        ${data.name} (${data.localName})<br>
                        ${data.date} • ${data.days_left} day(s) remaining
                    </div>
                `;

            })
            .catch(error => console.error(error));

    });
</script>

<body>

    <div class="navbar">
        <h1>Maverick</h1>

        <div class="nav-controls">
            <form action="{{ route('dashboard.search', $selectedSpace) }}" method="GET">
                <div class="search-group">
                    <input type="text" class="search-input" name="search" value="{{ request('search') }}" placeholder="Search tasks">

                    <button type="submit">Search</button>

                    <details class="dropdown">
                        <summary class="nav-action">Filter</summary>

                        <div class="dropdown-panel">

                            <label>From</label>
                            <input type="datetime-local" name="from" value="{{ request('from') }}">

                            <label>To</label>
                            <input type="datetime-local" name="to" value="{{ request('to') }}">
                            <label>Task Name</label>
                            <input type="text" name="task_name" value="{{ request('task_name') }}">

                            <label>Task Type</label>
                            <select name="task_type">
                                <option value="">All</option>
                                <option value="todo">Todo</option>
                                <option value="ongoing">OnGoing</option>
                                <option value="done">Done</option>
                            </select>

                        </div>
                    </details>

                    <details class="dropdown">
                        <summary class="nav-action">Sort</summary>

                        <div class="dropdown-panel">

                            <select name="sort">

                                <option value="">None</option>

                                <option value="created_at">
                                    Created At
                                </option>

                                <option value="updated_at">
                                    Updated At
                                </option>

                                <option value="deadline">
                                    Deadline
                                </option>

                                <option value="task_name">
                                    Name
                                </option>

                            </select>

                        </div>
                    </details>
                </div>
            </form>
        </div>

        <div>
            <form action="{{ route('dashboard.action') }}" method="POST">
                @csrf

                @if(session()->has('username'))
                    <span class="profile-name">Profile Name : {{ session('username') }}</span>
                @endif

                <button type="submit" name="action" value="logout">Logout</button>
            </form>
        </div>
    </div>

    <div id="holiday-alert"></div>

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

                    <input type="text" name="task_name" placeholder="Task Name" required>

                    <button type="submit">
                        Add Row
                    </button>
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

                    <input type="text" name="task_name" placeholder="Task Name" required>

                    <button type="submit">
                        Add Row
                    </button>
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

                    <input type="text" name="task_name" placeholder="Task Name" required>

                    <button type="submit">
                        Add Row
                    </button>
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