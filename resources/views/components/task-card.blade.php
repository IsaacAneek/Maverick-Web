<div class="task-card">

    <h3>{{ $task->task_name }}</h3>

    <p>
        Created:
        {{ $task->created_at->format('d M Y H:i') }}
    </p>

    <p>
        Updated:
        {{ $task->updated_at->format('d M Y H:i') }}
    </p>

    <div class="task-actions">

        @if($task->column_name != 'todo')
        <form action="{{ route('task.moveLeft',$task->kanban_task_id) }}" method="POST">
            @csrf
            <button>←</button>
        </form>
        @endif

        @if($task->column_name != 'done')
        <form action="{{ route('task.moveRight',$task->kanban_task_id) }}" method="POST">
            @csrf
            <button>→</button>
        </form>
        @endif

        <form action="{{ route('task.delete',$task->kanban_task_id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button>Remove</button>
        </form>

    </div>

</div>