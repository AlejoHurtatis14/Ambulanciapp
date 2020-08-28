<?php

use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombres = ['Andres', 'Mauricio', 'Sofia', 'Carlos', 'Empresa'];
        $apellidos = ['Barreto', 'Moncada', 'Suarez', 'Quintero', 'Prueba'];
        $direccion = ['Mas cerca de ti', 'Afuera en vez de adentro', 'Si fuera poco aqui estoy', 'Casa de los quinteros', 'direccion empresarial'];
        $emails = ['andresbarre@gmail.com', 'maocada@gmail.com', 'sofisuarez11@gmail.com', 'quinterito@gmail.com', 'empresa@gmail.com'];
        for ($i=0; $i < 5 ; $i++) {
            DB::table('usuarios')->insert([
                'documento' => '345' . ($i + 1) . '2' . ($i * 2) . '56',
                'nombres' => $nombres[$i],
                'apellidos' => $apellidos[$i],
                'telefono' => '324' . ($i + 1) . '7' . ($i * 2) . '64',
                'direccion' => $direccion[$i],
                'password' => '123' . ($i + 1),
                'email' => $emails[$i],
                'fk_perfil' => ($i === 3 ? 4 : ($i === 1 ? 3 : ($i === 2 ? 1 : ($i === 4 ? 2 : 3)))),
                'estado' => 1,
                'fk_empresa' => 1,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
            ]);
        }
    }
}
