@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div class="auth-card registration">
            <p>Ещё не зарегистрированы?</p>
            <a href="{{ route('register') }}" class="button auth-btn">Зарегистрироваться</a>
        </div>

        <div class="auth-card login">
            <p>Уже есть аккаунт?</p>
            <a href="{{ route('login') }}" class="button auth-btn">Авторизоваться</a>
        </div>
    </div>
@endsection
