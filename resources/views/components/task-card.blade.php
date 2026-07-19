<div class="task-card">

    <!-- Update form -->
    <form action="{{ route('task.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <p>Task Name : </p>
        <input type="text" name="task_name" value="{{ $task->task_name }}">

        <p>Deadline : </p>
        <input
            type="datetime-local"
            name="deadline"
            value="{{ optional($task->deadline)->format('Y-m-d\TH:i') }}"
        >

        <p></p>
        <button type="submit">Update</button>
    </form>

    <div class="task-actions">

        @if($task->column_name != 'todo')
            <form action="{{ route('task.moveLeft',$task) }}" method="POST">
                @csrf
                <button>←</button>
            </form>
        @endif

        @if($task->column_name != 'done')
            <form action="{{ route('task.moveRight',$task) }}" method="POST">
                @csrf
                <button>→</button>
            </form>
        @endif

        <form action="{{ route('task.delete',$task) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Remove</button>
        </form>

    </div>

</div>