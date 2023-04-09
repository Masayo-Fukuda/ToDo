<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        $bookmark = new Bookmark;
        $bookmark->task_id = $request->task_id;
        $bookmark->user_id = $request->user()->id;
        $bookmark->save();
        return back();
    }

    public function destroy(Bookmark $bookmark)
    {
        $bookmark->delete();
        return back();
    }
}
