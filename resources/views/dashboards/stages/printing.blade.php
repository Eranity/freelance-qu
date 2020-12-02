@extends('layouts.app')

@section('content')
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">{{$stage->name}}</h3>
            <a class="btn btn-success" href="/tech-cards/{{ $techCard->id }}" class="text-white">Назад</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="block-content block-content-narrow">
            <form action="/tech-cards/{{ $techCard->id }}/stage/{{$stage->id}}" method="POST">
                @csrf
                @switch(Auth::user()->role->name)
                    @case('project_manager')
                        @break
                    @case('executor')
                        <div class="form-group">
                            <label class="form-check-label" for="responsible_input">Сотрудник</label>
                            <input class="form-control" type="text" id="responsible_input" name="responsible_id" placeholder="Please enter a number of pages" value="{{$techCard->responsible->name}}" disabled>
                        </div>
                        @break

                    @default
                        @break
                @endswitch

                <div class="form-group">
                    <label class="form-check-label" for="start_date_input">Дата начала</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="start_date_input" name="start_date" placeholder="Choose a date.." value="{{ !empty($data) && $data->start_date ? $data->start_date->format('d/m/Y') : ''}}" autocomplete="off">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="example-datetimepicker7">Дата окончания</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="example-datetimepicker7" name="completed_date" placeholder="Choose a date.." value="{{ !empty($data) && $data->completed_date ? $data->completed_date->format('d/m/Y') : ''}}" autocomplete="off">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-select">Статус</label>
                    <select class="form-control" id="material-select" name="status" size="1" required>
                        <!-- <option disabled selected value>...</option> -->
                        <option value="В процессе" {{ !empty($data) && $data->status == "В процессе" ? 'selected' : '' }}>В процессе</option>
                        <option value="Завершено" {{ !empty($data) && $data->status == "Завершено" ? 'selected' : '' }}>Завершено</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
