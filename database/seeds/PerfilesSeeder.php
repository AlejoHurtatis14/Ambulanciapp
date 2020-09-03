<?php

use Illuminate\Database\Seeder;

class PerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombres = ['Administrador', 'Empresa', 'Enfermero', 'Conductor', 'Usuario'];
        for ($i=0; $i < 4 ; $i++) {
            DB::table('perfiles')->insert([
                'nombre' => $nombres[$i],
                'estado' => 1,
                'empresa' => ($nombres[$i] === 'Administrador' || $nombres[$i] === 'Empresa' ? 0 : 1),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ]);
        }
    }
}
