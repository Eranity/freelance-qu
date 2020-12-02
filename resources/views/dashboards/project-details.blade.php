@extends('layouts.app')

@section('content')

    <div class= "col-12 d-flex justify-content-between">
        <div class= "col-8">
            <h1  class='mb-5'>{{ $project->name}}</h1>
            <h4 class="font-weight-bold mb-3">Описание проекта:</h4>
            <div class= "col-10 border">
                <h5>{{ $project->description}}</h5>
            </div>
            @auth
                @if(Auth::user()->role->name == 'executor')
                        <div>
                            <h4 class="font-weight-bold mb-3">Требование к специалисту</h4>
                            <div class= "col-10 border">

                            </div>
                        </div>
                        <div class = 'mb-5'>
                            <h4 class="font-weight-bold mb-3">Задачи</h4>
                            <div class= "col-10 border">
                                <ul>
                                    @foreach ($project->techCard->workTypes as $work)
                                        <li>{{$work->name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <form action="/project/respond{{ $project->id }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary">Подать заявку</button>
                        </form>
                @endif
        </div>
            <div class= "col-4 border" >
                <h3>Информация проекта</h3>
                <hr>
                <h5>Дата начала:  {{ $project->created_date}}</h5>
                <h5>Бюджет:  {{ $project->budget}} тг.</h5>
                <h5>Дата окончания:  {{ $project->completion_date}}</h5>
            </div>
    </div>

    @if(Auth::user()->role->name == 'project_manager' && count($users))
        <table class="table mt-5 col-12">
            <thead>
                <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Специальность</th>
                    <th scope="col">Рейтинг</th>
                    @if($project->status == 'Новый')
                        <th scope="col">Занятость</th>
                        <th scope="col">Статус заявки</th>
                        <th scope="col">Действия</th>
                    @endif
                    @if($project->status == 'В работе')
                        <th scope="col">Статус</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->display_name }}</td>
                    <td>{{ $user->rating }}</td>
                    @if($project->status == 'Новый')
                        <td>
                            <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: {{($user->hours ? $user->hours / $user->days : 0)/8*100}}%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="8">{{($user->hours ? $user->hours / $user->days : 0)}}</div>
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{100 - (($user->hours ? $user->hours / $user->days : 0)/8*100)}}%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="8">{{8 - ($user->hours ? $user->hours / $user->days : 0) }}</div>
                            </div>
                        </td>
                        <td class="d-flex justify-content-center">
                            @if ($user->executor_id && $user->approved)
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check-circle-fill" fill="green" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                            @elseif(($user->executor_id && !$user->approved))
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle-fill" fill="#FF9B00" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z"/>
                                </svg>
                            @else
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                </svg>
                            @endif
                        </td>
                        <td>
                            @if(!$user->approved)
                            <form action="/project/aproveResponse/{{ $project->id }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="executor_id" value="{{$user->id}}">
                                <button type="submit" class="btn btn-primary btn-sm">Принять</button>
                            <form>
                            @endif
                            @if($user->executor_id && !$user->approved)
                                <form action="/project/rejectResponse/{{ $project->id }}" method="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="executor_id" value="{{$user->id}}">
                                    <button type="submit" class="btn btn-secondary btn-sm">Отказать</button>
                                </form>
                            @endif
                        </td>
                    @endif
                    @if($project->status == 'В работе')
                        <td>
                               {{$user->status ? $user->status : 'Не начато'}}
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    @endauth
@endsection
