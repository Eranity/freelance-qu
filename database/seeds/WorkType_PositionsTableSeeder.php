<?php

use Illuminate\Database\Seeder;
use App\Position;
use App\WorkType;
use App\WorkType_Position;

class WorkType_PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position_work_type_relations = [
            [
                'position' => 'Дизайнер',
                'workType' => 'Дизайн обложки книги / баннера / ролл-ап'
            ],
            [
                'position' => 'Дизайнер',
                'workType' => 'Стандартный дизайн'
            ],
            [
                'position' => 'Дизайнер',
                'workType' => 'Шаблонный дизайн'
            ],
            [
                'position' => 'Дизайнер',
                'workType' => 'Обработка рисунков/фотографий'
            ],
            [
                'position' => 'Дизайнер',
                'workType' => 'Отрисовка рисунков/фотографий'
            ],
            [
                'position' => 'Дизайнер',
                'workType' => 'Сканирование вручную'
            ],
            [
                'position' => 'Дизайнер',
                'workType' => 'Автосканирование'
            ],


            [
                'position' => 'Верстальщик',
                'workType' => 'Простая верстка(текст)'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Cредняя верстка(текст + таблица + рисунок)'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Cложная верстка(текст + формулы + таблицы + рисунок)'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Правка простая'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Правка средняя(с перенабором)'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Правка сложная(с перенабором и донабором)'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Набор текста/формул'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Подготовка к печати'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Обработка рисунков/фотографий'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Отрисовка рисунков/фотографий'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Сканирование вручную'
            ],
            [
                'position' => 'Верстальщик',
                'workType' => 'Автосканирование'
            ],


            [
                'position' => 'Редактор',
                'workType' => 'Редактура'
            ],
            [
                'position' => 'Редактор',
                'workType' => 'Корректура'
            ],
            [
                'position' => 'Редактор',
                'workType' => 'Сверка'
            ],
            [
                'position' => 'Редактор',
                'workType' => 'Редактура переведенного текста с русского на казахский язык'
            ],
            [
                'position' => 'Редактор',
                'workType' => 'Редактура переведенного текста с казахского на русский язык'
            ],
            [
                'position' => 'Редактор',
                'workType' => 'Редактура текста на английском языке'
            ],
            [
                'position' => 'Редактор',
                'workType' => 'Составление аннотации'
            ],
            [
                'position' => 'Редактор',
                'workType' => 'Подготовка выходных сведений'
            ],
            [
                'position' => 'Редактор',
                'workType' => 'Составление текста'
            ],
        ];

        foreach($position_work_type_relations as $relation) {
            $position = Position::where('display_name', $relation['position'])->first();
            $workType = WorkType::where('name', $relation['workType'])->first();

            if(!$position || !$workType) {
                continue;
            }

            $workType_position = WorkType_Position::where('position_id', $position->id)
                                                    ->where('work_type_id', $workType->id)->first();


            if(!$workType_position) {
                WorkType_Position::create([
                    'position_id' => $position->id,
                    'work_type_id' => $workType->id
                ]);
            }
        }
    }
}
