<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::firstOrCreate([
            'name' => 'designer'
        ], [
            'display_name' => 'Дизайнер'
        ]);

        Position::firstOrCreate([
            'name' => 'template_designer'
        ], [
            'display_name' => 'Верстальщик'
        ]);

        Position::firstOrCreate([
            'name' => 'editor'
        ], [
            'display_name' => 'Редактор'
        ]);
    }
}
