@extends('layouts.app')

@section('content')
<h1>Create New User</h1>

<form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
     @csrf
     <label>Name:</label>
     <input type="text" name="name">
     <label>Email:</label>
     <input type="email" name="email">
     <label>Photo:</label>
     <input type="file" name="photo">
     <button type="submit">Save</button>
</form>
@endsection
