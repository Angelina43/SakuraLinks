@extends('layouts.app')

@section('content')
    @guest()
        <div class="auth-container">
            <div class="auth-card registration">
                <p>Ещё не зарегистрированы?</p>
                <a href="{{ route('register.index') }}" class="button auth-btn">Зарегистрироваться</a>
            </div>

            <div class="auth-card login">
                <p>Уже есть аккаунт?</p>
                <a href="{{ route('login.index') }}" class="button auth-btn">Авторизоваться</a>
            </div>
        </div>
    @endguest

    @auth
        <div class="auth-container">
            <div class="auth-card">
                <p>Здравствуйте, {{ auth()->user()->username }}!</p>
                <a href="{{route('convert')}}" class="button auth-btn">Сократить ссылку</a>
                <a href="{{route('user.profile')}}" class="button auth-btn">Личный кабинет</a>
            </div>

            <div class="auth-card">
                <form action="{{route('logout')}}" method="POST" class="card-logout-form">
                    @csrf
                    <button type="submit" class="button auth-btn">Выйти</button>
                </form>
            </div>
        </div>
    @endauth

@endsection
