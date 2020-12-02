@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Название книги</th>
        <th scope="col">Дата создания</th>
        <th scope="col">Ответственный</th>
        <th scope="col">Отдел</th>
        <th scope="col">Статус</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <th scope="row">{{ $techCard->id }}</th>
        <td>{{ $techCard->book_name }}</td>
        <td>{{ $techCard->created_date }}</td>
        <td>{{ $techCard->responsible->name }}</td>
        <td>{{ $techCard->department }}</td>
        <td>{{ $techCard->status }}</td>
        <td>
            <ul class="list-group">
                @foreach ($stages as $stage)
                <li class="list-group-item">
                    <a class="btn btn-success btn-block" href="/tech-cards/{{ $techCard->id }}/stage/{{$stage->id}}" class="text-white">{{$stage->name}}</a>
                </li>
                @endforeach
            </ul>
        </td>
    </tr>

    </tbody>
</table>
@endsection
