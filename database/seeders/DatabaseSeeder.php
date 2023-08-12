<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(UserSeeder::class);
        if (!app()->environment('production')) {
            $this->call(CategorySeeder::class);
        }

        // $this->call([
        //     ProductModerationMenuSeeder::class,
        //     MenuSeeder::class,
        //     ModelListSeeder::class,
        //     ModelFieldSeeder::class,
        //     ModelFieldReferenceSeeder::class,
        //     CountrySeeder::class,
        //     RegionSeeder::class,
        //     TariffSeeder::class,
        //     SearchableModelSeeder::class,
        //     SearchableFieldSeeder::class

        // ]);
    }
}
