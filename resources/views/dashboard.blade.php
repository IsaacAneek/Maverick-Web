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
            <div class="search-group">
                <input type="text" class="search-input" placeholder="Search tasks">

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
                        <label class="checkbox-row"><input type="checkbox" name="sort_time" checked> Time</label>
                        <label class="checkbox-row"><input type="checkbox" name="sort_name"> Name</label>
                        <label class="checkbox-row"><input type="checkbox" name="sort_type"> Type</label>
                    </div>
                </details>
            </div>
        </div>

        <div>
            <form action="actions.php" method="post">
                <button name="action" value="notifications">Notifications</button>
                <button name="action" value="help">Help</button>
                <button name="action" value="settings">Settings</button>
                @if(session()->has('username'))
                    <span class="profile-name">{{ session('username') }}</span>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endif
            </form>
        </div>
    </div>

    <div class="content">

        <div class="sidebar">
            <form action="actions.php" method="post">
                <div>
                    <div class="siderbar-header">
                        <div class="siderbar-header-buttons">
                            <button name="action">Spaces</button>
                            <button name="action" value="add_space">Add New Space</button>
                        </div>
                        <div class="siderbar-header-input">
                            <input type="text" name="space_name" placeholder="New Space Name" required>
                        </div>
                    </div>

                    <div class="space">

                    </div>
                </div>
            </form>
        </div>

        <div class="main">

            <div class="column">
                <h2>Todo</h2>

                <form action="actions.php" method="post">
                    <button name="action" value="add_todo">
                        Add Row
                    </button>
                </form>

                <div class="rows">

                </div>
            </div>

            <div class="column">
                <h2>In Progress</h2>

                <form action="actions.php" method="post">
                    <button name="action" value="add_progress">
                        Add Row
                    </button>
                </form>

                <div class="rows"></div>
            </div>

            <div class="column">
                <h2>Done</h2>

                <form action="actions.php" method="post">
                    <button name="action" value="add_done">
                        Add Row
                    </button>
                </form>

                <div class="rows"></div>
            </div>

        </div>

    </div>

</body>

</html>