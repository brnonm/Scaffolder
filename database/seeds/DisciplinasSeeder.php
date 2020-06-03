<?php

use Illuminate\Database\Seeder;

class DisciplinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('disciplinas')->truncate();
        $this->loadFromJson();
    }

    private function loadFromJson()
    {
        $this->command->line('--- > Criar Disciplinas');
        DB::table('disciplinas')->truncate();

        $disciplinasFromJSONFile = json_decode(file_get_contents(database_path('seeds/data') . "/todas_disciplinas.json"), true);
        DB::table('disciplinas')->insert($disciplinasFromJSONFile);
    }
}
