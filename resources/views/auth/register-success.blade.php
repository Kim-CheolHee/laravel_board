@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-5">
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg md:max-w-5xl">
        <div class="md:flex ">
            <div class="w-full p-4 px-5 py-5">
                <div class="text-center mb-10">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-2">{{ __('회원등록에 성공하였습니다!') }}</h1>
                    <p class="leading-relaxed tracking-wide text-sm text-indigo-500 font-semibold">{{ __('환영합니다!') }}, {{ session('registered_user_name') }}! {{ __('님.') }}</p>
                </div>

                @if(session('registered_user_photo'))
                    <div class="flex justify-center">
                        <img class="h-48 w-48 rounded-full object-cover" src="{{ asset(session('registered_user_photo')) }}" alt="{{ session('registered_user_name' ) }}">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
