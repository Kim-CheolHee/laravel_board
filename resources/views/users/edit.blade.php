@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Edit Password</h1>

<form action="{{ route('users.update', $user) }}" method="POST" id="password-update-form">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
        <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="mb-4">
        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password-confirm" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="mb-4">
        <button type="button" onclick="submitForm()" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Submit</button>
    </div>
</form>
@endsection

@section('scripts')
<script>
    function submitForm() {
        event.preventDefault();
        const confirmation = confirm('정말 비밀번호를 바꾸시겠습니까?');
        if (confirmation) {
            document.getElementById('password-update-form').submit();
        }
    }
</script>
@endsection
