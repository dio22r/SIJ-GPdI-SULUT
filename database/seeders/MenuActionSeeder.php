<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = Menu::all();
        foreach ($menus as $menu) {
            $arrAction = explode(",", $menu->initial_action);

            foreach ($arrAction as $action) {
                DB::table('menu_action')->insert([
                    'menu_id' => $menu->id,
                    'code' => $menu->code . "_" . strtolower(trim($action)),
                    'name' => str_replace("_", " ", trim($action))
                ]);
            }
        }
    }
}
