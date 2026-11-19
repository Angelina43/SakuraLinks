@extends('layouts.app')

@section('content')
    <div class="profile-links">
        @forelse($userUrls as $item)
            @if($item->url)
                <div class="copy-wrapper">
                    <input class="input short-result-input" type="text" value="{{ url($item->url->short_url) }}" readonly>
                    <img class="copy" src="{{ asset('images/copy.svg') }}" alt="copy" title="Скопировать">
                </div>
            @endif
        @empty
            <p>У вас пока нет созданных ссылок.</p>
        @endforelse

        <a href="{{ route('home') }}" class="button result-btn">На главную</a>
    </div>

    <div id="copyToast" class="copy-toast">Ссылка скопирована!</div>
@endsection
