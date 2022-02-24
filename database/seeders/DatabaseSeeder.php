<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){

        $Users = new User();
        $Users->email = 'daniel@gmail.com';
        $Users->password = Hash::make('#Admin1234');
        $Users->name = 'Daniel Martinez Vergara';
        $Users->numero_celular = '3115687898';
        $Users->cedula = '10784895'; 
        $Users->rol = 'ADMINISTRADOR';             
        $Users->f_nacimiento = '1985-02-01';             
        $Users->cod_ciudad = 25;
        $Users->save();    
        
        $Users = new User();
        $Users->email = 'mariab@gmail.com';
        $Users->password = Hash::make('#Admin1234');
        $Users->name = 'Maria Cabrales Lopez';
        $Users->numero_celular = '3215487896';
        $Users->cedula = '1067895645'; 
        $Users->rol = 'ADMINISTRADOR';             
        $Users->f_nacimiento = '1980-12-15';             
        $Users->cod_ciudad = 3;
        $Users->save();      


    }
}
