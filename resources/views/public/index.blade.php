@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-8 text-center text-blue-700">Daftar Artikel</h1>

    @if ($posts->isEmpty())
        <p class="text-center text-gray-500">
            Tidak ditemukan artikel untuk pencarian:
            <strong>{{ request('search') }}</strong>
        </p>
    @else
        @foreach ($posts as $post)
            <div class="mb-8 p-6 bg-white rounded shadow flex gap-6">
                @if ($post->image)
                    <div class="w-40 flex-shrink-0">
                        <img src="{{ asset('storage/' . $post->image) }}"
                             alt="Gambar {{ $post->title }}"
                             class="w-full h-auto rounded">
                    </div>
                @endif

                <div class="flex-1">
                    <h2 class="text-2xl font-semibold text-blue-600">
                        <a href="{{ route('public.posts.show', $post->slug) }}">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="text-gray-500 text-sm mb-2">
                        Diposting pada {{ $post->created_at->format('d M Y') }}
                    </p>
                    <p class="text-gray-700">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>
                </div>
            </div>
        @endforeach

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
