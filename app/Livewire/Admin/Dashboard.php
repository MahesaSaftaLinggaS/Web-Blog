<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'postCount'     => Post::count(),
            'userCount'     => User::count(),
            'categoryCount' => Category::count(),
            'recentPosts'   => Post::latest()->take(5)->get(),
        ])->layout('layouts.app');
    }
}
