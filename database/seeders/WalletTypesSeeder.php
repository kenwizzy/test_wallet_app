<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=3; $i++) {

            DB::table('wallettypes')->insert([
            'name' => $i == 1 ? 'Main Wallet' : ($i == 2 ? 'Classic Wallet' : 'Premium Wallet'),
            'min_bal' => $i == 1 ? 500 : ($i == 2 ? 1000 : 2000),
            'monthly_int_rate' => $i == 1 ? '10%' : ($i == 2 ? '20%' : '30%'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
           }

           for ($i=1; $i<=5; $i++) {

            DB::table('transaction_histories')->insert([
            'wallet_id' => $i == 1 ? 1 : ($i == 2 ? 1 : 4),
            'user_id' => $i == 1 ? 1 : ($i == 2 ? 1 : 3),
            'transac_type' => $i == 1 ? 'Debit' : ($i == 2 ? 'Credit' : 'Credit'),
            'amount' => $i == 1 ? 300 : ($i == 2 ? 500 : 900),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ]);
           }
        // DB::table('wallettypes')->delete();

        // $data = array(

        //     array(
        //         'name'       =>  'Main Wallet',
        //         'min_bal'          =>  500,
        //         'monthly_int_rate'    =>  '20%',
        //         ),

        //     array(
        //         'name'       =>  'Classic Wallet',
        //         'min_bal'          =>  1000,
        //         'monthly_int_rate'    =>  '30%',
        //         ),

        //     array(
        //         'name'       =>  'Premium Wallet',
        //         'min_bal'          =>  200,
        //         'monthly_int_rate'    =>  '50%',
        //         ),
        // );

        // DB::table('wallettypes')->insert($data);
    }
}
