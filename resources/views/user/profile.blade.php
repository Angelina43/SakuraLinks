@extends('layouts.app')

@section('content')
    <div class="profile-links">
        @if($userUrls->isNotEmpty())
            <div class="search-wrapper">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="linkSearchInput" class="search-input"
                       placeholder="Поиск по ссылке или описанию...">
                <button type="button" id="clearSearchBtn" class="clear-search-btn" title="Очистить">&times;</button>
            </div>
        @endif

        <div class="links-scroll-list" id="linksList">
            @forelse($userUrls as $item)
                @if($item->url)
                    <div class="link-item"
                         data-search="{{ mb_strtolower($item->url->short_url . ' ' . $item->url->name_url . ' ' . ($item->url->description_url ?? '')) }}">
                        <div class="link-row">
                            <div class="copy-wrapper">
                                <input class="input short-result-input" type="text"
                                       value="{{ url($item->url->short_url) }}" readonly>
                                <img class="copy" src="{{ asset('images/copy.svg') }}" alt="copy" title="Скопировать">
                            </div>

                            <div class="link-actions">
                                <button type="button"
                                        class="action-icon-btn js-open-edit-modal"
                                        title="Редактировать"
                                        data-action="{{ route('url.update', $item->url->id) }}"
                                        data-name="{{ $item->url->name_url }}"
                                        data-short="{{ $item->url->short_url }}"
                                        data-description="{{ $item->url->description_url }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>

                                <form action="{{ route('url.destroy', $item->url->id) }}" method="POST"
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-icon-btn js-open-delete-modal" title="Удалить">
                                        <img src="{{ asset('images/delete.svg') }}" alt="delete">
                                    </button>
                                </form>
                            </div>
                        </div>

                        @if($item->url->description_url)
                            <p class="link-description">{{ $item->url->description_url }}</p>
                        @endif
                    </div>
                @endif
            @empty
                <p>У вас пока нет созданных ссылок.</p>
            @endforelse

            <p id="noSearchResults" class="no-search-results" style="display: none;">По вашему запросу ничего не
                найдено.</p>
        </div>

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

    <div id="editModal" class="modal-overlay {{ session('edit_url_id') ? 'active' : '' }}">
        <div class="modal-box modal-box-edit">
            <h3 class="modal-title">Редактировать ссылку</h3>
            <form id="editUrlForm"
                  action="{{ session('edit_url_id') ? route('url.update', session('edit_url_id')) : '' }}"
                  method="POST"
                  class="edit-modal-form">
                @csrf
                @method('PUT')

                <label class="modal-label">Исходная ссылка</label>
                <input type="url"
                       name="name_url"
                       id="editNameUrl"
                       class="modal-input @error('name_url') is-invalid @enderror"
                       value="{{ old('name_url') }}"
                       required>
                @error('name_url')
                <span class="modal-error">{{ $message }}</span>
                @enderror

                <label class="modal-label">Короткий адрес</label>
                <input type="text"
                       name="short_url"
                       id="editShortUrl"
                       class="modal-input @error('short_url') is-invalid @enderror"
                       value="{{ old('short_url') }}"
                       required>
                @error('short_url')
                <span class="modal-error">{{ $message }}</span>
                @enderror

                <label class="modal-label">Описание</label>
                <textarea name="description_url"
                          id="editDescriptionUrl"
                          class="modal-input modal-textarea @error('description_url') is-invalid @enderror"
                          rows="3"
                          placeholder="Необязательно">{{ old('description_url') }}</textarea>
                @error('description_url')
                <span class="modal-error">{{ $message }}</span>
                @enderror

                <div class="modal-actions">
                    <button type="button" id="cancelEditBtn" class="modal-btn modal-btn-cancel">Отмена</button>
                    <button type="submit" class="modal-btn modal-btn-confirm">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
