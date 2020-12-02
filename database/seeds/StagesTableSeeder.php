<?php

use Illuminate\Database\Seeder;
use App\Stage;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            '1-этап',
            '2-этап',
            '1-сигальный экземпляр',
            '3-этап',
            '4-этап',
            '2-сигальный экземпляр',
            'Замечание менеджера',
            '5-этап',
            'Сдача на печать',
            'Печать',
            'Склад',
            'Распечатать тех карту'
        ];

        for($i = 0; $i < count($stages); $i++) {
            Stage::firstOrCreate([
                'name' => $stages[$i]
            ], [
                'order' => $i + 1
            ]);
        }
    }
}
