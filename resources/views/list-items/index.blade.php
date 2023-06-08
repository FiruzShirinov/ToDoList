@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between">
        <div class="mb-2 d-flex align-items-center w-75">
            <h3 class="mb-0 w-100">Элементы списка {{ $listUnit->name }}</h3>
            <select class="text-bg-light" name="tags_filter[]" id="tags_filter" multiple data-allow-clear="true" data-show-all-suggestions="true">
                <option selected disabled hidden value="">Введите теги для фильтрации</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->slug }}">{{ $tag->slug }}</option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('list-units') }}" class="btn btn-link link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">Назад</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <ul class="list-group list-group-flush list-all" data-path="/list-items/{{ $listUnit->id }}">
            @foreach ($listUnit->items as $item)
            <li class="list-group-item bg-white d-flex justify-content-between align-items-center" data-list_id="{{ $item->id }}">
                <label class="btn btn-file" title="@if($item->image()->exists())Изменить картинку @else()Добавить картинку@endif">
                    <img src="@if($item->image()->exists()){{ Storage::disk('local')->url("{$item->image->url}") }}@endif" alt="" class="bg-light img-thumbnail object-fit-cover" style="width: 150px; height: 150px; image: cover">
                    <input type="file" name="image" data-id="{{ $item->id }}" style="display: none">
                </label>
                @if($item->image()->exists())
                    <div class="text-light text-bg-danger rounded px-1 delete-image" title="Удалить картинку" style="cursor:pointer; position: absolute; top: 130px; left: 140px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </div>
                @endif
                <span class="list-name w-25">{{ $item->name }}</span>
                <div class="d-flex align-items-center w-50">
                    <select class="order-3" id="tags-input" name="tags[]" data-selected="{{ $item->tags->pluck('slug') }}" multiple data-allow-new="true" data-allow-clear="true" data-show-all-suggestions="true">
                        <option selected disabled hidden value="">Введите теги</option>
                        @forelse($item->tags as $tag)
                            <option value="{{ $tag->slug }}" selected="selected">{{ $tag->slug }}</option>
                        @empty
                        @endforelse
                    </select>
                    <div class="tag text-success order-2 ms-2" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </div>
                </div>
                <div class="d-flex end-column">
                    <div class="edit-menu" style="cursor: pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                        </svg>
                    </div>
                    <div class="edit-buttons" style="display: none" data-list_unit_id="{{ $item->id }}">
                        <div class="edit text-primary me-1" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </div>
                        <div class="delete text-danger me-1" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                            </svg>
                        </div>
                        <div class="close-edit-menu" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="card" style="border-style: dashed">
        <div class="card-body py-2 create-list-unit" style="cursor: pointer">
            Добавить
        </div>
    </div>

</div>
@endsection
