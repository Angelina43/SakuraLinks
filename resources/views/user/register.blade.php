@extends('layouts.app')

@section('content')
    <div class="auth-box">
        <h1 class="auth-title">Регистрация</h1>

        @if ($errors->any())
            <div class="auth-errors">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="auth-form" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="input-group">
                <label for="login">Введите логин:</label>
                <input class="input" type="text" id="login" placeholder="kuro_neko" name="username"
                       value="{{ old('login') }}" required>
            </div>

            <div class="input-group">
                <label for="password">Введите пароль:</label>
                <input class="input" type="password" id="password" placeholder="********" name="password" required>
            </div>

            <button type="submit" class="button auth-submit">Зарегестрироваться</button>
        </form>
        <a href="{{ route('home') }}" class="button result-btn">На главную</a>
    </div>
@endsection
