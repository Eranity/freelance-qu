<?php

use Illuminate\Database\Seeder;
use App\EditionType;

class EditionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $editionTypes = [
            'Учебник',
            'Учебное пособие',
            'Учебно-практическое пособие',
            'Учебно-методическое пособие',
            'Монография',
            'Методическое пособие',
            'Лабораторная работа',
            'Словарь',
            'Хрестоматия',
            'Серийное издание',
            'Сборник статей',
            'Сборник задач',
            'Сборник тестов',
            'Научно-популярные издания',
            'Книга',
            'Атлас',
            'Каталог',
            'Практикум',
            'Справочник',
            'Альбом',
            'Энциклопедия',
            'Журнал',
            'Стереотипное издание',
            'Методические рекомендации/указания/разработки'
        ];

        foreach($editionTypes as $editionType) {
            EditionType::firstOrCreate([
                'name' => $editionType
            ], [

            ]);
        }

        // EditionType::firstOrCreate([
        //     'name' => 'Учебник'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Учебное пособие'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Учебно-практическое пособие'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Учебно-методическое пособие'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Монография'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Методическое пособие'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Лабораторная работа'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Словарь'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Хрестоматия'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Серийное издание'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Сборник статей'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Сборник задач'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Сборник тестов'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Научно-популярные издания'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Книга'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Атлас'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Каталог'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Практикум'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Справочник'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Альбом'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Энциклопедия'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Журнал'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Стереотипное издание'
        // ], [
        // ]);

        // EditionType::firstOrCreate([
        //     'name' => 'Методические рекомендации/указания/разработки'
        // ], [
        // ]);
    }
}
