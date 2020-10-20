<?php

use Illuminate\Database\Seeder;
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
        WorkType_Position::firstOrCreate([
            'work_type_id' => '',
            'position_id' => 'Дизайн обложки книги / баннера / ролл-ап'
        ], [

        ]);
    }
}
