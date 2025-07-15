<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class PostForm extends Component
{
    use WithFileUploads;

    public $title, $content, $image, $oldImage, $postId;

    public function mount($id = null)
    {
        if ($id) {
            $post = Post::findOrFail($id);
            $this->postId = $id;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->oldImage = $post->image;
        }
    }

    public function save()
    {
        $this->validate([
            'title'   => 'required|string|min:3',
            'content' => 'required|string|min:10',
            'image'   => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($this->title) . '-' . Str::random(4);
        $imagePath = $this->image
            ? $this->image->store('posts', 'public')
            : $this->oldImage;

        if ($this->postId) {
            $post = Post::findOrFail($this->postId);
            $post->update([
                'title'   => $this->title,
                'slug'    => $slug,
                'content' => $this->content,
                'image'   => $imagePath,
            ]);

            session()->flash('success', 'Artikel berhasil diperbarui!');
        } else {
            Post::create([
                'title'   => $this->title,
                'slug'    => $slug,
                'content' => $this->content,
                'image'   => $imagePath,
                'user_id' => Auth::id(),
            ]);

            session()->flash('success', 'Artikel berhasil disimpan!');
        }

        return redirect()->route('admin.posts');
    }

    public function render()
    {
        return view('livewire.admin.post-form')
            ->layout('layouts.app'); // ✅ Tambahkan layout di sini
    }
}
