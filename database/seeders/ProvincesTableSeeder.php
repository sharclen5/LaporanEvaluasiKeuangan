<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            ['name' => 'aceh'],
            ['name' => 'bali'],
            ['name' => 'banten'],
            ['name' => 'bengkulu'],
            ['name' => 'daerah istimewa yogyakarta'],
            ['name' => 'daerah khusus ibukota jakarta'],
            ['name' => 'gorontalo'],
            ['name' => 'jambi'],
            ['name' => 'jawa tarat'],
            ['name' => 'jawa tengah'],
            ['name' => 'jawa timur'],
            ['name' => 'kalimantan barat'],
            ['name' => 'kalimantan selatan'],
            ['name' => 'kalimantan tengah'],
            ['name' => 'kalimantan timur'],
            ['name' => 'kalimantan utara'],
            ['name' => 'kepulauan bangka belitung'],
            ['name' => 'kepulauan riau'],
            ['name' => 'lampung'],
            ['name' => 'maluku'],
            ['name' => 'maluku utara'],
            ['name' => 'nusa tenggara barat'],
            ['name' => 'nusa tenggara timur'],
            ['name' => 'papua'],
            ['name' => 'papua barat'],
            ['name' => 'papua barat daya'],
            ['name' => 'papua pegunungan'],
            ['name' => 'papua selatan'],
            ['name' => 'papua tengah'],
            ['name' => 'riau'],
            ['name' => 'sulawesi barat'],
            ['name' => 'sulawesi selatan'],
            ['name' => 'sulawesi tengah'],
            ['name' => 'sulawesi tenggara'],
            ['name' => 'sulawesi utara'],
            ['name' => 'sumatera barat'],
            ['name' => 'sumatera selatan'],
            ['name' => 'sumatera utara'],
        ]);
    }
}