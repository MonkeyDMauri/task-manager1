<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
<<<<<<< HEAD
    protected $fillable = ['name', 'description', 'status', 'priority', 'project_id', 'assigned_to', 'completed_by', 'created_at'];
=======
    protected $fillable = ['name', 'description', 'status', 'priority', 'project_id', 'assigned_to', 'completed_by', 'created_at', 'created_by'];
>>>>>>> 07f4412 (Recovered project and added new code)

    protected $table = 'tasks';

    public function createdAt() {
        return $this->created_at->format('Y/m/d');
    }

    public function assignedUser() {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function completedByUser(){ 
        return $this->belongsTo(User::class, 'completed_by');
    }
<<<<<<< HEAD
=======

    public function owner() {
        return $this->belongsTo(User::class, 'created_by');
    }
>>>>>>> 07f4412 (Recovered project and added new code)
}
