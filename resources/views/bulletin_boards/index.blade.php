@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">게시판 목록</h1>

    <div>
        @forelse($bulletinBoards as $bulletinBoard)
        <div class="mb-4">
            <a href="{{ route('posts.index', $bulletinBoard) }}" class="text-blue-600 hover:text-blue-800">{{ $bulletinBoard->subject }}</a>
        </div>
        @empty
        <div class="text-gray-600">
            게시판이 없습니다.
        </div>
        @endforelse
    </div>
</div>
@endsection
