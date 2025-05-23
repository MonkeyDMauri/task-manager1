<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['comment', 'user_id', 'task_id'];

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formattedCreateAt() {
        return $this->created_at->format('m-d-Y');
    }
}
