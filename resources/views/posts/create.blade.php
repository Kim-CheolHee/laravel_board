<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Post</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-center text-4xl font-bold mb-6">Create post</h1>

        <form action="{{ route('posts.store', ['bulletinBoard' => $bulletinBoard->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4 border border-black p-4">
                User: <input type="text" value="{{ Auth::user()->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading -tight focus:outline-none focus:shadow-outline" readonly>
            </div>

            <div class="mb-4 border border-black p-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus: shadow-outline" required>
            </div>

            <div class="mb-4 border border-black p-4">
                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                <textarea name="content" id="content" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus: shadow-outline" required></textarea>
            </div>

            <div class="mb-4 border border-black p-4">
                <label for="attachment" class="block text-gray-700 text-sm font-bold mb-2">Attachment (optional):</label>
                <input type="file" name="attachment" id="attachment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                <a href="{{ route('posts.index', ['bulletinBoard' => $bulletinBoard->id]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
