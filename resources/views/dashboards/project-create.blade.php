@extends('layouts.app')

@section('content')


    <div  class="block">
        <div class="block-header">
            <h3 class="block-title">Проект</h3>
        </div>
        <div class="block-content block-content-narrow">
        <form action = '/project/create/{{$techCard->id}}' method="POST">
                <div class="form-group">
                    <label class="form-check-label" for="material-text">Название проекта</label>
                    <input name="name" readonly id="material-text" class='form-control ml-2' value="{{ $techCard->book_name}}"></input>

                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="form-check-label" for="material-text">Описание проекта</label>
                    <input class="form-control ml-2" type="text" id="material-text" name="description"
                                        placeholder="Введите описание">
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="material-text">Бюджет:</label>
                    <input name="budget" readonly id="material-text" class='ml-2' value="{{ $budget }}"/>
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="material-text">Дата создания:</label>
                    <input name="created_date" readonly id="material-text" class='ml-2' value="{{  now() }}"></input>
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="material-text">Дата окончания:</label>
                    <input id="datepicker" name ='deadline' class="datepicker form-control ml-2" type="text">
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="material-text">Авторы:</label>
                    @foreach ($techCard->authors as $author)
                        <p id="material-text" class="ml-2">{{$author->name}}</p>
                    @endforeach

                </div>
                <div class="form-group">
                    <label class="form-check-label" for="material-text">Виды работ:</label>

                    <table class="table">
                        <thead>
                        <tr >
                            <th scope="col">Название работы</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Сумма</th>
                            <th scope="col">Единица</th>
                            <th scope="col">Время в часах</th>
                            <th scope="col">Дата начала</th>
                            <th scope="col">Дэдлайн</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($techCard->workTypes as $key => $workType)
                                <tr>
                                    <td>{{ $workType->name }}</td>
                                    <td>{{ $workType->pivot->unit_count }}</td>
                                    <td>{{ $workType->unit_price }}</td>
                                    <td>{{ $workType->pivot->unit_count * $workType->unit_price }}</td>
                                    <td>{{ $workType->unit_type }}</td>
                                    <td><input class="form-control" type="text" name="works[{{$key}}][hours]"/></td>
                                    <input class="form-control" type="text" hidden name="works[{{$key}}][id]" value="{{ $workType->pivot->id }}"/>
                                    <td><input class="form-control datepicker" type="text" name="works[{{$key}}][start_date]" value=""/></td>
                                    <td><input class="form-control datepicker" type="text" name="works[{{$key}}][deadline]" value=""/></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                {{-- <div class="form-group">
                    <label class="form-check-label" for="material-text">Дата окончания:</label>
                    <input id="datepicker" name ='deadline' class="datepicker form-control ml-2" type="text">
                </div>
                <div class="form-groups d-flex align-items-center justify-content-start">
                    <label class="form-check-label" for="material-text">Срочно</label>
                    <input name ='is_rush' data-val="true"  value="true" type="checkbox"/>
                </div> --}}
                <button type="submit" class="btn btn-primary">Создать проект</button>

        </form>
    </div>

@endsection
