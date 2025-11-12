<style>
    .grid-item {
        position: relative;
        overflow: hidden;
    }
    
    .grid-item img {
        opacity: 0;
        transform: translateY(100%);
        animation: slideUpFromBottom 1s ease-out forwards;
    }
    
    .grid-item:nth-child(1) img { animation-delay: 0.8s; }
    .grid-item:nth-child(2) img { animation-delay: 0.6s; }
    .grid-item:nth-child(3) img { animation-delay: 0.4s; }
    .grid-item:nth-child(4) img { animation-delay: 0.2s; }
    .grid-item:nth-child(5) img { animation-delay: 0s; }
    
    @keyframes slideUpFromBottom {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        to { opacity: 1; }
    }
</style>

<div class="grid grid-cols-5 h-[81vh] w-full">
    <div class="grid-item bg-gradient-to-t from-[#5C5349] to-[#C2B09A]">
        <img src="{{ asset('/image/model/model1.png') }}" alt="Model 1" class="w-95 h-full object-cover">
    </div>
    <div class="grid-item bg-gradient-to-t from-[#938775] to-[#F9E4C7]">
        <img src="{{ asset('/image/model/model2.png') }}" alt="Model 2" class="w-95 h-full object-cover">
    </div>
    <div class="grid-item bg-gradient-to-t from-[#4B3A2A] to-[#B18963]">
        <img src="{{ asset('/image/model/model3.png') }}" alt="Model 3" class="w-95 h-full object-cover">
    </div>
    <div class="grid-item bg-gradient-to-t from-[#413631] to-[#A78B7D]">
        <img src="{{ asset('/image/model/model4.png') }}" alt="Model 4" class="w-95 h-full object-cover">
    </div>
    <div class="grid-item bg-gradient-to-t from-[#9D8170] to-[#A78B7D]">
        <img src="{{ asset('/image/model/model2.png') }}" alt="Model 5" class="w-95 h-full object-cover">
    </div>
</div>
<div class="h-[10vh] w-full bg-[#70574D] grid grid-cols-5 mb-8">
    <div class="flex items-center justify-center">
        <img src="{{ asset('/image/logo/b1.png') }}" alt="logo 1" class="w-22 h-10 object-cover">
    </div>
    <div class="flex items-center justify-center">
        <img src="{{ asset('/image/logo/b2.png') }}" alt="logo 2" class="w-25 h-9 object-cover">
    </div>
    <div class="flex items-center justify-center">
        <img src="{{ asset('/image/logo/b3.png') }}" alt="logo 3" class="w-27 h-10 object-cover">
    </div>
    <div class="flex items-center justify-center">
        <img src="{{ asset('/image/logo/b4.png') }}" alt="logo 4" class="w-25 h-6 object-cover">
    </div>
    <div class="flex items-center justify-center">
        <img src="{{ asset('/image/logo/b2.png') }}" alt="logo 5" class="w-25 h-9 object-cover">
    </div>
</div>