@extends('layouts.main')

@section('title', 'Beranda - Optik Nasionalis Kacamata')

@section('content')
@include('components.banner')
<div class="flex justify-center w-full px-4">
  <div class="max-w-4xl mb-8 text-center">
    <h1 class="font-bold text-4xl mb-4">FIND THE PERFECT GLASSES FOR YOUR STYLE</h1>
    <p>Glasses are more than just vision aids – they’re a fashion statement. From clear lenses to stylish sunglasses, every pair tells a story about who you are.</p>
  </div>
</div>

@include('components.auto-slide')
@endsection