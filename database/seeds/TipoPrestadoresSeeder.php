<?php

use Illuminate\Database\Seeder;

class TipoPrestadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombres = ['Clasificacion prestadores', 'Instituciones - IPS', 'Objeto Social Diferente a la Prestación de Servicios de Salud', 'Profesional Independiente', 'Transporte Especial de Pacientes'];
        for ($i=0; $i < 5 ; $i++) {
            DB::table('tipo_prestadores')->insert([
                'nombre' => $nombres[$i],
                'estado' => 1,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ]);
        }
    }
}
