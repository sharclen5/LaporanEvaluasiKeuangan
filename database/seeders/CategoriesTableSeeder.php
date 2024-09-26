<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Pendapatan', 'parent_id' => null],
            ['name' => 'Belanja', 'parent_id' => null],
            ['name' => 'Pembiayaan', 'parent_id' => null],
            ['name' => 'Pendapatan Asli Daerah', 'parent_id' => 1],
            ['name' => 'Pendapatan Pajak Daerah', 'parent_id'=> 4],
            ['name' => 'Pendapatan Retribusi Daerah', 'parent_id'=> 4],
            ['name' => 'Pendapatan Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan', 'parent_id' => 4],
            ['name' => 'Lain-lain PAD yang Sah', 'parent_id' => 4],
            ['name' => 'Pendapatan Transfer', 'parent_id' => 1],
            ['name' => 'Lain-lain Pendapatan Daerah yang Sah', 'parent_id' => 1],
            ['name' => 'Belanja Operasi', 'parent_id' => 2],
            ['name' => 'Belanja Pegawai', 'parent_id' => 11],
            ['name' => 'Belanja Barang dan Jasa', 'parent_id' => 11],
            ['name' => 'Belanja Bunga', 'parent_id' => 11],
            ['name' => 'Belanja Hibah', 'parent_id' => 11],
            ['name' => 'Belanja Bantuan Sosial', 'parent_id' => 11],
            ['name' => 'Belanja Modal', 'parent_id' => 2],
            ['name' => 'Belanja Modal Tanah', 'parent_id' => 17],
            ['name' => 'Belanja Modal Peralatan dan Mesin', 'parent_id' => 17],
            ['name' => 'Belanja Modal Gedung dan Bangunan', 'parent_id' => 17],
            ['name' => 'Belanja Modal Jalan, Irigasi, dan Jaringan', 'parent_id' => 17],
            ['name' => 'Belanja Modal Aset Tetap Lainnya', 'parent_id' => 17],
            ['name' => 'Belanja Modal Aset Lainnya', 'parent_id' => 17],
            ['name' => 'Belanja Tak Terduga', 'parent_id' => 2],
            ['name' => 'Belanja Transfer', 'parent_id' => 2],
            ['name' => 'Penerimaan Pembiayaan Daerah', 'parent_id' => 3],
            ['name' => 'Pengeluaran Pembiayaan Daerah', 'parent_id' => 3],
            ['name' => 'SILPA', 'parent_id' => 3],
        ]);
    }
}