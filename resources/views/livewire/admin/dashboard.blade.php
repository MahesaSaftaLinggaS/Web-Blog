<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="p-6 bg-white rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Total Artikel</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $postCount }}</p>
        </div>

        <div class="p-6 bg-white rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Total Pengguna</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $userCount }}</p>
        </div>

        <div class="p-6 bg-white rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Total Kategori</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $categoryCount }}</p>
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4">Artikel Terbaru</h2>
    <ul class="bg-white rounded shadow divide-y divide-gray-200">
        @forelse ($recentPosts as $post)
            <li class="p-4">
                <a href="{{ route('public.posts.show', $post->slug) }}" class="text-blue-600 hover:underline">
                    {{ $post->title }}
                </a>
                <p class="text-sm text-gray-500">{{ $post->created_at->format('d M Y') }}</p>
            </li>
        @empty
            <li class="p-4 text-gray-500">Belum ada artikel.</li>
        @endforelse
    </ul>
</div>
