<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Kelola Kategori</h1>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="mb-6 space-y-2">
        <div>
            <label class="block text-sm font-medium">Nama Kategori</label>
            <input type="text" wire:model.defer="name" class="w-full border p-2 rounded">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Tambah Kategori
        </button>
    </form>

    <h2 class="text-xl font-semibold mb-2">Daftar Kategori</h2>
    <ul class="space-y-1">
        @foreach ($categories as $category)
            <li class="flex justify-between items-center bg-white p-2 rounded shadow">
                <span>{{ $category->name }}</span>
                <button wire:click="delete({{ $category->id }})"
                    class="text-red-500 hover:underline text-sm">Hapus</button>
            </li>
        @endforeach
    </ul>
</div>
