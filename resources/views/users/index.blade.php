@extends('layouts.app')

@section('content')
<h1>Users</h1>

<a href="{{ route('users.create') }}">Create New Member</a>

<ul>
@foreach($users as $user)
     <li>
         {{ $user->name }} - {{ $user->email }}
         <a href="{{ route('users.show', $user) }}">View</a>
         <a href="{{ route('users.edit', $user) }}">Edit</a>
     </li>
@endforeach
</ul>
@endsection
