@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold text-blue-800 mb-2">{{ $post->title }}</h1>
    <p class="text-gray-500 text-sm mb-4">{{ $post->created_at->format('d M Y') }}</p>

    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="mb-4 rounded shadow">
    @endif

    <div class="prose max-w-none">
        {!! nl2br(e($post->content)) !!}
    </div>
</div>
@endsection
