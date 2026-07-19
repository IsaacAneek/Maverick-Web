<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $primaryKey = 'space_id';

    protected $fillable = [
        'username',
        'space_name',
    ];

    public $timestamps = true;

    public function board()
    {
        return $this->hasOne(KanbanBoard::class, 'space_id');
    }
}