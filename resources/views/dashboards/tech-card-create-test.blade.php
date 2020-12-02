@extends('layouts.app')

@section('content')
    <div class="block">
        <div class="block-header">
            @if(!empty($update))
            <h5 class="">Редактирование</h5>
            @endif
            <h3 class="block-title">Технологическая карта</h3>
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

        @if (\Session::has('udpate_success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('udpate_success') !!}</li>
                </ul>
            </div>
        @endif

        <div class="block-content block-content-narrow">
            @if(empty($update))
            <form action="/tech-cards/create" method="POST">
            @else
            <form action="/tech-cards/{{$techCard->id ?? ''}}/edit" method="POST">
            @endif
                @csrf
                <div class="form-group">
                    <label class="form-check-label" for="material-text">Номер заказа</label>
                    <input class="form-control" type="text" id="material-text" name="order_number"
                           placeholder="Please enter number of order" value="{{ $techCard->order_number ?? '' }}"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-text">Номер ИБ</label>
                    <input class="form-control" type="text" id="material-text" name="ib_number"
                           placeholder="Please enter number of ib"
                           value="{{ $techCard->ib_number ?? '' }}">
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-text">ISBN</label>
                    <input class="form-control" type="text" id="material-text" name="isbn"
                           placeholder="Please enter number of isbn" value="{{ $techCard->isbn ?? '' }}"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-text">Название книги</label>
                    <input class="form-control" type="text" id="material-text" name="book_name"
                           placeholder="Please enter a book name" value="{{ $techCard->book_name ?? '' }}"
                           required>
                </div>

                {{-- <div class="form-group">
                    <!-- <label class="form-check-label" for="authors-select-enableFiltering">Автор</label>
                    <select class="form-control" id="authors-select-enableFiltering" name="author_id" size="1" multiple="multiple"> -->
                    <label class="form-check-label" for="material-select">Автор</label>
                    <select class="form-control" id="material-select" name="author_id" size="1">
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="form-group">
                    <label class="form-check-label h4">Авторы</label>
                </div>

                <div id="authors">
                    @if(!empty($techCard))
                        @foreach ($techCard->authors as $techCardAuthor)
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <select class="form-control" id="material-select" name="authors[]" size="1">
                                    <option disabled selected value>...</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}" {{ $author->id == $techCardAuthor->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger delete-author"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>

                <div class="form-group mb-5">
                    <button type="button" class="btn btn-success" id="add-author"><i class="fa fa-plus"></i></button>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-select">Вид издания</label>
                    <select class="form-control" id="material-select" name="edition_id" size="1">
                        @foreach ($editionTypes as $editionType)
                            <option value="{{ $editionType->id }}" {{ !empty($techCard) && $editionType->id == $techCard->edition_id ? 'selected' : '' }}>{{ $editionType->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <p class="form-check-label">Язык</p>

                    <!-- <label class="form-check-label" for="langCheckbox1">Казахский</label> -->

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="langCheckbox1" name="languages[]" value="Казахский" {{ !empty($techCard) && $techCard->isLanguage('Казахский') ? 'checked' : '' }}>
                        <label class="form-check-label" for="langCheckbox1">Казахский</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="langCheckbox2" name="languages[]" value="Русский" {{ !empty($techCard) && $techCard->isLanguage('Русский') ? 'checked' : '' }}>
                        <label class="form-check-label" for="langCheckbox2">Русский</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="langCheckbox3" name="languages[]" value="Английский" {{  !empty($techCard) && $techCard->isLanguage('Английский') ? 'checked' : '' }}>
                        <label class="form-check-label" for="langCheckbox3">Английский</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="langCheckbox4" name="languages[]" value="Другой" {{ !empty($techCard) && $techCard->isLanguage('Другой') ? 'checked' : '' }}>
                        <label class="form-check-label" for="langCheckbox4">Другой</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-select">Оплата</label>
                    <select class="form-control" id="material-select" name="payment" size="1">
                        <option value="Университет" {{ !empty($techCard) && $techCard->payment == 'Университет' ? 'selected' : '' }}>Университет</option>
                        <option value="Автор" {{ !empty($techCard) && $techCard->payment == 'Автор' ? 'selected' : '' }}>Автор</option>
                        <option value="Грант" {{ !empty($techCard) && $techCard->payment == 'Грант' ? 'selected' : '' }}>Грант</option>
                        <option value="Университет-Автор" {{ !empty($techCard) && $techCard->payment == 'Университет-Автор' ? 'selected' : '' }}>Университет-Автор</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-select">Рукопись</label>
                    <select class="form-control" id="material-select" name="manuscript" size="1">
                        <option value="Электронный вариант" {{ !empty($techCard) && $techCard->manuscript == 'Электронный вариант' ? 'selected' : '' }}>Электронный вариант</option>
                        <option value="Бумажный вариант" {{ !empty($techCard) && $techCard->manuscript == 'Бумажный вариант' ? 'selected' : '' }}>Бумажный вариант</option>
                        <option value="Электронный и бумажный" {{ !empty($techCard) && $techCard->manuscript == 'Электронный и бумажный' ? 'selected' : '' }}>Электронный и бумажный</option>
                        <option value="нет" {{ !empty($techCard) && $techCard->manuscript == 'нет' ? 'selected' : '' }}>нет</option>
                    </select>
                </div>

                <div class="form-group mb-5">
                    <label class="form-check-label">Темплан</label>
                    <input class="form-control" type="text" id="material-text" name="templan" placeholder="Please enter a templan" value="{{ $techCard->templan ?? '' }}">
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-check-label" for="material-text">РИСО: протокол №</label>
                        <input class="form-control" type="text" id="material-text" name="riso_protocol_number" placeholder="Please enter a RISO number" value="{{ $techCard->riso_protocol_number ?? '' }}">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-check-label" for="riso_protocol_date">от</label>
                        <div class="input-group mb-2">
                            <input class="form-control datepicker" type="text" id="riso_protocol_date" name="riso_protocol_date" placeholder="Choose a date.." value="{{ !empty($techCard) && $techCard->riso_protocol_date ? $techCard->riso_protocol_date->format('m/d/Y') : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-check-label" for="material-text">Ученый совет КазНУ: протокол №</label>
                        <input class="form-control" type="text" id="material-text" name="ac_protocol_number" placeholder="Please enter a RISO number" value="{{ $techCard->ac_protocol_number ?? '' }}">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-check-label" for="ac_protocol_date">от</label>
                        <div class="input-group mb-2">
                            <input class="form-control datepicker" type="text" id="ac_protocol_date" name="ac_protocol_date" placeholder="Choose a date.." value="{{ !empty($techCard) && $techCard->ac_protocol_date ? $techCard->ac_protocol_date->format('m/d/Y') : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-5">
                    <div class="col-sm-6">
                        <label class="form-check-label" for="material-text">РУМС: протокол №</label>
                        <input class="form-control" type="text" id="material-text" name="rums_protocol_number" placeholder="Please enter a RISO number" value="{{ $techCard->rums_protocol_number ?? '' }}">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-check-label" for="rums_protocol_date">от</label>
                        <div class="input-group mb-2">
                            <input class="form-control datepicker" type="text" id="rums_protocol_date" name="rums_protocol_date" placeholder="Choose a date.." value="{{ !empty($techCard) && $techCard->rums_protocol_date ? $techCard->rums_protocol_date->format('m/d/Y') : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-check-label">Количество страниц</label>
                        <input class="form-control" type="number" id="material-text" name="total_pages" placeholder="Please enter a number of pages" value="{{ $techCard->total_pages ?? '' }}">
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label">Количество знаков</label>
                        <input class="form-control" type="number" id="material-text" name="total_symbols" placeholder="Please enter a number of chars" value="{{ $techCard->total_symbols ?? '' }}">
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label">Объем в а.л.</label>
                        <input class="form-control" type="number" id="material-text" name="author_sheet_volume" placeholder="Please enter a size" value="{{ $techCard->author_sheet_volume ?? '' }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="form-check-label" for="material-text">Формат</label>
                        <input class="form-control" type="text" id="material-text" name="format" placeholder="Please enter a format" value="{{ $techCard->format ?? '' }}">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-check-label" for="material-text">Кегль</label>
                        <input class="form-control" type="number" id="material-text" name="kegel" placeholder="Please enter a kegl number" value="{{ $techCard->kegel ?? '' }}">
                    </div>
                </div>

                <div class="form-group row mb-5">
                    <div class="col-sm-6">
                        <label class="form-check-label" for="material-select">Сложность редактура</label>
                        <select class="form-control" id="material-select" name="editing_complexity" size="1">
                            <option value="1" {{ !empty($techCard) && $techCard->editing_complexity == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ !empty($techCard) && $techCard->editing_complexity == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ !empty($techCard) && $techCard->editing_complexity == '3' ? 'selected' : '' }}>3</option>
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="form-check-label" for="material-select">Сложность верстка</label>
                        <select class="form-control" id="material-select" name="layout_complexity" size="1">
                            <option value="1" {{ !empty($techCard) && $techCard->layout_complexity == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ !empty($techCard) && $techCard->layout_complexity == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ !empty($techCard) && $techCard->layout_complexity == '3' ? 'selected' : '' }}>3</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label h4">Работы</label>
                </div>

                <div id="work-types">
                    @if(!empty($techCard))
                        @foreach ($techCard->workTypes as $work)
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="form-check-label" for="material-select">Тип работы</label>
                                <select class="form-control" id="material-select" name="works[{{ $loop->index}}][id]" size="1">
                                    <option disabled selected value>...</option>
                                    @foreach ($workTypes as $workType)
                                        <option value="{{ $workType->id }}" {{ $work->id == $workType->id ? 'selected' : '' }}>{{ $workType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-check-label" for="material-text">Количество единиц</label>
                            <input class="form-control" type="number" id="material-text" name="works[{{ $loop->index}}][unit_count]" placeholder="Please enter a work unit count" value="{{ $work->pivot->unit_count ?? ''}}">
                            </div>

                            <div class="col-sm-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger delete-work-type"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>


                <div class="form-group mb-5">
                    <button type="button" class="btn btn-success" id="add-work-type"><i class="fa fa-plus"></i></button>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-text">ИООТ</label>
                    <input class="form-control" type="text" id="material-text" name="ioot" placeholder="Please enter" value="{{ $techCard->ioot ?? ''}}">
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-textarea-large">Заключение доредакционной экспертизы</label>
                    <textarea class="form-control h-25" id="material-textarea-large" name="conclusion" rows="8" placeholder="Please add a comment" style="height:100%;">{{ $techCard->conclusion ?? ''}}</textarea>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="form-check-label" for="material-text">Тираж(автор)</label>
                        <input class="form-control" type="number" id="material-text" name="circulation_author" placeholder="Please enter a number of book" value="{{ $techCard->circulation_author ?? ''}}">
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label" for="material-text">Тираж(университет)</label>
                        <input class="form-control" type="number" id="material-text" name="circulation_university" placeholder="Please enter a number of book" value="{{ $techCard->circulation_university ?? ''}}">
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label" for="material-text">из них в библиотеку</label>
                        <input class="form-control" type="number" id="material-text" name="circulation_library" placeholder="Please enter a number of book" value="{{ $techCard->circulation_library ?? ''}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-select">Сотрудник</label>
                    <select class="form-control" id="material-select" name="project_manager_id" size="1">
                        @foreach ($projectManagers as $projectManager)
                            <option value="{{ $projectManager->id }}" {{ !empty($techCard) && $techCard->project_manager_id == $projectManager->id ? 'selected' : '' }}>{{ $projectManager->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="created_date">Дата создания</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="created_date" name="created_date" placeholder="Choose a date.." value="{{ !empty($techCard) && $techCard->created_date ? $techCard->created_date->format('m/d/Y') : ''}}">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="appointment_date">Дата назначения</label>
                    <div class="input-group mb-2">
                        <input class="form-control datepicker" type="text" id="appointment_date" name="appointment_date" placeholder="Choose a date.." value="{{ !empty($techCard) && $techCard->created_date ? $techCard->appointment_date->format('m/d/Y') : ''}}">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="material-select">Статус</label>
                    <select class="form-control" id="material-select" name="status" size="1" required>
                        <!-- <option disabled selected value>...</option> -->
                        <option value="Создано" {{ !empty($techCard) && $techCard->status == "Создано" ? 'selected' : '' }}>Создано</option>
                        <option value="Оформлена" {{ !empty($techCard) && $techCard->status == "Оформлена" ? 'selected' : '' }}>Оформлена</option>
                    </select>
                </div>

                @if(!empty($update))
                <button type="submit" class="btn btn-primary">Сохранить</button>
                @else
                <button type="submit" class="btn btn-primary">Создать</button>
                @endif
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var max_fields = 10;

            var worksWrapper = $("#work-types");
            var add_work_button = $("#add-work-type");
            var delete_work_button = $(".delete-work-type");

            var authorsWrapper = $('#authors')
            var add_author_button = $("#add-author");
            var delete_author_button = $(".delete-author");
            // var x = 1;

            $(add_work_button).click(function(e){
                e.preventDefault();
                var x = $('#work-types select').length;

                if(x < max_fields){
                    console.log({x})
                    $(worksWrapper).append('<div class="form-group row">\n' +
                        '                        <div class="col-sm-6">\n' +
                        '                            <label class="form-check-label" for="material-select">Тип работы</label>\n' +
                        '                            <select class="form-control" id="material-select" name="works[' + (x)+ '][id]" size="1">\n' +
                        '                                <option disabled selected value>...</option>\n' +
                        '                                @foreach ($workTypes as $workType)\n' +
                        '                                    <option value="{{ $workType->id }}">{{ $workType->name }}</option>\n' +
                        '                                @endforeach\n' +
                        '                            </select>\n' +
                        '                        </div>\n' +
                        '\n' +
                        '                        <div class="col-sm-4">\n' +
                        '                            <label class="form-check-label" for="material-text">Количество единиц</label>\n' +
                        '                            <input class="form-control" type="number" id="material-text" name="works[' + (x)+ '][unit_count]" placeholder="Please enter a work unit count">\n' +
                        '                        </div>\n' +
                        '\n' +
                        '                        <div class="col-sm-1 d-flex align-items-end">\n' +
                        '                            <button type="button" class="btn btn-danger delete-work-type"><i class="fa fa-minus"></i></button>\n' +
                        '                        </div>\n' +
                        '                    </div>'); //add input box


                    $(".delete-work-type").click(onDeleteWorkButtonClick)

                } else {
                    alert('You Reached the limits')
                }
            });

            $(".delete-work-type").click(onDeleteWorkButtonClick)

            function onDeleteWorkButtonClick(e) {
                e.preventDefault();
                console.log($(this).parent());
                $(this).parent().parent('div').remove();
                // x--;
                var x = $('#work-types select').length;

                console.log('awdaa')

                $('#work-types select').each((i, select) => {
                    select.name = select.name.replace(/[0-9]+/g, i);
                })

                $('#work-types input').each((i, input) => {
                    input.name = input.name.replace(/[0-9]+/g, i);
                })
            }

            $(add_author_button).click(function(e){
                e.preventDefault();
                var x = $('#authors select').length;

                if(x < max_fields){
                    console.log({x})
                    $(authorsWrapper).append('<div class="form-group row">\n' +
                        '                            <div class="col-sm-6">\n' +
                        '                                <select class="form-control" id="material-select" name="authors[]" size="1">\n' +
                        '                                    <option disabled selected value>...</option>\n' +
                        '                                    @foreach ($authors as $author)\n' +
                        '                                        <option value="{{ $author->id }}">{{ $author->name }}</option>\n' +
                        '                                    @endforeach\n' +
                        '                                </select>\n' +
                        '                            </div>\n' +
                        '\n' +
                        '                            <div class="col-sm-1 d-flex align-items-end">\n' +
                        '                                <button type="button" class="btn btn-danger delete-author"><i class="fa fa-minus"></i></button>\n' +
                        '                            </div>\n' +
                        '                        </div>'); //add input box


                    $(".delete-author").click(onDeleteAuthorButtonClick)

                } else {
                    alert('You Reached the limits')
                }
            });

            $(".delete-author").click(onDeleteAuthorButtonClick)

            function onDeleteAuthorButtonClick(e) {
                e.preventDefault();
                $(this).parent().parent('div').remove();
            }

        });
    </script>
@endsection
