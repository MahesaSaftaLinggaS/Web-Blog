<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;

class PostIndex extends Component
{
    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        session()->flash('success', 'Artikel berhasil dihapus.');
    }

    public function render()
    {
        $posts = Post::latest()->get();

        return view('livewire.admin.post-index', compact('posts'))
            ->layout('layouts.app'); // ✅ Ini sudah benar
    }
}
