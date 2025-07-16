<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    {{-- Kartu Statistik --}}
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

    {{-- Artikel Terbaru --}}
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

    {{-- Grafik Artikel per Bulan --}}
    <div class="mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Grafik Artikel per Bulan</h2>
        <canvas id="postsChart" height="100"></canvas>
    </div>

    {{-- Grafik Artikel per Kategori --}}
    <div class="mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Distribusi Artikel per Kategori</h2>
        <canvas id="categoryChart" height="100"></canvas>
    </div>
</div>

<!-- debug -->
<!-- <pre>
    {{ var_dump($categoryLabels) }}
    {{ var_dump($categoryCounts) }}
</pre> -->


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Bar: Artikel per Bulan
        const ctx = document.getElementById('postsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $chartLabels !!},
                datasets: [{
                    label: 'Jumlah Artikel',
                    data: {!! $chartData !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });

        // Chart Donut: Artikel per Kategori
        const ctx2 = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($categoryLabels) !!},
                datasets: [{
                    label: 'Artikel per Kategori',
                    data: {!! json_encode($categoryCounts) !!},
                    backgroundColor: [
                        '#60A5FA', '#FBBF24', '#34D399', '#F87171', '#A78BFA', '#F472B6',
                        '#38BDF8', '#FCD34D', '#6EE7B7', '#FCA5A5', '#C4B5FD', '#F9A8D4'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endpush
