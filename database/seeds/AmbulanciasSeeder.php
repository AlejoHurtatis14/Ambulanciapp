<?php

use Illuminate\Database\Seeder;

class AmbulanciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ambulancias')->insert([
            'codigo' => '5646723432',
            'placa' => 'AJS 875',
            'estado' => 1,
            'fk_empresa' => 1,
            'fk_conductor' => 3,
            'fk_enfermero_uno' => 1,
            'fk_enfermero_dos' => 2,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
