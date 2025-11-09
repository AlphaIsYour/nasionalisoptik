@extends('layouts.main')

@section('title', 'Beranda - Optik Nasionalis Kacamata')

@section('content')
@include('components.banner')

<div class="flex justify-center w-full px-4">
  <div class="max-w-4xl mb-8 text-center">
    <h1 class="font-bold text-4xl mb-4">FIND THE PERFECT GLASSES FOR YOUR STYLE</h1>
    <p>Glasses are more than just vision aids - they're a fashion statement. From clear lenses to stylish sunglasses, every pair tells a story about who you are.</p>
  </div>
</div>

@include('components.auto-slide')

<div class="w-full py-16 bg-white -mt-40">

  @php
    $showoffItems = [
      [
        'image' => '/image/glasses/img13.png',
        'title' => 'KOLEKSI PREMIUM',
        'topic' => 'Classic Frame',
        'description' => 'Kacamata klasik dengan desain timeless yang cocok untuk berbagai kesempatan. Memberikan kesan profesional dan elegan.',
        'detail_description' => 'Frame klasik dengan material acetate premium yang ringan dan tahan lama. Dilengkapi dengan lensa berkualitas tinggi yang memberikan kejernihan visual maksimal. Cocok untuk penggunaan sehari-hari maupun acara formal.',
        'specifications' => [
          ['label' => 'Material', 'value' => 'Acetate'],
          ['label' => 'Berat', 'value' => '25g'],
          ['label' => 'Proteksi', 'value' => 'UV400'],
          ['label' => 'Garansi', 'value' => '1 Tahun'],
          ['label' => 'Warna', 'value' => 'Hitam']
        ]
      ],
      [
        'image' => '/image/glasses/img8.png',
        'title' => 'KOLEKSI MODERN',
        'topic' => 'Sport Edition',
        'description' => 'Desain sporty yang dinamis untuk gaya hidup aktif Anda. Nyaman digunakan untuk berbagai aktivitas outdoor.',
        'detail_description' => 'Kacamata dengan desain aerodinamis dan material yang ringan namun kokoh. Frame elastis yang mengikuti kontur wajah dengan sempurna. Ideal untuk olahraga, berkendara, dan aktivitas outdoor lainnya.',
        'specifications' => [
          ['label' => 'Material', 'value' => 'TR90'],
          ['label' => 'Berat', 'value' => '22g'],
          ['label' => 'Proteksi', 'value' => 'Polarized'],
          ['label' => 'Garansi', 'value' => '2 Tahun'],
          ['label' => 'Warna', 'value' => 'Biru']
        ]
      ],
      [
        'image' => '/image/glasses/img9.png',
        'title' => 'KOLEKSI FASHION',
        'topic' => 'Trendy Style',
        'description' => 'Mengikuti tren fashion terkini dengan desain yang bold dan berani. Sempurna untuk Anda yang ingin tampil beda.',
        'detail_description' => 'Frame dengan desain kontemporer yang menjadi statement piece dalam penampilan Anda. Kombinasi warna yang unik dan bentuk yang distinctive membuat kacamata ini menjadi pilihan favorit para fashionista.',
        'specifications' => [
          ['label' => 'Material', 'value' => 'Metal'],
          ['label' => 'Berat', 'value' => '28g'],
          ['label' => 'Proteksi', 'value' => 'UV400'],
          ['label' => 'Garansi', 'value' => '1 Tahun'],
          ['label' => 'Warna', 'value' => 'Gold']
        ]
      ],
      [
        'image' => '/image/glasses/img10.png',
        'title' => 'KOLEKSI VINTAGE',
        'topic' => 'Retro Classic',
        'description' => 'Sentuhan vintage yang membawa Anda kembali ke era klasik. Desain retro yang never out of style.',
        'detail_description' => 'Terinspirasi dari desain kacamata era 70-an dengan sentuhan modern. Material berkualitas tinggi dengan finishing yang detail. Memberikan kesan vintage yang sophisticated dan timeless.',
        'specifications' => [
          ['label' => 'Material', 'value' => 'Acetate'],
          ['label' => 'Berat', 'value' => '30g'],
          ['label' => 'Proteksi', 'value' => 'UV400'],
          ['label' => 'Garansi', 'value' => '1 Tahun'],
          ['label' => 'Warna', 'value' => 'Coklat']
        ]
      ],
      [
        'image' => '/image/glasses/img11.png',
        'title' => 'KOLEKSI ELEGANT',
        'topic' => 'Luxury Frame',
        'description' => 'Kemewahan dalam setiap detail. Kacamata premium untuk Anda yang mengutamakan kualitas dan eksklusivitas.',
        'detail_description' => 'Frame mewah dengan desain eksklusif dan detail yang sangat teliti. Menggunakan material premium grade A dengan finishing yang sempurna. Setiap produk dilengkapi dengan sertifikat keaslian dan kotak khusus.',
        'specifications' => [
          ['label' => 'Material', 'value' => 'Titanium'],
          ['label' => 'Berat', 'value' => '18g'],
          ['label' => 'Proteksi', 'value' => 'Blue Light'],
          ['label' => 'Garansi', 'value' => '3 Tahun'],
          ['label' => 'Warna', 'value' => 'Silver']
        ]
      ],
      [
        'image' => '/image/glasses/img12.png',
        'title' => 'KOLEKSI CASUAL',
        'topic' => 'Everyday Wear',
        'description' => 'Desain kasual yang nyaman untuk penggunaan sehari-hari. Cocok untuk berbagai aktivitas dan suasana.',
        'detail_description' => 'Kacamata dengan desain minimalis yang versatile dan mudah dipadukan dengan berbagai gaya berpakaian. Ringan, nyaman, dan praktis untuk menemani aktivitas harian Anda dari pagi hingga malam.',
        'specifications' => [
          ['label' => 'Material', 'value' => 'Plastic'],
          ['label' => 'Berat', 'value' => '20g'],
          ['label' => 'Proteksi', 'value' => 'UV400'],
          ['label' => 'Garansi', 'value' => '1 Tahun'],
          ['label' => 'Warna', 'value' => 'Hitam']
        ]
      ]
    ];
  @endphp

  <x-showoff :items="$showoffItems" />
</div>

<x-testimonials />


@endsection