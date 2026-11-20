@extends('layouts.app')

@section('content')
    <div class="profile-links">
        @forelse($userUrls as $item)
            @if($item->url)
                <div class="link-item">
                    <div class="link-row">
                        <div class="copy-wrapper">
                            <input class="input short-result-input" type="text" value="{{ url($item->url->short_url) }}" readonly>
                            <img class="copy" src="{{ asset('images/copy.svg') }}" alt="copy" title="Скопировать">
                        </div>

                        <form action="{{ route('url.destroy', $item->url->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="delete-btn js-open-delete-modal" title="Удалить">
                                <img src="{{ asset('images/delete.svg') }}" alt="delete">
                            </button>
                        </form>
                    </div>

                    @if($item->url->description_url)
                        <p class="link-description">{{ $item->url->description_url }}</p>
                    @endif
                </div>
            @endif
        @empty
            <p>У вас пока нет созданных ссылок.</p>
        @endforelse

        <a href="{{ route('home') }}" class="button result-btn">На главную</a>
    </div>

    <div id="copyToast" class="copy-toast">Ссылка скопирована!</div>

    <div id="deleteModal" class="modal-overlay">
        <div class="modal-box">
            <h3 class="modal-title">Удалить ссылку?</h3>
            <p class="modal-text">Это действие нельзя будет отменить.</p>
            <div class="modal-actions">
                <button type="button" id="cancelDeleteBtn" class="modal-btn modal-btn-cancel">Отмена</button>
                <button type="button" id="confirmDeleteBtn" class="modal-btn modal-btn-confirm">Удалить</button>
            </div>
        </div>
    </div>
@endsection
