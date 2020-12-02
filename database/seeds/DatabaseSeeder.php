<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('RoleTableSeeder');
        $this->call('PositionsTableSeeder');
        $this->call('EditionTypesTableSeeder');
        $this->call('StagesTableSeeder');
        $this->call('WorkType_PositionsTableSeeder');
        $this->call('WorkTypesTableSeeder');


    }
}
