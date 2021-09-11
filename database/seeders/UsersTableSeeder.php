<?php

namespace Database\Seeders;

use App\Models\RolesNames;
use App\Models\User;
use Illuminate\Database\Seeder;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'lastname' => '',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'phone' => '',
        ]);


        $user = User::find(1); //Italo Morales
        $user->assignRole(RolesNames::$admin);
    }
}
