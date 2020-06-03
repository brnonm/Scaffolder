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
        DB::statement("SET foreign_key_checks=0");

        $this->call(CursosSeeder::class);
        $this->call(DisciplinasSeeder::class);
        $this->call(DepartamentosSeeder::class);
        $this->call(CandidaturasSeeder::class);
        $this->call(UsersSeeder::class);

        DB::statement("SET foreign_key_checks=1");
    }
}
