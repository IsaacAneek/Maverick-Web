<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KanbanTask extends Model
{
    protected $table = 'kanban_tasks';

    protected $primaryKey = 'kanban_task_id';

    public $timestamps = true;

    protected $fillable = [
        'kanban_board_id',
        'task_name',
        'column_name',
        'deadline',
        'is_completed',
        'position',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'is_completed' => 'boolean',
    ];

    public function board()
    {
        return $this->belongsTo(KanbanBoard::class, 'kanban_board_id', 'kanban_board_id');
    }
}