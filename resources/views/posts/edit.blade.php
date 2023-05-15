@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
     <h2 class="text-2xl font-bold mb-6">Post edit page</h2>
     <form action="{{ route('posts.update', ['bulletinBoard' => $post->bulletin_board_id, 'post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
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

         <div class="mb-4">
             <label for="attachments" class="block text-base font-bold mb-2">Attachments</label>
             @foreach($attachments as $attachment)
                 <div id="attachment-{{ $attachment->id }}">
                     <input type="checkbox" id="deleted_attachments[{{ $attachment->id }}]" name="deleted_attachments[]" value="{{ $attachment->id }}">
                     <label for="deleted_attachments[{{ $attachment->id }}]">{{ $attachment->file_path }}</label>
                 </div>
             @endforeach
             <input type="file" id="attachments" name="attachments[]" multiple>
             <button type="button" id="deleteBtn" class="bg-red-400 text-white py-2 px-4 rounded hover:bg-red-600 mr-2">체크된 첨부파일 삭제</button>
         </div>

         <div class="flex items-center">
             <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
             <button type="button" class="btn btn-secondary ml-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" onclick="window.location.href=' {{ route('posts.show', ['bulletinBoard' => $post->bulletin_board_id, 'post' => $post->id]) }}'">Cancel</button>
         </div>
     </form>
</div>

<script>
    document.getElementById('deleteBtn').addEventListener('click', function(e) {
        e.preventDefault();
        var checkboxes = document.querySelectorAll('input[name="deleted_attachments[]"]:checked');
        for (var i = 0; i < checkboxes.length; i++)
        {
            var id = checkboxes[i].value;
            var attachmentDiv = document.getElementById('attachment-' + id);
            attachmentDiv.remove();
        }
    });
</script>
@endsection
