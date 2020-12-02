@extends('layouts.app')

@section('content')
    <div class="block">
        <div class="block-header">
            <ul class="block-options">
                <li>
                    <button type="button"><i class="si si-settings"></i></button>
                </li>
            </ul>
            <h3 class="block-title">Технологическая карта</h3>
        </div>
        <div class="block-content block-content-narrow">
            
            <form class="form-horizontal push-10-t" enctype="multipart/form-data" action="" method="post">
                <div class="form-group <?= isset($data['errors']['order']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="order_number"
                                   placeholder="Please enter number of order"
                                   value="<?= $data['data']['order_number'] ?? '' ?>">
                            <label for="material-text">Номер заказа</label>
                            <?= isset($data['errors']['order']) ? '<div class="help-block text-right">' . $data['errors']['order'] . '</div>' : '' ?>
                        </div>
                    </div>

                </div>
                <div class="form-group <?= isset($data['errors']['ib']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="ib_number"
                                   placeholder="Please enter number of ib"
                                   value="<?= $data['data']['ib_number'] ?? '' ?>">
                            <label for="material-text">Номер ИБ</label>
                            <?= isset($data['errors']['ib']) ? '<div class="help-block text-right">' . $data['errors']['ib'] . '</div>' : '' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['isbn']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="isbn"
                                   placeholder="Please enter number of isbn" value="<?= $data['data']['isbn'] ?? '' ?>">
                            <label for="material-text">ISBN</label>
                            <?= isset($data['errors']['isbn']) ? '<div class="help-block text-right">' . $data['errors']['isbn'] . '</div>' : '' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group container_a">
                    <div class="col-sm-4">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="authors[]"
                                   placeholder="Please enter name of author">
                            <label for="material-text">Автор</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="phones[]"
                                   placeholder="Please enter phone number">
                            <label for="material-text">Телефон</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="emails[]"
                                   placeholder="Please enter email">
                            <label for="material-text">Email</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="add_form_field1 btn btn-success"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="book_name"
                                   placeholder="Please enter a book name"
                                   value="<?= $data['data']['book_name'] ?? '' ?>">
                            <label for="material-text">Название книги</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['name']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <select class="form-control" id="material-select" name="type" size="1">
                                <option><?= $data['data']['type'] ?? '...' ?></option>
                                <?php
                                echo '<option value ="Учебник">' . 'Учебник' . '</option>';
                                echo '<option value ="Учебное пособие">' . 'Учебное пособие' . '</option>';
                                echo '<option value ="Учебно-практическое пособие">' . 'Учебно-практическое пособие' . '</option>';
                                echo '<option value ="Учебно-методическое пособие">' . 'Учебно-методическое пособие' . '</option>';
                                echo '<option value ="Монография">' . 'Монография' . '</option>';
                                echo '<option value ="Методическое пособие">' . 'Методическое пособие' . '</option>';
                                echo '<option value ="Лабораторная работа">' . 'Лабораторная работа' . '</option>';
                                echo '<option value ="Словарь">' . 'Словарь' . '</option>';
                                echo '<option value ="Хрестоматия">' . 'Хрестоматия' . '</option>';
                                echo '<option value ="Серийное издание">' . 'Серийное издание' . '</option>';
                                echo '<option value ="Сборник статей">' . 'Сборник статей' . '</option>';
                                echo '<option value ="Сборник задач">' . 'Сборник задач' . '</option>';
                                echo '<option value ="Сборник тестов">' . 'Сборник тестов' . '</option>';
                                echo '<option value ="Научно-популярные издания">' . 'Научно-популярные издания' . '</option>';
                                echo '<option value ="Книга">' . 'Книга' . '</option>';
                                echo '<option value ="Атлас">' . 'Атлас' . '</option>';
                                echo '<option value ="Каталог">' . 'Каталог' . '</option>';
                                echo '<option value ="Практикум">' . 'Практикум' . '</option>';
                                echo '<option value ="Справочник">' . 'Справочник' . '</option>';
                                echo '<option value ="Альбом">' . 'Альбом' . '</option>';
                                echo '<option value ="Энциклопедия">' . 'Энциклопедия' . '</option>';
                                echo '<option value ="Журнал">' . 'Журнал' . '</option>';
                                echo '<option value ="Стереотипное издание">' . 'Стереотипное издание' . '</option>';
                                echo '<option value ="Методические рекомендации/указания/разработки">' . 'Методические рекомендации/указания/разработки' . '</option>';
                                ?>
                            </select>
                            <label for="material-select">Вид издания</label>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['name']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <label for="material-select">Язык</label>
                            <div class="col-xs-12">
                                <label class="checkbox-inline" for="example-inline-checkbox1">
                                    <input type="checkbox" id="example-inline-checkbox1" name="lang[]"
                                           value="Казахский">Казахский
                                </label>
                                <label class="checkbox-inline" for="example-inline-checkbox2">
                                    <input type="checkbox" id="example-inline-checkbox2" name="lang[]" value="Русский">Русский
                                </label>
                                <label class="checkbox-inline" for="example-inline-checkbox3">
                                    <input type="checkbox" id="example-inline-checkbox3" name="lang[]"
                                           value="Английский">Английский
                                </label>
                                <label class="checkbox-inline" for="example-inline-checkbox4">
                                    <input type="checkbox" id="example-inline-checkbox4" name="lang[]" value="Другой">Другой
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['name']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <select class="form-control" id="material-select" name="pay" size="1">
                                <option><?= $data['data']['pay'] ?? '...' ?></option>
                                <?php
                                echo '<option value ="Университет">' . 'Университет' . '</option>';
                                echo '<option value ="Автор">' . 'Автор' . '</option>';
                                echo '<option value ="Грант">' . 'Грант' . '</option>';
                                echo '<option value ="Университет - Автор">' . 'Университет - Автор' . '</option>';
                                ?>
                            </select>
                            <label for="material-select">Оплата</label>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="templan"
                                   placeholder="Please enter a templan" value="<?= $data['data']['templan'] ?? '' ?>">
                            <label for="material-text">Темплан</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-4">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="riso"
                                   placeholder="Please enter a RISO number" value="<?= $data['data']['riso'] ?? '' ?>">
                            <label for="material-text">РИСО: протокол №</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="js-datetimepicker form-material input-group date" data-show-today-button="true"
                             data-show-clear="true" data-show-close="true">
                            <?php if (isset($data['data']['riso_date'])) {
                                $date = new \DateTime($data['data']['riso_date']);
                            }
                            ?>
                            <input class="form-control" type="text" id="example-datetimepicker7" name="riso_date"
                                   placeholder="Choose a date.."
                                   value="<?= isset($date) ? $date->format('m/d/Y') : '' ?>">
                            <label for="example-datetimepicker7">от</label>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-4">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="sovet"
                                   placeholder="Please enter a number" value="<?= $data['data']['sovet'] ?? '' ?>">
                            <label for="material-text">Ученый совет КазНУ: протокол №</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="js-datetimepicker form-material input-group date" data-show-today-button="true"
                             data-show-clear="true" data-show-close="true">
                            <?php if (isset($data['data']['sovet_date'])) {
                                $date = new \DateTime($data['data']['sovet_date']);
                            }
                            ?>
                            <input class="form-control" type="text" id="example-datetimepicker7" name="sovet_date"
                                   placeholder="Choose a date.."
                                   value="<?= isset($date) ? $date->format('m/d/Y') : '' ?>">
                            <label for="example-datetimepicker7">от</label>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-4">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="rums"
                                   placeholder="Please enter a RUMS number" value="<?= $data['data']['rums'] ?? '' ?>">
                            <label for="material-text">РУМС: протокол №</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="js-datetimepicker form-material input-group date" data-show-today-button="true"
                             data-show-clear="true" data-show-close="true">
                            <?php if (isset($data['data']['rums_date'])) {
                                $date = new \DateTime($data['data']['rums_date']);
                            }
                            ?>
                            <input class="form-control" type="text" id="example-datetimepicker7" name="rums_date"
                                   placeholder="Choose a date.."
                                   value="<?= isset($date) ? $date->format('m/d/Y') : '' ?>">
                            <label for="example-datetimepicker7">от</label>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['name']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <select class="form-control" id="material-select" name="rukopis" size="1">
                                <option><?= $data['data']['rukopis'] ?? '...' ?></option>
                                <?php
                                echo '<option value ="Электронный вариант">' . 'Электронный вариант' . '</option>';
                                echo '<option value ="Бумажный вариант">' . 'Бумажный вариант' . '</option>';
                                echo '<option value ="Электронный и бумажный">' . 'Электронный и бумажный' . '</option>';
                                echo '<option value ="нет">' . 'нет' . '</option>';
                                ?>
                            </select>
                            <label for="material-select">Рукопись</label>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-3">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="page_quantity"
                                   placeholder="Please enter a number of pages"
                                   value="<?= $data['data']['page_quantity'] ?? '' ?>">
                            <label for="material-text">Количество страниц</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="char_quantity"
                                   placeholder="Please enter a number of chars"
                                   value="<?= $data['data']['char_quantity'] ?? '' ?>">
                            <label for="material-text">Количество знаков</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="size"
                                   placeholder="Please enter a size" value="<?= $data['data']['size'] ?? '' ?>">
                            <label for="material-text">Объем в а.л.</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="format"
                                   placeholder="Please enter a format" value="<?= $data['data']['format'] ?? '' ?>">
                            <label for="material-text">Формат</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="kegl"
                                   placeholder="Please enter a kegl number" value="<?= $data['data']['kegl'] ?? '' ?>">
                            <label for="material-text">Кегль</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>

                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-4">
                        <div class="form-material">
                            <select class="form-control" id="material-select" name="complexity_editing" size="1">
                                <option><?= $data['data']['complexity_editing'] ?? '...' ?></option>
                                <?php
                                echo '<option value ="1">' . '1' . '</option>';
                                echo '<option value ="2">' . '2' . '</option>';
                                echo '<option value ="3">' . '3' . '</option>';
                                ?>
                            </select>
                            <label for="material-select">Сложность редактура</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-material">
                            <select class="form-control" id="material-select" name="complexity_layout" size="1">
                                <option><?= $data['data']['complexity_layout'] ?? '...' ?></option>
                                <?php
                                echo '<option value ="1">' . '1' . '</option>';
                                echo '<option value ="2">' . '2' . '</option>';
                                echo '<option value ="3">' . '3' . '</option>';
                                ?>
                            </select>
                            <label for="material-select">Сложность верстка</label>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="file_name"
                                   placeholder="Please enter a file name"
                                   value="<?= $data['data']['file_name'] ?? '' ?>">
                            <label for="material-text">Название папки/ файла</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="ioot"
                                   placeholder="Please enter" value="<?= $data['data']['ioot'] ?? '' ?>">
                            <label for="material-text">ИООТ</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['description']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <textarea class="form-control" id="material-textarea-large" name="conclusion" rows="8"
                                      placeholder="Please add a comment"><?= $data['data']['conclusion'] ?? '' ?></textarea>
                            <label for="material-text">Заключение доредакционной экспертизы</label>
                            <?= isset($data['errors']['description']) ? '<div class="help-block text-right">' . $data['errors']['description'] . '</div>' : '' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['title']) ? 'has-error' : '' ?>">
                    <div class="col-sm-4">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="tirazh_author"
                                   placeholder="Please enter a number of book"
                                   value="<?= $data['data']['tirazh'] ?? '' ?>">
                            <label for="material-text">Тираж(автор)</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="tirazh_univer"
                                   placeholder="Please enter a number of book"
                                   value="<?= $data['data']['tirazh'] ?? '' ?>">
                            <label for="material-text">Тираж(университет)</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-material">
                            <input class="form-control" type="text" id="material-text" name="library"
                                   placeholder="Please enter a number of book"
                                   value="<?= $data['data']['library'] ?? '' ?>">
                            <label for="material-text">из них в библиотеку</label>
                            <?= isset($data['errors']['title']) ? '<div class="help-block text-right">' . $data['errors']['title'] . '</div>' : '' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['name']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <select class="form-control" id="material-select" name="id_owner" size="1">
                                <option>...</option>
                                <?php
                                foreach ($data['users'] as $account) {
                                    echo '<option value ="' . $account['id'] . '">' . $account['last_name'] . '</option>';
                                }
                                ?>
                            </select>
                            <label for="material-select">Сотрудник</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <div class="js-datetimepicker form-material input-group date" data-show-today-button="true"
                             data-show-clear="true" data-show-close="true">
                            <?php if (isset($data['data']['date_created'])) {
                                $date = new \DateTime($data['data']['date_created']);
                            }
                            ?>
                            <input class="form-control" type="text" id="example-datetimepicker7" name="date_created"
                                   placeholder="Choose a date.."
                                   value="<?= isset($date) ? $date->format('m/d/Y') : '' ?>">
                            <label for="example-datetimepicker7">Дата создания</label>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-8">
                        <div class="js-datetimepicker form-material input-group date" data-show-today-button="true"
                             data-show-clear="true" data-show-close="true">
                            <?php if (isset($data['data']['date_finished'])) {
                                $date = new \DateTime($data['data']['date_finished']);
                            }
                            ?>
                            <input class="form-control" type="text" id="example-datetimepicker7" name="date_finished"
                                   placeholder="Choose a date.."
                                   value="<?= isset($date) ? $date->format('m/d/Y') : '' ?>">
                            <label for="example-datetimepicker7">Дата назначения</label>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group <?= isset($data['errors']['name']) ? 'has-error' : '' ?>">
                    <div class="col-sm-9">
                        <div class="form-material">
                            <select class="form-control" id="material-select" name="status" size="1">
                                <option><?= $data['data']['status'] ?? '...' ?></option>
                                <?php
                                echo '<option value ="Создана">' . 'Создана' . '</option>';
                                echo '<option value ="Оформлена">' . 'Оформлена' . '</option>';
                                ?>
                            </select>
                            <label for="material-select">Статус</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <button class="btn btn-sm btn-primary" type="submit">Добавить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var max_fields = 10;
            var wrapper1 = $(".container_a");
            var add_button1 = $(".add_form_field1");

            var x = 1;

            $(add_button1).click(function (e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    $(wrapper1).append('<div><div class="col-sm-4"><div class="form-material"><input class="form-control" type="text" id="material-text" name="authors[]" placeholder="Please enter name of author"><label for="material-text">Автор</label></div></div><div class="col-sm-3"><div class="form-material"><input class="form-control" type="text" id="material-text" name="phones[]" placeholder="Please enter phone number"><label for="material-text">Телефон</label></div></div><div class="col-sm-3"><div class="form-material"><input class="form-control" type="text" id="material-text" name="emails[]" placeholder="Please enter email"><label for="material-text">Email</label></div></div><div class="col-sm-2"><button class="delete btn btn-danger"><i class="fa fa-minus"></i></button></div></div>'); //add input box
                } else {
                    alert('You Reached the limits')
                }
            });

            $(wrapper1).on("click", ".delete", function (e) {
                e.preventDefault();
                $(this).parent().parent('div').remove();
                x--;
            })

        });
    </script>
    <?php>
}
}
@endsection
