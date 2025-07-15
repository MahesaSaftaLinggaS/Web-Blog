<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostIndex extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    // Reset ke halaman pertama saat kata kunci pencarian berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        session()->flash('success', 'Artikel berhasil dihapus.');
    }

    public function getLayout()
    {
        return 'components.layouts.app';
    }

    public function render()
{
    $posts = Post::latest()
        ->where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhereHas('category', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
        })
        ->paginate(10);

    return view('livewire.admin.post-index', compact('posts'))
        ->layout('layouts.app'); // ⬅️ ini yang penting
}

}
