<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="task_id_reference" content="{{$task->id}}">
    <meta name='current_user_id' content="{{auth()->user()->id}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Task overview</title>
    @vite('resources/js/app.js')
</head>
<body class="task-view">
    <section class="task-overview-header">
        <div style="display: flex; align-items:center;">
            <a href='/project/{{$task->project_id}}' style="font-size: 2.5rem;"><-</a>
            <h1>Task Overview</h1>
        </div>
        
        <hr>
        <div class="task-overview-info">
            <div style="display: flex; gap:8px; align-items:center;">
                <h2>ID:</h2>
                <p>{{$task->id}}</p>
            </div>
            <div style="display: flex; gap:8px; align-items:center;">
                <h2>Name:</h2>
                <p>{{$task->name}}</p>
            </div>
            <div style="display: flex; gap:8px; align-items:center;">
                <h2>Priority:</h2>
                <p>{{$task->priority}}</p>
            </div>
           <div style="display: flex; gap:8px; align-items:center;">
                <h2>Status</h2>
                <p>{{$task->status}}</p>
            </div>
           <div style="display: flex; gap:8px; align-items:center;">
                <h2>Project ID:</h2>
                <p>{{$task->project_id}}</p>
            </div>
           <div style="display: flex; gap:8px; align-items:center;">
                <h2>Creator:</h2>
                <p>{{$task->creator}}</p>
            </div>
        </div>
        <div class="task-overview-info1">
            
            <div style="display: flex; gap:8px; align-items:center;">
                <h2>Description:</h2>
                <p>{{$task->description}}</p>
            </div>
        </div>
    </section>

    <section class="comments-section">
        <div class="comments-section-header">
            <h1>Comments section</h1>
        </div>
        <div class="comments-wrapper">
            <div class="create-comment-wrapper">
                <form action="{{route('comment.publish')}}" method="POST">
                    @csrf
                    <label for="comment">Leave a comment</label>
                    <br>
                    <textarea name="comment" id="comment"></textarea>
                    <input type="hidden" name="task_id" value="{{$task->id}}">
                    <br>
                    <button>Publish</button>
                </form>
            </div>
            <h1>Comments</h1>
            <ul class="comments-list">
                {{-- comments go here and injected --}}
            </ul>
        </div>
    </section>

    <div class="delete-comment-popup-wrapper">
        <div class="delete-comment-popup-wrap">
            <h1>are you sure you want to delete this comment?</h1>

            <div class="delete-comment-btn-wrapper">
                <button class="delete-comment-yes">yes</button>
                <button class="delete-comment-no">no</button>
            </div>
        </div>
    </div>

</body>
</html>