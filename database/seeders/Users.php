<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
        	'nombre' => 'admin',
        	'email' => 'administrador@mail.com',
            'telefono' => '1234567',
        	'password' => bcrypt('admin'),
	        
       ]);

         DB::table('users')->insert([
            'nombre' => 'admin',
            'email' => 'admin@mail.co',
            'telefono' => '12345678',
            'password' => bcrypt('12345678'),
            
       ]);
    }
}
