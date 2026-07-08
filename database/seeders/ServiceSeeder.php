<?php
// database/seeders/ServiceSeeder.php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'PEMERIKSAAN MATA GRATIS',
                'description' => 'Dapatkan pemeriksaan mata gratis oleh tenaga profesional kami',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'KONSULTASI FRAME & LENSA',
                'description' => 'Tim ahli kami siap membantu memilih frame dan lensa yang tepat',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'PERBAIKAN & SERVICE',
                'description' => 'Layanan perbaikan dan perawatan kacamata Anda',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'PESAN ONLINE & ANTAR KE RUMAH',
                'description' => 'Kemudahan pesan online dengan layanan antar',
                'sort_order' => 4,
                'is_active' => true
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}