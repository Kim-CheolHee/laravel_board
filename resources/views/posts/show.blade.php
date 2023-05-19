@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white shadow rounded">
    <div>
        <h1 class="text-3xl font-bold mb-2 text-gray-800">{{ $post->title }}</h1>
        <hr class="border-t border-gray-300 my-4">
        <p class="text-lg mb-4 text-gray-700">{{ $post->content }}</p>

        <div class="mb-4">
            @forelse($post->attachments as $attachment)
            <span class="text-gray-600">첨부파일 : <a href="{{ Storage::url('attachments/' . $attachment->file_path) }}" target="_blank" class="text-blue-500 hover:underline">{{ $attachment ->file_path }}</a></span><br>
            @empty
            <span class="text-gray-600">첨부파일 : N/A</span>
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

    <form id="commentForm" method="POST" action="{{ route('comments.store', ['bulletinBoard' => $post->bulletin_board_id, 'post' => $post]) }}" class="mt-4 ">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea id="commentTextarea" name="content" class="w-full p-2 rounded border border-gray-300"></textarea>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mr-2">댓글 달기</button>
    </form>
    <script>
    document.getElementById('commentForm').addEventListener('submit', function(e)
    {
        var textarea = document.getElementById('commentTextarea');

        if (textarea.value.trim() === '') {
            e.preventDefault();
            alert('내용을 입력하세요.');
        }
    });
    </script>

    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-800">댓글 목록</h2>
        @foreach ($post->comments as $comment)
            <div class="mt-4 border-t border-gray-300 pt-4">
                <div><strong class="text-gray-700">{{ $comment->user ? $comment->user->name : 'Unknown' }}:</strong></div>
                <div id="comment-content-{{ $comment->id }}" class="text-gray-600">{{ $comment->content }}</div>
                @if(auth()->id() === $comment->user_id)
                <button id="edit-comment-button-{{ $comment->id }}" type="button" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mr-2" onclick="editComment({{ $comment->id }})">댓글 수정</button>

                    <form id="edit-comment-form-{{ $comment->id }}" method="POST" action="{{ route('comments.update', ['bulletinBoard' => $post->bulletin_board_id, 'post' => $post->id, 'comment' => $comment]) }}" class="hidden">
                        @csrf
                        @method('PUT')
                        <textarea id="edit-comment-textarea-{{ $comment->id }}" name="content" class="w-full p-2 rounded border border-gray-300">{{ $comment-> content }}</textarea>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mr-2 mt-2">저장</button>
                        <button type="button" class="bg-red-400 text-white py-2 px-4 rounded hover:bg-red-600 mr-2 mt-2" onclick="deleteComment({{ $comment->id }})">댓글 삭제</button>
                    </form>
                @endif
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

    function deleteComment(commentId)
    {
        if (confirm('댓글을 정말 삭제하시겠습니까?'))
        {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/bulletin-boards/{{ $post->bulletin_board_id }}/posts/{{ $post->id }}/comments/${commentId}`;
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

    function editComment(commentId)
    {
        const contentDiv = document.getElementById(`comment-content-${commentId}`);
        const editButton = document.getElementById(`edit-comment-button-${commentId}`);
        const editForm = document.getElementById(`edit-comment-form-${commentId}`);
        const textarea = document.getElementById(`edit-comment-textarea-${commentId}`);

        if (editForm.style.display === 'none' || editForm.style.display === '')
        {
            // 편집모드로 전환
            contentDiv.style.display = 'none';
            editButton.innerText = '취소';
            textarea.value = contentDiv.innerText.trim();
                       editForm.style.display = 'block';
        } else
        {
            // 편집모드 취소
            contentDiv.style.display = 'block';
            editButton.innerText = '댓글 수정';
            editForm.style.display = 'none';
        }
    }
</script>
