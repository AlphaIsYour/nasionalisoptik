@extends('layouts.main')

@section('title', 'Kontak Kami - Optik Nasionalis Kacamata')

@section('content')
<div class="container mx-auto px-4 py-16">

    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-[#A78B7D] mb-4">LET'S STAY CONNECTED</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Have questions about finding the right pair of glasses, our services, or anything else? We're here to help. Reach out to us via WhatsApp, try giving us a call, or send an email — and we'll make sure you see the world in style.
        </p>
    </div>


    <div class="mb-8 rounded-lg overflow-hidden shadow-2xl mx-30">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.345!2d112.7508!3d-7.2575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTUnMjcuMCJTIDExMsKwNDUnMDIuOSJF!5e0!3m2!1sen!2sid!4v1234567890"
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            class="w-full">
        </iframe>
    </div>

   
    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center gap-3 bg-white hover:bg-gray-50 text-gray-800 px-8 py-4 rounded-full shadow-lg ">
            <svg class="w-6 h-6 text-[#A78B7D]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
            <div class="text-left">
                <p class="text-sm text-[#A78B7D]">Whatsapp</p>
                <p class="font-semibold text-[#A78B7D]">+6281234567890</p>
            </div>
        </a>

        <a href="mailto:info@optiknasionalis.com" class="flex items-center gap-3 bg-white hover:bg-gray-50 text-gray-800 px-8 py-4 rounded-full shadow-lg ">
            <svg class="w-6 h-6 text-[#A78B7D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <div class="text-left">
                <p class="text-sm text-[#A78B7D]">Email</p>
                <p class="font-semibold text-[#A78B7D]">info@optiknas.com</p>
            </div>
        </a>
    </div>

    <div class="mt-12 text-center">
        <h3 class="text-xl font-bold text-gray-800 mb-2">Nasionalis Optik</h3>
        <p class="text-gray-600">Jl. Contoh Alamat No. 123, Surabaya</p>
        <p class="text-gray-600">Buka: Senin - Sabtu, 09.00 - 20.00 WIB</p>
    </div>
</div>
@endsection