@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
     <h2 class="text-2xl font-bold mb-6">Post edit page</h2>
     <form action="{{ route('posts.update', ['bulletinBoard' => $post->bulletin_board_id, 'post' => $post->id]) }}" method="POST">
         @csrf
         @method('PUT')

         <div class="mb-4">
             <label for="title" class="block text-base font-bold mb-2">Title: </label>
             <input type="text" class="form-input w-full px-4 py-2 border border-gray-300" id="title" name="title" value="{{ $post->title }}" required>
         </div>

         <div class="mb-4">
             <label for="content" class="block text-base font-bold mb-2">Content</label>
             <textarea class="form-textarea w-full px-4 py-2 border border-gray-300" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
         </div>

         <div class="flex items-center">
             <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
             <button type="button" class="btn btn-secondary ml-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" onclick="window.location.href='{{ route('posts.show', ['bulletinBoard' => $post->bulletin_board_id, 'post' => $post->id]) }}'">Cancel</button>
         </div>
     </form>
</div>
@endsection
