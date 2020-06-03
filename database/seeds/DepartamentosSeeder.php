<?php

use Illuminate\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    private static $departamentos = [
        ['abreviatura' => 'DEI', 'nome' => 'Departamento Engenharia Informática'],
        ['abreviatura' => 'DM', 'nome' => 'Departamento Matemática'],
        ['abreviatura' => 'DGE', 'nome' => 'Departamento de Gestão e Economia'],
        ['abreviatura' => 'DCJ', 'nome' => 'Departamento de Ciências Jurídicas'],
        ['abreviatura' => 'DCL', 'nome' => 'Departamento de Ciências da Linguagem'],
        ['abreviatura' => 'DEA', 'nome' => 'Departamento de Engenharia do Ambiente'],
        ['abreviatura' => 'DEC', 'nome' => 'Departamento de Engenharia Civil'],
        ['abreviatura' => 'DEE', 'nome' => 'Departamento Engenharia Electrotecnica'],
        ['abreviatura' => 'DEM', 'nome' => 'Departamento Engenharia Mecânica'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('--- > Criar Departamentos');

        DB::table('departamentos')->truncate();
        DB::table('departamentos')->insert(DepartamentosSeeder::$departamentos);
    }
}
