@use Illuminate\Support\Facades\Storage;

@extends('layouts.app')

@section('content')
<h1>{{ $user->name }}</h1>

<p>Email: {{ $user->email }}</p>

@if ($user->photo)
    <img src="{{ Storage::url($user->photo) }}" alt="{{ $user->name }}" style="max-width: 200px;">
@endif

<a href="{{ route('users.edit', $user) }}">Edit User</a>
@endsection
