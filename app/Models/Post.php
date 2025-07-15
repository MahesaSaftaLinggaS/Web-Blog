<?php

namespace App\Models;

// app/Models/Post.php

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'image', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Post.php
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Category.php
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
