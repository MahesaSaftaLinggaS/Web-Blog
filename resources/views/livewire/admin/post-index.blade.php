<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Daftar Artikel</h1>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($posts as $post)
        <div class="bg-white rounded shadow p-4 mb-4">
            <h2 class="text-lg font-semibold text-blue-600">{{ $post->title }}</h2>
            <p class="text-sm text-gray-500 mb-2">{{ $post->created_at->format('d M Y') }}</p>
            <p class="mb-4">{{ Str::limit($post->content, 120) }}</p>

            <div class="flex space-x-2">
                <a href="{{ route('admin.posts.edit', $post->id) }}"
                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>

                <button wire:click="delete({{ $post->id }})"
                    onclick="confirm('Yakin ingin hapus?') || event.stopImmediatePropagation()"
                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
            </div>
        </div>
    @endforeach
</div>
