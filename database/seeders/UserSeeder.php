<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [1,2,3];
       for ($j=1;$j<=count($users); $j++) {
           DB::table('users')->insert([
        'email' => $j == 1 ? 'John@gmail.com' : ($j == 2 ? 'Nwideheknneth@hotmail.com' : 'Jenny@example.com'),
        'name' => $j == 1 ? 'John Doe' : ($j == 2 ? 'Nwideh Kenneth' : 'Jenny Smith'),
        'password' => bcrypt('12345678'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        ]);

           for ($i=1; $i<=count($users); $i++) {

            DB::table('wallets')->insert([
            'wtype_id' => $i,
            'user_id' => $j,
            'balance' => 2000 * $i,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
           }
       }

    }
}
