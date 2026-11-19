@extends('layouts.app')

@section('content')
    <div class="firstForm">
        <div class="copy-wrapper">
            <input class="input short-result-input" type="text" name="short_url" value="{{ session('short_url') }}" readonly>
            <img class="copy" src="{{ asset('images/copy.svg') }}" alt="copy" title="Скопировать">
        </div>

        <a href="{{route('user.profile')}}" class="button result-btn">Перейти в личный кабинет</a>

    </div>

    <div id="copyToast" class="copy-toast">Ссылка скопирована!</div>
@endsection
