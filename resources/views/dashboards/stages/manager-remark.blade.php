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
            <form action="/tech-cards/{{ $techCard->id}}/stage/{{ $stage->id }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-check-label" for="material-textarea-large">Замечания</label>
                    <textarea class="form-control h-25" id="material-textarea-large" name="remark" rows="8" placeholder="Please add a comment" style="height:100%;">{{ $data->remark ?? ''}}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="example-datetimepicker7">Дата</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="example-datetimepicker7" name="date" placeholder="Choose a date.." value="{{ !empty($data) && $data->date ? $data->date->format('d/m/Y') : ''}}" autocomplete="off">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>

@endsection
