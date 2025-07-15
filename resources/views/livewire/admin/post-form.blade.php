<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">
        {{ $postId ? 'Edit Artikel' : 'Tambah Artikel' }}
    </h1>

    {{-- Notifikasi sukses --}}
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulir artikel --}}
    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4">
        {{-- Judul --}}
        <div>
            <label class="block text-sm font-medium">Judul</label>
            <input type="text" wire:model.defer="title" class="w-full p-2 border rounded" />
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Isi konten --}}
        <div>
            <label class="block text-sm font-medium">Isi</label>
            <textarea wire:model.defer="content" class="w-full p-2 border rounded" rows="6"></textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Upload gambar --}}
        <div>
            <label class="block text-sm font-medium">Gambar (opsional)</label>
            <input type="file" wire:model="image" class="w-full p-2 border rounded" />
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            {{-- Preview gambar sementara --}}
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="w-40 mt-4 rounded shadow" alt="Preview" />
            @elseif ($oldImage)
                <img src="{{ asset('storage/' . $oldImage) }}" class="w-40 mt-4 rounded shadow" alt="Gambar lama" />
            @endif
        </div>

        {{-- Tombol simpan --}}
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>
