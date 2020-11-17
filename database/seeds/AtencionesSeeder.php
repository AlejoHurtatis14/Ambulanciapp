<?php

use Illuminate\Database\Seeder;

class AtencionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atenciones')->insert([
            'latitudInicial' => '5.236216024495669',
            'longitudInicial' => '-75.78674023970962',
            'latitudFinal' => '4.7903807',
            'longitudFinal' => '-75.7308221',
            'estado' => 'Terminado', //Terminado - Cancelado Usuario - Iniciado - Solicitado - Cancelado Enfermero
            'fk_enfermero' => 1,
            'fk_usuario' => 4,
            'fk_empresa' => 1,
            'fk_ambulancia' => '1',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
