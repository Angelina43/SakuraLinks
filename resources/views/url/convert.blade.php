@extends('layouts.app')

@section('content')
    <div class="firstForm">
        <form action="{{ route('original_url') }}" method="POST">
            @csrf
            <input class="input" type="text" name="original_url" placeholder="Вставьте сюда ссылку">
            <div class="radio-container">
                <label class="switch">
                    <input type="checkbox" id="checkbox" onchange="toggleInput()">
                    <span class="slider round"></span>
                </label>
                <label class="slider-text">Свой вариант</label>
            </div>
            <input class="input second" placeholder="Напишите новый URL" id="input" name="user_url">
            <input class="button" type="submit" value="Обработать">
        </form>
    </div>
@endsection
