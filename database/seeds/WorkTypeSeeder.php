<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;
use App\WorkType;


class WorkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $role = WorkType::firstOrNew(['name' => 'Редактура']);
        // if (!$role->exists) {
        //     $role->fill([
        //         'display_name' => __('voyager::seeders.roles.admin'),
        //         'unit_type' => __('')
        //     ])->save();
        // }

        WorkType::firstOrCreate([
            'name' => 'Дизайн обложки книги / баннера / ролл-ап'
        ], [
            'unit_type' => 'Количество единиц',
            'unit_price' => '6250',
            'order' => '1'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Стандартный дизайн'
        ], [
            'unit_type' => 'Количество единиц',
            'unit_price' => '2000',
            'order' => '2'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Шаблонный дизайн'
        ], [
            'unit_type' => 'Количество единиц',
            'unit_price' => '500',
            'order' => '3'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Простая верстка(текст)'
        ], [
            'unit_type' => 'Количество страниц А4',
            'unit_price' => '94',
            'order' => '4'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Cредняя верстка(текст + таблица+рисунок)'
        ], [
            'unit_type' => 'Количество страниц А4',
            'unit_price' => '125',
            'order' => '5'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Cложная верстка(текст + формулы + таблицы + рисунок)'
        ], [
            'unit_type' => 'Количество страниц А4',
            'unit_price' => '245',
            'order' => '6'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Правка простая'
        ], [
            'unit_type' => 'Количество страниц А4',
            'unit_price' => '40',
            'order' => '7'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Правка средняя(с перенабором)'
        ], [
            'unit_type' => 'Количество страниц А4',
            'unit_price' => '56',
            'order' => '8'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Правка сложная(с перенабором и донабором)'
        ], [
            'unit_type' => 'Количество страниц А4',
            'unit_price' => '80',
            'order' => '9'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Набор текста/формул'
        ], [
            'unit_type' => '3000 слов',
            'unit_price' => '100',
            'order' => '10'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Подготовка к печати'
        ], [
            'unit_type' => 'Количество страниц А4',
            'unit_price' => '25',
            'order' => '11'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Обработка рисунков/фотографий'
        ], [
            'unit_type' => 'Количество единиц',
            'unit_price' => '80',
            'order' => '12'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Отрисовка рисунков/фотографий'
        ], [
            'unit_type' => 'Количество единиц',
            'unit_price' => '120',
            'order' => '13'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Сканирование вручную'
        ], [
            'unit_type' => 'Количество страниц',
            'unit_price' => '50',
            'order' => '14'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Автосканирование '
        ], [
            'unit_type' => 'Количество страниц',
            'unit_price' => '25',
            'order' => '15'
        ]);





        WorkType::firstOrCreate([
            'name' => 'Редактура'
        ], [
            'unit_type' => 'Количество слов(в 3000 слов)',
            'unit_price' => '300',
            'order' => '16'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Корректура'
        ], [
            'unit_type' => 'Количество слов(в 3000 слов)',
            'unit_price' => '100',
            'order' => '17'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Сверка'
        ], [
            'unit_type' => 'Количество слов(в 3000 слов)',
            'unit_price' => '50',
            'order' => '18'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Редактура переведенного текста с русского на казахский язык'
        ], [
            'unit_type' => 'Количество слов(в 3000 слов)',
            'unit_price' => '660',
            'order' => '19'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Редактура переведенного текста с казахского на русский язык'
        ], [
            'unit_type' => 'Количество слов(в 3000 слов)',
            'unit_price' => '540',
            'order' => '20'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Редактура текста на английском языке'
        ], [
            'unit_type' => 'Количество слов(в 3000 слов)',
            'unit_price' => '1000',
            'order' => '21'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Составление аннотации'
        ], [
            'unit_type' => null,
            'unit_price' => '3000',
            'order' => '22'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Подготовка выходных сведений'
        ], [
            'unit_type' => null,
            'unit_price' => '2000',
            'order' => '23'
        ]);

        WorkType::firstOrCreate([
            'name' => 'Составление текста'
        ], [
            'unit_type' => 'Количество слов(в 3000 слов)',
            'unit_price' => '3000',
            'order' => '24'
        ]);
    }
}
