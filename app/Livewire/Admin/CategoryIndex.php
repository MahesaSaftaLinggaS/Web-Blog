<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;

    public $name;
    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|unique:categories,name'
        ]);

        Category::create(['name' => $this->name]);

        session()->flash('success', 'Kategori berhasil ditambahkan!');
        $this->reset('name');
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
    }

    public function getLayout()
    {
        return 'layouts.app';
    }

    public function render()
    {
        return view('livewire.admin.category-index', [
            'categories' => Category::latest()
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10)
        ]);
    }

    public function posts()
{
    return $this->hasMany(\App\Models\Post::class);
}
}
