@extends('layouts.main')

@section('title', 'Tentang Kami - Optik Nasionalis Kacamata')

@section('content')
<!-- Hero Section -->
<style>
      @font-face {
    font-family: 'CustomFont';
    src: url('/fonts/Bebaskai.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
  }

  .custom-font {
    font-family: 'CustomFont', sans-serif;
    letter-spacing: 0.05em;
  }
      @font-face {
    font-family: 'Mona';
    src: url('/fonts/mona-sans.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
  }

  .mona-sans {
    font-family: 'Mona', sans-serif;
    letter-spacing: 0.05em;
  }
      @font-face {
    font-family: 'Urban';
    src: url('/fonts/BebasKai.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
  }

  .urban-shadow {
    font-family: 'Urban', sans-serif;
    letter-spacing: 0.05em;
  }
</style>
<div class="bg-[#70574D] py-8 flex justify-center items-center">
    <h1 class="text-4xl text-white custom-font">TENTANG KAMI</h1>
</div>

<!-- Subtitle -->
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl md:text-4xl text-[#A78B7D] urban-shadow     text-center leading-relaxed max-w-5xl mx-auto">
        Berdiri sejak tahun 1994, Nasionalis Optik bergerak di bidang refraksionis optik.
    </h2>
</div>

<!-- Content Sections -->
<div class="container mx-auto px-16 space-y-8 pb-16 mona-sans">
    <!-- Section 1 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="w-full h-full">
            <img src="{{ asset('/image/about/image1.png') }}" alt="About 1" class="w-full h-full object-cover rounded-lg shadow-lg"/>
        </div>
        <div class="px-6">
            <p class="text-lg text-gray-700 leading-relaxed">
                Berdiri lebih dari dua dekade lalu, Nasionalis Optik terus berkembang dengan komitmen menghadirkan solusi penglihatan yang tepat dan terpercaya.
            </p>
        </div>
    </div>

    <!-- Section 2 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="px-6 order-2 md:order-1">
            <p class="text-lg text-gray-700 leading-relaxed">
                Berdiri lebih dari dua dekade lalu, Nasionalis Optik terus berkembang dengan komitmen menghadirkan solusi penglihatan yang tepat dan terpercaya.
            </p>
        </div>
        <div class="w-full h-full order-1 md:order-2">
            <img src="{{ asset('/image/about/image1.png') }}" alt="About 2" class="w-full h-full object-cover rounded-lg shadow-lg"/>
        </div>
    </div>

    <!-- Section 3 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="w-full h-full">
            <img src="{{ asset('/image/about/image1.png') }}" alt="About 3" class="w-full h-full object-cover rounded-lg shadow-lg"/>
        </div>
        <div class="px-6">
            <p class="text-lg text-gray-700 leading-relaxed">
                Berdiri lebih dari dua dekade lalu, Nasionalis Optik terus berkembang dengan komitmen menghadirkan solusi penglihatan yang tepat dan terpercaya.
            </p>
        </div>
    </div>

    <!-- Section 4 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="px-6 order-2 md:order-1">
            <p class="text-lg text-gray-700 leading-relaxed">
                Berdiri lebih dari dua dekade lalu, Nasionalis Optik terus berkembang dengan komitmen menghadirkan solusi penglihatan yang tepat dan terpercaya.
            </p>
        </div>
        <div class="w-full h-full order-1 md:order-2">
            <img src="{{ asset('/image/about/image1.png') }}" alt="About 4" class="w-full h-full object-cover rounded-lg shadow-lg"/>
        </div>
    </div>
</div>
@endsection