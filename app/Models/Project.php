<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'start_date', 'due_date', 'status', 'priority', 'auto_complete', 'created_by', 'completed_at'];

    // one-to-many model relationship to get all tasks belonging to a project.
    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
