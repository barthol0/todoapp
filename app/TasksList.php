<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksList extends Model
{
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
