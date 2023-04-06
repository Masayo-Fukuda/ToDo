<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class MyPageController extends Controller
{
    public function show($id)
    {
        $tasks = Task::where('user_id', $id)->get();

        return view('my_page', compact('tasks'));
    }
}
