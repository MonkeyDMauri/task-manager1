<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['name', 'description', 'status', 'priority', 'project_id', 'completed_by', 'created_at'];

    protected $table = 'tasks';
}
