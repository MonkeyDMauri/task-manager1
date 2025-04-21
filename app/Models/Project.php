<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'start_date', 'due_date', 'status', 'priority', 'auto_complete', 'created_by', 'completed_at'];
}
