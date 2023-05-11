@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
      <div>
          <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
          <hr class="border-t border-gray-300 my-4">
          <p class="text-lg mb-4">{{ $post->content }}</p>

          <div class="mb-4">
              @if ($post->attachment)
                <span class="text-gray-600">Attachment: <a href="{{ asset('storage/attachments/' . $post->attachment) }}" target="_blank">{{ $post->attachment }}</a></span>
              @else
                <span class="text-gray-600">Attachment: N/A</span>
              @endif
            <br>
              @if ($post->published_at)
                <span class="text-gray-600">Published on: {{ \Carbon\Carbon::parse($post->published_at)->format('M d, Y') }}</span>
              @else
                <span class="text-gray-600">Published on: N/A</span>
              @endif
          </div>
          <div class="text-center mt-4">
            @auth
                <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mr-2" onclick="location.href='{{ route('posts.edit', ['bulletinBoard' => $post->bulletin_board_id, 'post' => $post->id]) }}'">수 정</button>
                <button type="button" class="bg-red-300 text-white py-2 px-4 rounded hover:bg-red-600 mr-2" onclick="deletePost({{ $post->id }})">삭 제</button>
            @endauth
                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600" onclick="location.href='{{ route('posts.index', ['bulletinBoard' => $post->bulletin_board_id, 'page' => $currentPage]) }}'">목 록</button>
          </div>
      </div>
</div>
@endsection

<script>
function deletePost(postId)
{
      if (confirm('정말 삭제하시겠습니까?'))
      {
          const form = document.createElement('form');
          form.method = 'POST';
          form.action = `/bulletin-boards/{{ $post->bulletin_board_id }}/posts/${postId}`;
          form.style.display = 'none';

          const csrfInput = document.createElement('input');
          csrfInput.type = 'hidden';
          csrfInput.name = '_token';
          csrfInput.value = '{{ csrf_token() }}';
          form.appendChild(csrfInput);

          const methodInput = document.createElement('input');
          methodInput.type = 'hidden';
          methodInput.name = '_method';
          methodInput.value = 'DELETE';
          form.appendChild(methodInput);

          document.body.appendChild(form);
          form.submit();
      }
}
</script>
