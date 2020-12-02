@extends('layouts.app')

@section('content')
    <div class="block">
        <div class="block-header mb-3">
            <h5 class="">Редактирование</h5>
            <h3 class="block-title">{{$stage->name}}</h3>
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
            <form action="/tech-cards/{{$techCard->id}}/stage/work/{{$work->id}}/edit" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-check-label" for="work-types-select">Тип работы</label>
                    <select class="form-control" id="work-types-select" name="work_type_id" size="1" disabled>
                        <option disabled selected value={{ $work->workType->id }}>{{ $work->workType->name }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="unit_count_input">Количество единиц</label>
                    <input class="form-control" type="number" id="unit_count_input" name="total_pages" placeholder="Please enter a number of pages" value="{{ $work->unit_count }}" disabled>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="start_date_input">Дата начала</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="start_date_input" name="created_date" placeholder="Choose a date.." value="{{ $work->start_date->format('m/d/Y') }}" autocomplete="off" disabled>
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="deadline_input">Дедлайн</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="deadline_input" name="appointment_date" placeholder="Choose a date.." value="{{ $work->deadline->format('m/d/Y') }}" autocomplete="off" disabled>
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="example-datetimepicker7">Дата окончания</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="example-datetimepicker7" name="completed_date" placeholder="Choose a date.." value="{{ $work && $work->completed_date ? $work->completed_date->format('m/d/Y') : '' }}" autocomplete="off">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="responsible_input">Сотрудник</label>
                    <input class="form-control" type="text" id="responsible_input" name="responsible_id" placeholder="Please enter a number of pages" value="{{ $work->responsible->name }}" disabled>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-select">Статус</label>
                    <select class="form-control" id="material-select" name="status" size="1" required>
                        <!-- <option disabled selected value>...</option> -->
                        <option value="В процессе" {{ !empty($work) && $work->status == "В процессе" ? 'selected' : '' }}>В процессе</option>
                        <option value="Завершено" {{ !empty($work) && $work->status == "Завершено" ? 'selected' : '' }}>Завершено</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a class="btn btn-success" href="/tech-cards/{{ $techCard->id }}/stage/{{ $stage->id }}" class="text-white">Отмена</a>
            </form>
        </div>
    </div>
@endsection
