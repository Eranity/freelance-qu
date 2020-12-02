@extends('layouts.app')

@section('content')
    <div class="block">
        <div class="block-header mb-3">
            <h3 class="block-title">{{$stage->name}}</h3>
            <a class="btn btn-success" href="/tech-cards/{{ $techCard->id }}" class="text-white">Назад</a>
        </div>

        @if (\Session::has('delete_success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('delete_success') !!}</li>
                </ul>
            </div>
        @endif

        @if (\Session::has('update_success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('update_success') !!}</li>
                </ul>
            </div>
        @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Вид работы</th>
                        <th scope="col">Ответственный</th>
                        <th scope="col">Количество единиц</th>
                        <th scope="col">Дата начала</th>
                        <th scope="col">Дедлайн</th>
                        <th scope="col">Дата окончания</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($stageWorks as $work)
                    <tr>
                        <th scope="row">{{ $work->id }}</th>
                        <td>{{ $work->workType->name }}</td>
                        <td>{{ $work->responsible->name }}</td>
                        <td>{{ $work->unit_count }}</td>
                        <td>{{ $work->start_date->format('m/d/Y') }}</td>
                        <td>{{ $work->deadline->format('m/d/Y') }}</td>
                        <td>{{ $work->completed_date ? $work->completed_date->format('m/d/Y') : '' }}</td>
                        <td>{{ $work->status }}</td>
                        <td>
                            <a class="btn btn-primary" href="/tech-cards/{{ $techCard->id }}/stage/work/{{ $work->id }}/edit" class="text-white"><i class="fa fa-pencil"></i></a>
                            {{-- <a class="btn btn-danger" href="/tech-cards/{{ $techCard->id }}" class="text-white"><i class="fa fa-trash"></i></a> --}}

                            <form class="d-inline" action="{{ route('tech-card.stage.work.delete', ['techCardId' => $techCard->id, 'workId' => $work->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                {{-- <a class="btn btn-danger" href="/tech-cards/{{ $techCard->id }}" class="text-white"><i class="fa fa-trash"></i></a> --}}

                            </form>
                        </td>
                        {{-- <td></td>
                        <td>
                            <button type="button" class="btn btn-success btn-block"><a href="/tech-cards/{{ $techCard->id }}" class="text-white">Перейти</a></button>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>

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
            <form action="/tech-cards/{{$techCard->id}}/stage/{{$stage->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-check-label" for="work-types-select">Тип работы</label>
                    <select class="form-control" id="work-types-select" name="work_type_id" size="1">
                        <option disabled selected value>...</option>
                        @foreach ($freeWorks as $work)
                            <option value="{{ $work->workType->id }}">{{ $work->workType->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="unit_count_input">Количество единиц</label>
                    <input class="form-control" type="number" id="unit_count_input" name="total_pages" placeholder="Please enter a number of pages" value="<?= $tech ?? '' ?>" disabled>
                </div>

                {{-- <div class="form-group">
                    <label class="form-check-label" for="material-select">Сотрудник</label>
                    <select class="form-control" id="material-select" name="project_manager_id" size="1">
                        @foreach ($projectManagers as $projectManager)
                            <option value="{{ $projectManager->id }}">{{ $projectManager->name }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="form-group">
                    <label class="form-check-label" for="start_date_input">Дата начала</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="start_date_input" name="created_date" placeholder="Choose a date.." value="<?= isset($date) ? $date->format('m/d/Y') : '' ?>" autocomplete="off" disabled>
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="deadline_input">Дедлайн</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="deadline_input" name="appointment_date" placeholder="Choose a date.." value="<?= isset($date) ? $date->format('m/d/Y') : '' ?>" disabled>
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="example-datetimepicker7">Дата окончания</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="example-datetimepicker7" name="completed_date" placeholder="Choose a date.." value="<?= isset($date) ? $date->format('m/d/Y') : '' ?>" >
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->role->name == 'initiator')
                    <div class="form-group">
                        <label class="form-check-label" for="responsible_input">Сотрудник</label>
                        <input class="form-control" type="text" id="responsible_input" name="responsible_id" placeholder="Please enter a number of pages" value="{{Auth::user()->name}}" disabled>
                    </div>
                @endif

                @switch(Auth::user()->role->name)
                    @case('project_manager')
                        @break
                    @case('executor')
                        <div class="form-group">
                            <label class="form-check-label" for="responsible_input">Сотрудник</label>
                            <input class="form-control" type="text" id="responsible_input" name="responsible_id" placeholder="Please enter a number of pages" value="{{Auth::user()->name}}" disabled>
                        </div>
                        @break

                    @default
                        @break
                @endswitch

                <div class="form-group">
                    <label class="form-check-label" for="material-select">Статус</label>
                    <select class="form-control" id="material-select" name="status" size="1" required>
                        <!-- <option disabled selected value>...</option> -->
                        <option value="В процессе">В процессе</option>
                        <option value="Завершено">Завершено</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var workTypesSelect = $("#work-types-select");
            var unitCountInput = $("#unit_count_input");
            var startDateInput = $("#start_date_input");
            var deadlineInput = $("#deadline_input");

            $(workTypesSelect).change(function() {
                switch ($(this).val()) {
                    @foreach ($techCard->works as $work)

                    case "{{ $work->work_type_id }}":
                        console.log('{{ $work->work_type_id }}')
                        unitCountInput.val('{{ $work->unit_count }}')
                        startDateInput.val('{{ $work->start_date }}')
                        deadlineInput.val('{{ $work->deadline }}')
                        break


                    @endforeach
                }



                // switch($(this).val()) {
            //         @foreach ($techCard->workTypes as $workType)
            //         case "{{ $workType->id }}"
            //         unitCountInput.val('{{$workType->pivot->unit_count}}')
            //         @endforeach
                // }
            })
        });
    </script>
@endsection
