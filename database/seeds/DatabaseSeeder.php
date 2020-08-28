<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(PerfilesSeeder::class);
        $this->call(TipoPrestadoresSeeder::class);
        $this->call(EmpresasSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(AmbulanciasSeeder::class);
        $this->call(AtencionesSeeder::class);
    }
}
