<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'nama' => 'Ibra',
            'email' => 'ibra@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('rahasia123'),
        ]);

        \App\Models\kategori::create([
            'nama_kategori' => 'Obat'
        ]);

        \App\Models\customer::create([
            'kode' => 'CS-001',
            'nama_customer' => 'Kfarma',
            'no_telp' => '083132121',
            'alamat' => 'JL Pati'
        ]);

        \App\Models\customer::create([
            'kode' => 'CS-002',
            'nama_customer' => 'KSehat',
            'no_telp' => '087134121',
            'alamat' => 'JL Kudus'
        ]);

        \App\Models\salesman::create([
            'kode' => 'SLS-001',
            'nama_salesman' => 'Ivan',
            'no_telp' => '083132121',
        ]);

        \App\Models\salesman::create([
            'kode' => 'SLS-002',
            'nama_salesman' => 'Dipa',
            'no_telp' => '087134121',
        ]);

        \App\Models\produk::create([
            'nama_produk' => 'Ultraflu',
            'deskripsi' => 'ini ultraflu',
            'harga' => '3000',
            'satuan' => 'MDS',
            'stok' => '20',
            'kategori_id' => '1'
        ]);

        \App\Models\produk::create([
            'nama_produk' => 'Diatab',
            'deskripsi' => 'ini diatab',
            'harga' => '4000',
            'satuan' => 'MDS',
            'stok' => '30',
            'kategori_id' => '1'
        ]);
    }
}
