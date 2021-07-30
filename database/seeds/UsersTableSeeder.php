<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'users' )->insert( [ 'name'  => 'Cornel POPA',
                                        'email' => 'cornel@adv.ro',
                                        'password' => '$2y$10$lPIfbdauXt60oYcA11qiIumhPTZqfNtxx9fbABMasVmBgGDFBvAm.'
        ] );

    }
}
