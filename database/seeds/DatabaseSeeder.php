<?php

use App\Models\Customer;
use App\Models\State;
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
        $states = ['غزة', 'الشمال', 'الوسطى', 'الجنوب',];
        foreach ($states as $state)
            State::create(['Name' => $state]);
        //   $this->call(UserSeeder::class);
        factory('App\Models\Box', 20)->create();
        factory(\App\Models\Counter::class, 50)->create();
        factory(\App\Models\Customer::class, 10)->create();
//        $user = Customer::create([
////            'name' => 'Ghassan Ahmed',
////            'email' => 'gssan1018@gmail.com',
////            'password' => bcrypt('zxc123123'),
////            'state_id' => 1,
////            'Address' => 'JABALEA',
////            'is_Active' => 1,
////            'unit' => 3.3
////        ]);
        // $this->call(PermissionTableSeeder::class);

        // $this->call(CreateAdminUserSeeder::class);
    }
}
