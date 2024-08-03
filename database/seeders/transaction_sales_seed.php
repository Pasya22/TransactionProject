<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class transaction_sales_seed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_customer')->insert([
            [
                'kode' => 'CUST001',
                'nama' => 'John Doe',
                'telp' => '081234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode' => 'CUST002',
                'nama' => 'Jane Smith',
                'telp' => '081987654321',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        DB::table('t_barang')->insert([
            [
                'kode' => 'BRG001',
                'nama' => 'Laptop',
                'harga' => 10000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode' => 'BRG002',
                'nama' => 'Smartphone',
                'harga' => 5000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        DB::table('t_sales')->insert([
            [
                'cust_id' => 1, // Assuming John Doe's ID is 1
                'subtotal' => 10000000,
                'diskon' => 1000000,
                'ongkir' => 50000,
                'total_bayar' => 9050000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cust_id' => 2, // Assuming Jane Smith's ID is 2
                'subtotal' => 5000000,
                'diskon' => 500000,
                'ongkir' => 30000,
                'total_bayar' => 4530000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        DB::table('t_sales_det')->insert([
            [
                'sales_id' => 1, // Assuming Sales ID is 1
                'barang_id' => 1, // Assuming Laptop's ID is 1
                'harga_bandrol' => 10000000,
                'qty' => 1,
                'diskon_pct' => 10,
                'diskon_nilai' => 1000000,
                'harga_diskon' => 9000000,
                'total' => 9000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'sales_id' => 2, // Assuming Sales ID is 2
                'barang_id' => 2, // Assuming Smartphone's ID is 2
                'harga_bandrol' => 5000000,
                'qty' => 1,
                'diskon_pct' => 10,
                'diskon_nilai' => 500000,
                'harga_diskon' => 4500000,
                'total' => 4500000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
