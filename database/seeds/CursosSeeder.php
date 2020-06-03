<?php

use Illuminate\Database\Seeder;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->truncate();
        $this->loadFromJson();
    }

    private function loadFromJson()
    {
        $this->command->line('--- > Criar Cursos');
        DB::table('cursos')->truncate();

        $cursosFromJSONFile = json_decode(file_get_contents(database_path('seeds/data') . "/cursos.json"), true);
        DB::table('cursos')->insert($cursosFromJSONFile);
    }
}
