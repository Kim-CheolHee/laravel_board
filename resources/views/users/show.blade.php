@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-5">
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg md:max-w-5xl">
        <div class="md:flex ">
            <div class="w-full p-4 px-5 py-5">
                <div class="text-center mb-10">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-2">{{ $user->name }}</h1>
                    <p class="leading-relaxed tracking-wide text-sm text-indigo-500 font-semibold">Email: {{ $user->email }}</p>
                </div>

                @if($_user)
                <div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <tbody>
                            @foreach($_user->getAttributes() as $key => $value)
                                @if ($key !== 'password')
                                    <tr>
                                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ ucfirst($key) }}</th>
                                        <td class="px-6 py-4">{{ $value }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                @if($user->photo)
                    <div class="flex justify-center">
                        <img src="{{ Storage::url($user->photo) }}" alt="{{ $user->name }}" >
                    </div>
                @endif

                <div class="text-center mt-10">
                    <a href="{{ route('users.edit', $user) }}" class="px-4 py-2 bg-blue-600 text-black rounded">Edit Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
