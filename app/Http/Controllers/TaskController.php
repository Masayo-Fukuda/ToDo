<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::latest()->simplepaginate(5);
        
        return view('index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => ['required', 'max:30'],
            'contents' => ['required', 'max:140'],
        ]);

        $task = new Task;
        $task -> title = $request ->title;
        $task -> contents = $request -> contents;
        $task -> user_id = Auth::id();

        $task -> save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            abort(403); // アクセス拒否
        }

        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'title' => ['required', 'max:30'],
            'contents' => ['required', 'max:140'],
            'image_at' => ['nullable', 'max:8192'],
        ]);

        $task = Task::find($id);
        $task -> title = $request -> title;
        $task -> contents = $request -> contents;

        if ($request->hasFile('image_at')) {
            $image_path = $request->file('image_at')->store('public/image/');
            $task->image_at = basename($image_path);
        }

        $task -> save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
    
        if ($task->user_id !== Auth::id()) {
            abort(403); // アクセス拒否
        }
    
        $task->delete();
    
        return redirect()->route('tasks.index');
    }
}
