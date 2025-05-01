<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['name', 'description', 'status', 'priority', 'project_id', 'assigned_to', 'completed_by', 'created_at'];

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
}
