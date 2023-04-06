<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create($task_id)
    {
        $tasks = Task::find($task_id);
        
        return view('comments.create', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'body' => ['required', 'max:140'],
        ]);

        $comments = new Comment;
        $comments -> body = $request ->body;
        $comments -> user_id = Auth::id();
        $comments -> task_id = $request -> task_id;
        $comments -> save();

        return redirect()->route('tasks.index');
    }

    public function index($id)
    {
        $comments = Comment::where('task_id', $id)->get();
        return view('comments.index', compact('comments'));
    }
}
