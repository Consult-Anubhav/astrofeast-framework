<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserAndPermissionSeeder::class);
        $this->call(ProductCategorySeeder::class);

        $this->call(\Konekt\Address\Seeds\Countries::class);
        $this->call(\Konekt\Address\Seeds\CountiesOfHungary::class);
        $this->call(\Konekt\Address\Seeds\CountiesOfRomania::class);
        $this->call(\Konekt\Address\Seeds\ProvincesAndRegionsOfBelgium::class);
        $this->call(\Konekt\Address\Seeds\ProvincesAndTerritoriesOfCanada::class);
        $this->call(\Konekt\Address\Seeds\ProvincesOfIndonesia::class);
        $this->call(\Konekt\Address\Seeds\ProvincesOfNetherlands::class);
        $this->call(\Konekt\Address\Seeds\StatesAndTerritoriesOfIndia::class);
        $this->call(\Konekt\Address\Seeds\StatesOfGermany::class);
        $this->call(\Konekt\Address\Seeds\StatesOfUsa::class);
    }
}
