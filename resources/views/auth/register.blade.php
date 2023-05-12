@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full space-y-8">
    <div>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        {{ __('Register') }}
      </h2>
    </div>
    <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="remember" value="true">
      <div class="rounded-md shadow-sm -space-y-px">
        <div>
          <label for="name" class="sr-only">{{ __('Name') }}</label>
          <input id="name" name="name" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Name" value="{{ old('name') }}" autocomplete="name" autofocus>
        </div>
        <div>
          <label for="email" class="sr-only">{{ __('Email Address') }}</label>
          <input id="email" name="email" type="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address" value="{{ old('email') }}" autocomplete="email">
        </div>
        <div>
          <label for="password" class="sr-only">{{ __('Password') }}</label>
          <input id="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password" autocomplete="new-password">
        </div>
        <div>
          <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
          <input id="password-confirm" name="password_confirmation" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Confirm password" autocomplete="new-password">
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <label class="ml-2 block text-sm text-gray-900" for="photo">
            {{ __('Photo') }}
          </label>
          <input class="ml-2" type="file" id="photo" name="photo" accept="image/*" class="h-10 py-2 px-4 text-sm text-white bg-blue-500 hover:bg-blue-400 rounded">
        </div>
      </div>

      <div>
        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          {{ __('Register') }}
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
