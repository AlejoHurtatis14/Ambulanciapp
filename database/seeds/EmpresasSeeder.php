<?php

use Illuminate\Database\Seeder;

class EmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            'razon_social' => 'Ambulancias a su servicio',
            'telefono' => '3546798',
            'documento' => '856345',
            'direccion' => 'Ciudad Victoria.',
            'email' => 'ambulanciasservicio@gmail.com',
            'fk_prestador' => 1,
            'estado' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
