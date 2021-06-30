<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateDataTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = ['غزة', 'الشمال', 'الوسطى', 'الجنوب',];
        foreach ($states as $state)
            State::create(['Name' => $state]);

    }
}
