@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-center text-4xl font-bold mb-6 cursor-pointer">
        <a href="{{ route('bulletin-boards.index') }}" class="text-black hover:text-blue-600">
            {{ $bulletinBoard->subject }}
        </a>
    </h1>

    <div class="w-full flex justify-center">
        <table class="table-auto border-collapse border w-full">
            <thead>
                <tr>
                    <th class="border border-solid border-black px-4 py-2">Num</th>
                    <th class="border border-solid border-black px-4 py-2">Title</th>
                    <th class="border border-solid border-black px-4 py-2">Created At</th>
                    <th class="border border-solid border-black px-4 py-2">Published At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $index => $post)
                <tr>
                    <td class="border border-solid border-black px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-solid border-black px-4 py-2">
                        <a href="{{ route('posts.show', ['bulletinBoard' => $bulletinBoard->id, 'post' => $post->id, 'page' => $posts->currentPage()]) }}" class="text-blue-500 hover:text-blue-700">{{ $post->title }}</a>
                    </td>
                    <td class="border border-solid border-black px-4 py-2">{{ $post->created_at }}</td>
                    <td class="border border-solid border-black px-4 py-2">{{ $post->published_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center">No posts.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <hr class="my-4"/>

    <div class="flex justify-between items-center">
        <div class="flex justify-center w-full">
            {{ $posts->links() }}
        </div>
        <div>
            @auth
                <button onclick="location.href='{{ route('posts.create', ['bulletinBoard' => $bulletinBoard->id]) }}'" class="bg-green-300 text-white py- 2 px-4 rounded hover:bg-green-400">Write</button>
            @endauth
        </div>
    </div>

</div>
@endsection
