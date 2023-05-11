@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('회원등록 성공') }}</div>

                <div class="card-body">
                    <p>환영합니다, {{ session('registered_user_name') }}님! 회원등록에 성공하였습니다.</p>
                    @if(session('registered_user_photo'))
                        <img src="{{ asset('storage/' . session('registered_user_photo')) }}" alt="{{ session('registered_user_name') }}" width="300">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
