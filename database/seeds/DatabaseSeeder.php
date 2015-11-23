<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call(UserTableSeeder::class);
        $this->call(DataKeahlianSeeder::class);
        // $this->call(GuruTableSeeder::class);
        // $this->call(SiswaAndKelasSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(KompetensiDasarSeeder::class);
        
        // $this->call(GuruMapelSeeder::class);     

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Model::reguard();
    }
}
