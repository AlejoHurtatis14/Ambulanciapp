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
            'ubicacion' => 'Mz 45 cs 78 Villa Consuelo',
            'traslado' => 'No',
            'observacion' => 'La persona presenta traumatismo en un brazo.',
            'fk_empresa' => 1,
            'fk_ambulancia' => 1,
            'estado' => 'Realizado',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
