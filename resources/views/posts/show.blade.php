@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white shadow rounded">
       <div>
           <h1 class="text-3xl font-bold mb-2 text-gray-800">{{ $post->title }}</h1>
           <hr class="border-t border-gray-300 my-4">
           <p class="text-lg mb-4 text-gray-700">{{ $post->content }}</p>

           <div class="mb-4">
                 @forelse($post->attachments as $attachment)
                     <span class="text-gray-600">Attachment: <a href="{{ Storage::url('attachments/' . $attachment->file_path) }}" target="_blank" class="text-blue-500 hover:underline">{{ $attachment ->file_path }}</a></span><br>
                 @empty
                     <span class="text-gray-600">Attachment: N/A</span>
                 @endforelse
             <br>
               @if ($post->published_at)
                 <span class="text-gray-600">Published on: {{ \Carbon\Carbon::parse($post->published_at)->format('M d, Y') }}</span>
               @else
                 <span class="text-gray-600">Published on: N/A</span>
               @endif
           </div>

           <div class="text-center mt-4">
             @auth
                 <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mr-2" onclick="location.href='{{ route('posts.edit', ['bulletinBoard' => $post->bulletin_board_id, 'post' => $post->id]) }}'">Edit</button>
                 <button type="button" class="bg-red-400 text-white py-2 px-4 rounded hover:bg-red-600 mr-2" onclick="deletePost({{ $post->id }} )">Delete</button>
             @endauth
                 <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600" onclick="location.href='{{ route('posts.index' , ['bulletinBoard' => $post->bulletin_board_id, 'page' => $currentPage]) }}'">List</button>
           </div>
       </div>

       <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-4">
         @csrf
         <textarea name="content" class="w-full p-2 rounded border border-gray-300"></textarea>
         <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mr-2">댓글 달기</button>
       </form>

       <div class="mt-8">
            <h2 class="text-2xl font-bold text-gray-800">댓글 목록</h2>
            @foreach ($post->comments as $comment)
                <div class="mt-4 border-t border-gray-300 pt-4">
                    <div><strong class="text-gray-700">{{ $comment->user ? $comment->user->name : 'Unknown' }}:</strong></div>
                    <div class="text-gray-600">{{ $comment->content }}</div>
                </div>
            @endforeach
       </div>

</div>
@endsection

<script>
function deletePost(postId)
{
    if (confirm('정말 삭제하시겠습니까?'))
    {
        const form = document. createElement('form');
        form.method = 'POST';
        form.action = `/bulletin-boards/{{ $post->bulletin_board_id }}/posts/${postId}`;
           form.style.display = 'none';

        const csrfInput = document. createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        const methodInput = document. createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>
