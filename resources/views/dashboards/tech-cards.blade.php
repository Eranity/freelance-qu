@extends('layouts.app')

@section('content')

<button type="button" class="btn btn-primary mb-2"><a href="/tech-cards/create" class="text-white">Создать тех карту</a></button>

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">

        {{-- @if(Auth::user()->role->name == 'project_manager')
            <a class="nav-item nav-link active h3" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Новые</a>
            <a class="nav-item nav-link h3" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">В работе</a>
        @endif --}}


        @switch(Auth::user()->role->name)
            @case('initiator')
                <a class="nav-item nav-link active h3" id="nav-new-tab" data-toggle="tab" href="#nav-new" role="tab" aria-controls="nav-new" aria-selected="true">Новые</a>
                <a class="nav-item nav-link h3" id="nav-in-process-tab" data-toggle="tab" href="#nav-in-process" role="tab" aria-controls="nav-in-process" aria-selected="false">В работе</a>
                <a class="nav-item nav-link h3" id="nav-done-tab" data-toggle="tab" href="#nav-done" role="tab" aria-controls="nav-done" aria-selected="false">Завершенные</a>
                @break

            @case('project_manager')
                <a class="nav-item nav-link active h3" id="nav-new-tab" data-toggle="tab" href="#nav-new" role="tab" aria-controls="nav-new" aria-selected="true">Новые</a>
                <a class="nav-item nav-link h3" id="nav-in-process-tab" data-toggle="tab" href="#nav-in-process" role="tab" aria-controls="nav-in-process" aria-selected="false">В работе</a>
                <a class="nav-item nav-link h3" id="nav-done-tab" data-toggle="tab" href="#nav-done" role="tab" aria-controls="nav-done" aria-selected="false">Завершенные</a>
                @break
            @case('executor')
                <a class="nav-item nav-link active h3" id="nav-in-process-tab" data-toggle="tab" href="#nav-in-process" role="tab" aria-controls="nav-in-process" aria-selected="false">В работе</a>
                <a class="nav-item nav-link h3" id="nav-done-tab" data-toggle="tab" href="#nav-done" role="tab" aria-controls="nav-done" aria-selected="false">Завершенные</a>
                @break
        @endswitch

    </div>
</nav>

<div class="tab-content" id="nav-tabContent">

    @if(Auth::user()->role->name == 'project_manager' || Auth::user()->role->name == 'initiator')


    <div class="tab-pane fade show active border" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ФИО Автора</th>
                <th scope="col">Название книги</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата назначения</th>
                <th scope="col">Ответственный</th>
                <th scope="col">Отдел</th>
                <th scope="col">Статус</th>
                <th scope="col">Добавлен в отчет</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($newTechCards as $techCard)
            <tr>
                <th scope="row">{{ $techCard->id }}</th>
                <td>
                    <ul class="list-group">
                        @foreach ($techCard->authors as $author)
                        <li class="list-group-item">{{$author->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $techCard->book_name }}</td>
                <td>{{ $techCard->created_date }}</td>
                <td>{{ $techCard->appointment_date }}</td>
                <td>{{ $techCard->responsible->name }}</td>
                <td>{{ $techCard->department }}</td>
                <td>{{ $techCard->status }}</td>
                <td></td>
                <td>
                    <button type="button" class="btn btn-success btn-block"><a href="/tech-cards/{{ $techCard->id }}" class="text-white">Перейти</a></button>

                    @auth
                    @switch(Auth::user()->role->name)
                        @case('initiator')
                            <button type="button" class="btn btn-primary btn-block"><a href="/tech-cards/{{ $techCard->id }}/edit" class="text-white">Редактировать</a></button>
                            @break

                        @case('project_manager')
                            <button type="button" class="btn btn-primary btn-block"><a href="/project/create/{{ $techCard->id }}" class="text-white">Создать проект</a></button>
                            @break

                        @default
                    @endswitch
                @endauth
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    @endif

    @if(Auth::user()->role->name == 'project_manager' || Auth::user()->role->name == 'initiator')
    <div class="tab-pane fade" id="nav-in-process" role="tabpanel" aria-labelledby="nav-in-process-tab">
    @endif

    @if(Auth::user()->role->name == 'executor')
    <div class="tab-pane fade show active border" id="nav-in-process" role="tabpanel" aria-labelledby="nav-in-process-tab">
    @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ФИО Автора</th>
                <th scope="col">Название книги</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата назначения</th>
                <th scope="col">Ответственный</th>
                <th scope="col">Отдел</th>
                <th scope="col">Статус</th>
                <th scope="col">Добавлен в отчет</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($inProcessTechCards as $techCard)
            <tr>
                <th scope="row">{{ $techCard->id }}</th>
                <td>
                    <ul class="list-group">
                        @foreach ($techCard->authors as $author)
                        <li class="list-group-item">{{$author->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $techCard->book_name }}</td>
                <td>{{ $techCard->created_date }}</td>
                <td>{{ $techCard->appointment_date }}</td>
                <td>{{ $techCard->responsible->name }}</td>
                <td>{{ $techCard->department }}</td>
                <td>{{ $techCard->status }}</td>
                <td></td>
                <td>
                    <button type="button" class="btn btn-success btn-block"><a href="/tech-cards/{{ $techCard->id }}" class="text-white">Перейти</a></button>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div class="tab-pane fade" id="nav-done" role="tabpanel" aria-labelledby="nav-done-tab">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ФИО Автора</th>
                <th scope="col">Название книги</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата назначения</th>
                <th scope="col">Ответственный</th>
                <th scope="col">Отдел</th>
                <th scope="col">Статус</th>
                <th scope="col">Добавлен в отчет</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($doneTechCards as $techCard)
            <tr>
                <th scope="row">{{ $techCard->id }}</th>
                <td>
                    <ul class="list-group">
                        @foreach ($techCard->authors as $author)
                        <li class="list-group-item">{{$author->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $techCard->book_name }}</td>
                <td>{{ $techCard->created_date }}</td>
                <td>{{ $techCard->appointment_date }}</td>
                <td>{{ $techCard->responsible->name }}</td>
                <td>{{ $techCard->department }}</td>
                <td>{{ $techCard->status }}</td>
                <td></td>
                <td>
                    <button type="button" class="btn btn-success btn-block"><a href="/tech-cards/{{ $techCard->id }}" class="text-white">Перейти</a></button>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>

@endsection
