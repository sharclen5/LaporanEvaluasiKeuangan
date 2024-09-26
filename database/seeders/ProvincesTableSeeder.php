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
            ['name' => 'Aceh'],
            ['name' => 'Bali'],
            ['name' => 'Banten'],
            ['name' => 'Bengkulu'],
            ['name' => 'Daerah Istimewa Yogyakarta'],
            ['name' => 'Daerah Khusus Ibukota Jakarta'],
            ['name' => 'Gorontalo'],
            ['name' => 'Jambi'],
            ['name' => 'Jawa Barat'],
            ['name' => 'Jawa Tengah'],
            ['name' => 'Jawa Timur'],
            ['name' => 'Kalimantan Barat'],
            ['name' => 'Kalimantan Selatan'],
            ['name' => 'Kalimantan Tengah'],
            ['name' => 'Kalimantan Timur'],
            ['name' => 'Kalimantan Utara'],
            ['name' => 'Kepulauan Bangka Belitung'],
            ['name' => 'Kepulauan Riau'],
            ['name' => 'Lampung'],
            ['name' => 'Maluku'],
            ['name' => 'Maluku Utara'],
            ['name' => 'Nusa Tenggara Barat'],
            ['name' => 'Nusa Tenggara Timur'],
            ['name' => 'Papua'],
            ['name' => 'Papua Barat'],
            ['name' => 'Papua Barat Daya'],
            ['name' => 'Papua Pegunungan'],
            ['name' => 'Papua Selatan'],
            ['name' => 'Papua Tengah'],
            ['name' => 'Riau'],
            ['name' => 'Sulawesi Barat'],
            ['name' => 'Sulawesi Selatan'],
            ['name' => 'Sulawesi Tengah'],
            ['name' => 'Sulawesi Tenggara'],
            ['name' => 'Sulawesi Utara'],
            ['name' => 'Sumatera Barat'],
            ['name' => 'Sumatera Selatan'],
            ['name' => 'Sumatera Utara'],
        ]);
    }
}