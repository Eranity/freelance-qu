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

                <div class="form-group">
                    <label class="form-check-label">Количество экземпляров</label>
                    <input class="form-control" type="number" id="material-text" name="number_of_copies" placeholder="Please enter a number of copies" value="{{ $data->number_of_copies ?? '' }}">
                </div>

                <div class="form-group">
                    <label class="form-check-label">Формат</label>
                    <input class="form-control" type="text" id="material-text" name="format" placeholder="Please enter a format" value="{{ $data->format ?? '' }}">
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-check-label">Общее количество страниц</label>
                        <input class="form-control" type="number" id="material-text" name="total_pages" placeholder="Please enter a total_pages" value="{{ $data->total_pages ?? '' }}">
                    </div>

                    <div class="col-sm-4">
                        <label class="form-check-label">Из них цветные</label>
                        <input class="form-control" type="number" id="material-text" name="colored_count" placeholder="Please enter a colored_count" value="{{ $data->colored_count ?? '' }}">
                    </div>

                    <div class="col-sm-4">
                        <label class="form-check-label">Из них вклейки</label>
                        <input class="form-control" type="number" id="material-text" name="inserts_count" placeholder="Please enter a inserts_count" value="{{ $data->inserts_count ?? '' }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-check-label">Бумага на текст</label>
                        <input class="form-control" type="text" id="material-text" name="text_paper" placeholder="Please enter a text_paper" value="{{ $data->text_paper ?? '' }}">
                    </div>

                    <div class="col-sm-6">
                        <label class="form-check-label">Красочность</label>
                        <input class="form-control" type="text" id="material-text" name="text_paper_colorfulness" placeholder="Please enter a text_paper_colorfulness" value="{{ $data->text_paper_colorfulness ?? '' }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-check-label">Бумага на вклейки</label>
                        <input class="form-control" type="text" id="material-text" name="insert_paper" placeholder="Please enter a insert_paper" value="{{ $data->insert_paper ?? '' }}">
                    </div>

                    <div class="col-sm-6">
                        <label class="form-check-label">Красочность</label>
                        <input class="form-control" type="text" id="material-text" name="insert_paper_colorfulness" placeholder="Please enter a insert_paper_colorfulness" value="{{ $data->insert_paper_colorfulness ?? '' }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-check-label">Бумага на обложку</label>
                        <input class="form-control" type="text" id="material-text" name="cover_paper" placeholder="Please enter a cover_paper" value="{{ $data->cover_paper ?? '' }}">
                    </div>

                    <div class="col-sm-6">
                        <label class="form-check-label">Красочность</label>
                        <input class="form-control" type="text" id="material-text" name="cover_paper_colorfulness" placeholder="Please enter a cover_paper_colorfulness" value="{{ $data->cover_paper_colorfulness ?? '' }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-select">Вид переплета</label>
                    <select class="form-control" id="material-select" name="binding_type" size="1">
                        <option value="Мягкий" {{ !empty($data) && $data->binding_type == 'Мягкий' ? 'selected' : '' }}>Мягкий</option>
                        <option value="Твердый" {{ !empty($data) && $data->binding_type == 'Твердый' ? 'selected' : '' }}>Твердый</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-check-label">Цветные страницы</label>
                    <input class="form-control" type="text" id="material-text" name="colored_pages" placeholder="Please enter a colored_pages" value="{{ $data->colored_pages ?? '' }}">
                </div>

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
