<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name' => 'initiator'
        ], [
            'display_name' => 'Инициатор'
        ]);

        Role::firstOrCreate([
            'name' => 'project_manager'
        ], [
            'display_name' => 'Проект менеджер'
        ]);

        Role::firstOrCreate([
            'name' => 'executor'
        ], [
            'display_name' => 'Исполнитель'
        ]);

        Role::firstOrCreate([
            'name' => 'sales_department'
        ], [
            'display_name' => 'Отдел продаж'
        ]);

        Role::firstOrCreate([
            'name' => 'marketing'
        ], [
            'display_name' => 'Маркетинг'
        ]);

        Role::firstOrCreate([
            'name' => 'supervisor'
        ], [
            'display_name' => 'Руководства'
        ]);
    }
}
