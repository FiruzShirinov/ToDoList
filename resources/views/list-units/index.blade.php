@extends('layouts.app')

@section('content')
<div class="container">

    @if($listUnitsSharedWithMe->isNotEmpty())
        <h3 class="mb-2">Расшаренные списки</h3>

        <div class="card shadow-sm border-0 mb-4">
            <ul class="list-group list-group-flush">
                @foreach ($listUnitsSharedWithMe as $list)
                    <li class="list-group-item bg-white d-flex justify-content-between">
                        <a href="{{ route('items.index', $list) }}" class="link-dark link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">
                            <span class="list-name">{{ $list->name }}</span>
                        </a>
                        <span><small><em>расшарил {{ $list->pivot->sharedBy->name }}</em></small></span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <h3 class="mb-2">Мои списки</h3>

    <div class="card shadow-sm border-0 mb-4">
        <ul class="list-group list-group-flush list-all" data-path="/list-units">
            @foreach ($listUnits as $list)
                <li class="list-group-item bg-white d-flex justify-content-between align-items-center">
                    <a href="{{ route('items.index', $list) }}" class="link-dark link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover">
                        <span class="list-name">{{ $list->name }}</span>
                        <small><span class="me-2 shared-with">(Элементов {{ $list->items()->count() }})</span></small>
                    </a>

                    <div class="d-flex end-column">
                        @if ($list->sharedWithUsers()->exists())
                            <small><em><span class="me-2 shared-with">расшарен с {{ $list->sharedWithUsers->implode('name', ', ') }}</span></em></small>
                        @endif
                        <div class="edit-menu" style="cursor: pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                            </svg>
                        </div>
                        <div class="edit-buttons align-items-center" style="display: none" data-list_unit_id="{{ $list->id }}">
                            <div class="edit text-primary me-1" style="cursor: pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </div>
                            <div class="dropdown me-1">
                                <a class="btn btn-link p-0 share" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                        <path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu p-0">

                                </ul>
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
