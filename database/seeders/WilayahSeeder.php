<?php

namespace Database\Seeders;

use App\Models\MhWilayah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MhWilayah::truncate();
        info("START SEED " . __CLASS__);

        $file = fopen(storage_path("csv/wilayah-2023.csv"), 'r');

        $hasHeader = true;

        $isHeaderSkiped = false;
        $arrInsert = collect([]);
        while (($row = fgetcsv($file)) !== FALSE) {
            if ($hasHeader && !$isHeaderSkiped) {
                $isHeaderSkiped = true;
                continue;
            }

            $temp = $this->transform($row);
            if (!$temp) {
                continue;
            }

            echo $temp["name"] . "\n";
            $wilayah = MhWilayah::create($temp);

            $user = User::create([
                "name" => $wilayah->name,
                "email" => "mw-" . $wilayah->slug . "@gpdisulut.com",
                "password" => Hash::make("abc12345")
            ]);

            $user->markEmailAsVerified();

            $user->Role()->attach(5, [
                'ref_id' => $wilayah->id,
                'ref_type' => MhWilayah::class
            ]);
        }

        fclose($file);

        info("FINISH SEED " . __CLASS__);
    }


    protected function transform($oldRow)
    {
        $oldRow = collect($oldRow);
        $oldRow = $oldRow->map(function ($item) {
            $item = trim($item);
            return $item;
        });

        return [
            "slug" => Str::slug($oldRow[2]),
            "code" => $oldRow[1],
            "name" => $oldRow[2],
            "mh_kabupaten_id" => $oldRow[5],
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
