<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function getTaskComments(Task $task) {
        
        $comments = Comment::where('task_id', $task->id)->get();

        foreach($comments as $comment) {
            $comment['author'] = $comment->author ? $comment->author->name : 'unknown'; 
            $comment['created_att'] = $comment->formattedCreateAt() ?? 'unknown'; 
        }

        return response()->json(['comments' => $comments, 'task_id' => $task->id]);
    }

    public function publishComment(Request $request) {

        $input = $request->validate([
                'comment' => 'required|string',
                'task_id' => 'required'
        ]);

        $input['user_id'] = auth()->user()->id;

        $comment = Comment::create($input);

        return back()->with('success', 'Comment was published');
    }

    public function deleteComment(Request $request) {
        $input = $request->json()->all();

        $comment = Comment::findOrFail($input['commentId']);

        $comment->delete();

        return response()->json(['success' => true]);
    }
}
