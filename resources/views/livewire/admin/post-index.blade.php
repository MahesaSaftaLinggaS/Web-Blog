<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Manajemen Artikel</h1>

    {{-- 🔍 Filter pencarian --}}
    <div class="mb-4">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Cari artikel..." 
               class="w-full p-2 border rounded shadow-sm" />
    </div>

    {{-- Tabel daftar artikel --}}
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Judul</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $post->title }}</td>
                        <td class="px-4 py-2">{{ $post->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-600">Edit</a>
                            <button wire:click="delete({{ $post->id }})"
                                    class="text-red-600"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada artikel ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Navigasi halaman --}}
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
