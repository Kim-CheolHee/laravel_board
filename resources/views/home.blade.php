@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-5">
    <div class="flex justify-center">
        <div class="max-w-md w-full bg-white shadow-lg rounded-lg">
            <div class="p-4 border-b">
                <h2 class="sm:text-2xl text-s font-semibold">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500">
                    You are in the control panel.
                </p>
            </div>
            <div>
                @if (session('status'))
                    <div class="alert bg-green-500 text-white px-4 py-2 mt-2" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="text-center py-6">
                    <p class="text-2xl text-gray-800 font-semibold">{{ __('You are logged in!') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
