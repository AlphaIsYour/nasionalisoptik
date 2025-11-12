<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Lensa Kacamata',
                'description' => 'Berbagai jenis lensa kacamata berkualitas'
            ],
            [
                'name' => 'Lensa Optik',
                'description' => 'Lensa fotokromik, plus, minus, dan progresif'
            ],
            [
                'name' => 'Frame Kacamata',
                'description' => 'Koleksi frame kacamata modern dan klasik'
            ],
            [
                'name' => 'Kacamata Hitam',
                'description' => 'Kacamata hitam stylish dan protective'
            ],
            [
                'name' => 'Aksesoris & Fashion',
                'description' => 'Aksesoris pelengkap kacamata Anda'
            ],
            [
                'name' => 'Lensa Kontak',
                'description' => 'Lensa kontak berkualitas dan nyaman'
            ],
            [
                'name' => 'Pembersih Kacamata',
                'description' => 'Produk pembersih dan perawatan kacamata'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}