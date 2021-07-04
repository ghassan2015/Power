<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'الرئيسية',
            'الصندوق',
            'العداد',
            'الفواتير',
            'الدفعات',
            'المصاريف التشغيلية',
            'الصلاحيات',
            'الموظفين',
            'المشتركين',

        ];


        foreach ($permissions as $permission) {

            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

    }
}
