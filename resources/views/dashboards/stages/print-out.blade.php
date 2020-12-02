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
            <form action="/tech-cards/create" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>

@endsection
