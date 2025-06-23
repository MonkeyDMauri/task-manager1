<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'description', 'manager_id', 'team_id'];

    public function manager() {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function members() {
        return $this->belongsToMany(User::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function formattedCreatedAt() {
        return $this->created_at->format('m/d/Y');
    }
}


