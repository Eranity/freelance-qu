@extends('layouts.app')

@section('content')
<div class="block">
    <div class="block-header">
        <h3 class="block-title">Создание заявки</h3>
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
        <form action="/applications" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-check-label">Наименования</label>
                <input class="form-control" type="text" id="material-text" name="book_name" placeholder="Please enter a book_name" value="{{ $data->book_name ?? '' }}">
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="budget_type" id="inlineRadio1" value="Грант">
                <label class="form-check-label" for="inlineRadio1">Грант</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="budget_type" id="inlineRadio2" value="За мой счет">
                <label class="form-check-label" for="inlineRadio2">За мой счет</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="budget_type" id="inlineRadio3" value="За счет университета">
                <label class="form-check-label" for="inlineRadio3">За счет университета</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Ознакомлен и согласен с соглашением
                </label>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Прикрепить файл</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>
                </div>
              </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>
@endsection
