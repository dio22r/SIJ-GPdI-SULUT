<?php

namespace Database\Seeders;

use App\Models\MhGereja;
use App\Models\MhWilayah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => "Super Administrator",
            'reference_table' => null
        ]);

        DB::table('roles')->insert([
            'name' => "Administrator",
            'reference_table' => null
        ]);

        DB::table('roles')->insert([
            'name' => "Majelis Daerah",
            'reference_table' => null
        ]);
        DB::table('roles')->insert([
            'name' => "Admin MD",
            'reference_table' => null
        ]);


        DB::table('roles')->insert([
            'name' => "Majelis Wilayah",
            'reference_table' => MhWilayah::class
        ]);
        DB::table('roles')->insert([
            'name' => "Admin MW",
            'reference_table' => MhWilayah::class
        ]);


        DB::table('roles')->insert([
            'name' => "Gereja",
            'reference_table' => MhGereja::class
        ]);
        DB::table('roles')->insert([
            'name' => "Admin Gereja",
            'reference_table' => MhGereja::class
        ]);
    }
}
