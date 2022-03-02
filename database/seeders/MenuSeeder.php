<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'code' => "dashboard",
            'name' => "Dashboard",
            'icon' => 'fas fa-tachometer-alt',
            'order' => '0000',
            'type' => 0
        ]);

        DB::table('menus')->insert([
            'code' => "master",
            'name' => "Master",
            'icon' => 'fas fa-tachometer-alt',
            'order' => '0100',
            'type' => 1
        ]);

        DB::table('menus')->insert([
            'code' => "master-wilayah",
            'name' => "Master Wilayah",
            'icon' => 'fas fa-tachometer-alt',
            'order' => '0101',
            'type' => 0
        ]);

        DB::table('menus')->insert([
            'code' => "master-gereja",
            'name' => "Master Gereja",
            'icon' => 'fas fa-tachometer-alt',
            'order' => '0102',
            'type' => 0
        ]);

        DB::table('menus')->insert([
            'code' => "master-gembala",
            'name' => "Master Gembala",
            'icon' => 'fas fa-tachometer-alt',
            'order' => '0103',
            'type' => 0
        ]);

        DB::table('menus')->insert([
            'code' => "master-wadah",
            'name' => "Master Wadah",
            'icon' => 'fas fa-tachometer-alt',
            'order' => '0104',
            'type' => 0
        ]);

        DB::table('menus')->insert([
            'code' => "setting",
            'name' => "Setting",
            'icon' => 'fas fa-tachometer-alt',
            'order' => '9900',
            'type' => 1
        ]);

        DB::table('menus')->insert([
            'code' => "user-management",
            'name' => "User Management",
            'icon' => 'fas fa-tachometer-alt',
            'order' => '9901',
            'type' => 0
        ]);
    }
}
