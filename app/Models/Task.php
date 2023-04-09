<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarkedBy($user)
    {
    return $this->bookmarkByUser($user) !== null;
    }

    public function bookmarkByUser($user)
    {
        return $this->bookmarks()->where('user_id', $user->id)->first();
    }
    
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}