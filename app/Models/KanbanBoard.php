<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KanbanBoard extends Model
{
    protected $primaryKey = 'kanban_board_id';

    public $timestamps = false;

    protected $fillable = [
        'space_id',
        'board_name',
    ];

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id');
    }

    public function tasks()
    {
        return $this->hasMany(KanbanTask::class, 'kanban_board_id');
    }
}