{{-- resources/views/components/showoff.blade.php --}}

@props(['items' => []])

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

.showoff-carousel {
    position: relative;
    height: 800px;
    overflow: hidden;
    margin-top: 50px;
    font-family: Poppins, sans-serif;
}

.showoff-carousel .list {
    position: absolute;
    width: 1140px;
    max-width: 90%;
    height: 80%;
    left: 50%;
    transform: translateX(-50%);
}

.showoff-carousel .list .item {
    position: absolute;
    left: 0%;
    width: 70%;
    height: 100%;
    font-size: 15px;
    transition: left 0.5s, opacity 0.5s, width 0.5s;
}

.showoff-carousel .list .item:nth-child(n + 6) {
    opacity: 0;
}

.showoff-carousel .list .item:nth-child(2) {
    z-index: 10;
    transform: translateX(0);
}

.showoff-carousel .list .item img {
    width: 80%;
    position: absolute;
    right: -35%;
    top: 50%;
    transform: translateY(-50%);
    transition: right 1.5s;
    object-fit: cover;
}

.showoff-carousel .list .item .introduce {
    opacity: 0;
    pointer-events: none;
}

.showoff-carousel .list .item:nth-child(2) .introduce {
    opacity: 1;
    pointer-events: auto;
    width: 400px;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    transition: opacity 0.5s;
}

.showoff-carousel .list .item .introduce .title {
    font-size: 2em;
    font-weight: 500;
    line-height: 1em;
    color: #A78B7D;
}

.showoff-carousel .list .item .introduce .topic {
    font-size: 4em;
    font-weight: 500;
    color: #333;
}

.showoff-carousel .list .item .introduce .des {
    font-size: small;
    color: #5559;
    margin-top: 15px;
}

.showoff-carousel .list .item .introduce .seeMore {
    font-family: Poppins;
    margin-top: 1.2em;
    padding: 5px 0;
    border: none;
    border-bottom: 1px solid #555;
    background-color: transparent;
    font-weight: bold;
    letter-spacing: 3px;
    transition: background 0.5s;
    cursor: pointer;
}

.showoff-carousel .list .item .introduce .seeMore:hover {
    background: #eee;
}

.showoff-carousel .list .item .introduce .navigation-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
    margin-left: -25px; /* Geser 10px ke kiri hanya di desktop */
}

.showoff-carousel .list .item .introduce .navigation-buttons button {
    width: 180px;
    height: 50px;
    border-radius: 4px;
    font-family: Poppins, sans-serif;
    border: 2px solid #A78B7D;
    font-size: 16px;
    font-weight: 500;
    background-color: white;
    color: #A78B7D;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    letter-spacing: 1px;
}

.showoff-carousel .list .item .introduce .navigation-buttons button:hover {
    background-color: #A78B7D;
    color: white;
}

.showoff-carousel .list .item .introduce .navigation-buttons button.prev-btn::before {
    content: '←';
    font-size: 20px;
    font-weight: bold;
}

.showoff-carousel .list .item .introduce .navigation-buttons button.next-btn::after {
    content: '→';
    font-size: 20px;
    font-weight: bold;
}

.showoff-carousel .list .item:nth-child(1) {
    transform: translateX(-100%) translateY(-5%) scale(1.5);
    filter: blur(30px);
    z-index: 11;
    opacity: 0;
    pointer-events: none;
}

.showoff-carousel .list .item:nth-child(3) {
    transform: translate(50%, 10%) scale(0.8);
    filter: blur(10px);
    z-index: 9;
}

.showoff-carousel .list .item:nth-child(4) {
    transform: translate(90%, 20%) scale(0.5);
    filter: blur(30px);
    z-index: 8;
}

.showoff-carousel .list .item:nth-child(5) {
    transform: translate(120%, 30%) scale(0.3);
    filter: blur(40px);
    z-index: 7;
    opacity: 0;
    pointer-events: none;
}

/* Animation text in item2 */
.showoff-carousel .list .item:nth-child(2) .introduce .title,
.showoff-carousel .list .item:nth-child(2) .introduce .topic,
.showoff-carousel .list .item:nth-child(2) .introduce .des,
.showoff-carousel .list .item:nth-child(2) .introduce .seeMore,
.showoff-carousel .list .item:nth-child(2) .introduce .navigation-buttons {
    opacity: 0;
    animation: showContent 0.5s 1s ease-in-out 1 forwards;
}

@keyframes showContent {
    from {
        transform: translateY(-30px);
        filter: blur(10px);
    }
    to {
        transform: translateY(0);
        opacity: 1;
        filter: blur(0px);
    }
}

.showoff-carousel .list .item:nth-child(2) .introduce .topic {
    animation-delay: 1.2s;
}

.showoff-carousel .list .item:nth-child(2) .introduce .des {
    animation-delay: 1.4s;
}

.showoff-carousel .list .item:nth-child(2) .introduce .seeMore {
    animation-delay: 1.6s;
}

/* Next click */
.showoff-carousel.next .item:nth-child(1) {
    animation: transformFromPosition2 0.5s ease-in-out 1 forwards;
}

@keyframes transformFromPosition2 {
    from {
        transform: translateX(0);
        filter: blur(0px);
        opacity: 1;
    }
}

.showoff-carousel.next .item:nth-child(2) {
    animation: transformFromPosition3 0.7s ease-in-out 1 forwards;
}

@keyframes transformFromPosition3 {
    from {
        transform: translate(50%, 10%) scale(0.8);
        filter: blur(10px);
        opacity: 1;
    }
}

.showoff-carousel.next .item:nth-child(3) {
    animation: transformFromPosition4 0.9s ease-in-out 1 forwards;
}

@keyframes transformFromPosition4 {
    from {
        transform: translate(90%, 20%) scale(0.5);
        filter: blur(30px);
        opacity: 1;
    }
}

.showoff-carousel.next .item:nth-child(4) {
    animation: transformFromPosition5 1.1s ease-in-out 1 forwards;
}

@keyframes transformFromPosition5 {
    from {
        transform: translate(120%, 30%) scale(0.3);
        filter: blur(40px);
        opacity: 0;
    }
}

/* Previous */
.showoff-carousel.prev .list .item:nth-child(5) {
    animation: transformFromPosition4 0.5s ease-in-out 1 forwards;
}

.showoff-carousel.prev .list .item:nth-child(4) {
    animation: transformFromPosition3 0.7s ease-in-out 1 forwards;
}

.showoff-carousel.prev .list .item:nth-child(3) {
    animation: transformFromPosition2 0.9s ease-in-out 1 forwards;
}

.showoff-carousel.prev .list .item:nth-child(2) {
    animation: transformFromPosition1 1.1s ease-in-out 1 forwards;
}

@keyframes transformFromPosition1 {
    from {
        transform: translateX(-100%) translateY(-5%) scale(1.5);
        filter: blur(30px);
        opacity: 0;
    }
}

/* Detail */
.showoff-carousel .list .item .detail {
    opacity: 0;
    pointer-events: none;
}

/* ShowDetail */
.showoff-carousel.showDetail .list .item:nth-child(3),
.showoff-carousel.showDetail .list .item:nth-child(4) {
    left: 100%;
    opacity: 0;
    pointer-events: none;
}

.showoff-carousel.showDetail .list .item:nth-child(2) {
    width: 100%;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .introduce {
    opacity: 0;
    pointer-events: none;
}

.showoff-carousel.showDetail .list .item:nth-child(2) img {
    right: 50%;
    width: 60%;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .detail {
    opacity: 1;
    width: 50%;
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    text-align: right;
    pointer-events: auto;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .detail .title {
    font-size: 4em;
    color: #333;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .detail .specifications {
    display: flex;
    gap: 10px;
    width: 100%;
    border-top: 1px solid #5553;
    margin-top: 20px;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .detail .specifications div {
    width: 90px;
    text-align: center;
    flex-shrink: 0;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .detail .specifications div p:nth-child(1) {
    font-weight: bold;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .checkout button {
    font-family: Poppins;
    background-color: transparent;
    border: 1px solid #5555;
    margin-left: 5px;
    padding: 5px 10px;
    letter-spacing: 2px;
    font-weight: 500;
    cursor: pointer;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .checkout button:nth-child(2) {
    background-color: #A78B7D;
    color: #eee;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .detail .title,
.showoff-carousel.showDetail .list .item:nth-child(2) .detail .des,
.showoff-carousel.showDetail .list .item:nth-child(2) .detail .specifications,
.showoff-carousel.showDetail .list .item:nth-child(2) .detail .checkout {
    opacity: 0;
    animation: showContent 0.5s 1s ease-in-out 1 forwards;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .detail .des {
    animation-delay: 1.2s;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .detail .specifications {
    animation-delay: 1.4s;
}

.showoff-carousel.showDetail .list .item:nth-child(2) .detail .checkout {
    animation-delay: 1.6s;
}

.arrows {
    position: absolute;
    bottom: 40px;
    width: 1140px;
    max-width: 90%;
    display: flex;
    justify-content: center;
    left: 50%;
    transform: translateX(-50%);
}

#back {
    position: absolute;
    z-index: 100;
    bottom: 0%;
    left: 50%;
    transform: translateX(-50%);
    border: none;
    border-bottom: 1px solid #555;
    font-family: Poppins;
    font-weight: bold;
    letter-spacing: 3px;
    background-color: transparent;
    padding: 10px;
    opacity: 0;
    transition: opacity 0.5s;
    cursor: pointer;
}

.showoff-carousel.showDetail #back {
    opacity: 1;
}

.showoff-carousel.showDetail .navigation-buttons {
    display: none;
}

.showoff-carousel::before {
    width: 500px;
    height: 300px;
    content: '';
    background-image: linear-gradient(70deg, #A78B7D, #8B7A6D);
    position: absolute;
    z-index: -1;
    border-radius: 20% 30% 80% 10%;
    filter: blur(150px);
    top: 50%;
    left: 50%;
    transform: translate(-10%, -50%);
    transition: 1s;
}

.showoff-carousel.showDetail::before {
    transform: translate(-100%, -50%) rotate(90deg);
    filter: blur(130px);
}

@media screen and (max-width: 991px) {
    .showoff-carousel .list .item {
        width: 90%;
    }
    .showoff-carousel.showDetail .list .item:nth-child(2) .detail .specifications {
        overflow: auto;
    }
    .showoff-carousel.showDetail .list .item:nth-child(2) .detail .title {
        font-size: 2em;
    }
    /* Reset margin-left untuk tablet */
    .showoff-carousel .list .item .introduce .navigation-buttons {
        margin-left: 0;
    }
}

@media screen and (max-width: 767px) {
    .showoff-carousel {
        height: 600px;
    }
    .showoff-carousel .list .item {
        width: 100%;
        font-size: 10px;
    }
    .showoff-carousel .list {
        height: 100%;
    }
    .showoff-carousel .list .item:nth-child(2) .introduce {
        width: 50%;
    }
    .showoff-carousel .list .item img {
        width: 40%;
    }
    .showoff-carousel.showDetail .list .item:nth-child(2) .detail {
        backdrop-filter: blur(10px);
        font-size: small;
    }
    .showoff-carousel .list .item:nth-child(2) .introduce .des,
    .showoff-carousel.showDetail .list .item:nth-child(2) .detail .des {
        height: 100px;
        overflow: auto;
    }
    .showoff-carousel.showDetail .list .item:nth-child(2) .detail .checkout {
        display: flex;
        width: max-content;
        float: right;
    }
    .showoff-carousel .list .item .introduce .navigation-buttons button {
        width: 140px;
        height: 45px;
        font-size: 14px;
    }
    /* Reset margin-left untuk mobile */
    .showoff-carousel .list .item .introduce .navigation-buttons {
        margin-left: 0;
    }
}
</style>

<div class="showoff-carousel">
    <div class="list">
        @forelse($items as $item)
        <div class="item">
            <img src="{{ $item['image'] ?? '/image/default.png' }}" alt="{{ $item['topic'] ?? 'Product' }}">
            
            <div class="introduce">
                <div class="title">{{ $item['title'] ?? 'KOLEKSI SPESIAL' }}</div>
                <div class="topic">{{ $item['topic'] ?? 'Kacamata Premium' }}</div>
                <div class="des">
                    {{ $item['description'] ?? 'Koleksi kacamata terbaik dengan kualitas premium dan desain modern untuk melengkapi gaya Anda.' }}
                </div>
                <button class="seeMore">LIHAT DETAIL &#8599;</button>
                
                <div class="navigation-buttons">
                    <button class="prev-btn">PREV</button>
                    <button class="next-btn">NEXT</button>
                </div>
            </div>
            
            <div class="detail">
                <div class="title">{{ $item['topic'] ?? 'Kacamata Premium' }}</div>
                <div class="des">
                    {{ $item['detail_description'] ?? $item['description'] ?? 'Produk berkualitas tinggi dengan material terbaik dan desain yang elegan. Cocok untuk berbagai aktivitas dan memberikan kenyamanan maksimal sepanjang hari.' }}
                </div>
                
                @if(isset($item['specifications']))
                <div class="specifications">
                    @foreach($item['specifications'] as $spec)
                    <div>
                        <p>{{ $spec['label'] }}</p>
                        <p>{{ $spec['value'] }}</p>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <div class="checkout">
                    <button>TAMBAH KE KERANJANG</button>
                    <button>BELI SEKARANG</button>
                </div>
            </div>
        </div>
        @empty
        {{-- Default items jika tidak ada data --}}
        @for($i = 1; $i <= 6; $i++)
        <div class="item">
            <img src="/image/products/product{{ $i }}.png" alt="Produk {{ $i }}">
            
            <div class="introduce">
                <div class="title">KOLEKSI SPESIAL</div>
                <div class="topic">Kacamata Modern</div>
                <div class="des">
                    Koleksi kacamata terbaik dengan kualitas premium dan desain modern untuk melengkapi gaya Anda sehari-hari.
                </div>
                <button class="seeMore">LIHAT DETAIL &#8599;</button>
                
                <div class="navigation-buttons">
                    <button class="prev-btn">PREV</button>
                    <button class="next-btn">NEXT</button>
                </div>
            </div>
            
            <div class="detail">
                <div class="title">Kacamata Modern</div>
                <div class="des">
                    Produk berkualitas tinggi dengan material terbaik dan desain yang elegan. Cocok untuk berbagai aktivitas dan memberikan kenyamanan maksimal sepanjang hari dengan proteksi UV optimal.
                </div>
                <div class="specifications">
                    <div>
                        <p>Material</p>
                        <p>Premium</p>
                    </div>
                    <div>
                        <p>Berat</p>
                        <p>25g</p>
                    </div>
                    <div>
                        <p>Proteksi</p>
                        <p>UV400</p>
                    </div>
                    <div>
                        <p>Garansi</p>
                        <p>1 Tahun</p>
                    </div>
                    <div>
                        <p>Warna</p>
                        <p>Hitam</p>
                    </div>
                </div>
                <div class="checkout">
                    <button>TAMBAH KE KERANJANG</button>
                    <button>BELI SEKARANG</button>
                </div>
            </div>
        </div>
        @endfor
        @endforelse
    </div>
    
    <div class="arrows">
        <button id="back">Kembali &#8599;</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let carousel = document.querySelector('.showoff-carousel');
    let listHTML = document.querySelector('.showoff-carousel .list');
    let seeMoreButtons = document.querySelectorAll('.seeMore');
    let backButton = document.getElementById('back');
    
    // Event delegation untuk tombol prev dan next
    carousel.addEventListener('click', function(e) {
        if (e.target.classList.contains('next-btn')) {
            showSlider('next');
        } else if (e.target.classList.contains('prev-btn')) {
            showSlider('prev');
        }
    });

    let unAcceptClick;
    const showSlider = (type) => {
        let allNavButtons = document.querySelectorAll('.navigation-buttons button');
        allNavButtons.forEach(btn => btn.style.pointerEvents = 'none');

        carousel.classList.remove('next', 'prev');
        let items = document.querySelectorAll('.showoff-carousel .list .item');
        
        if(type === 'next') {
            listHTML.appendChild(items[0]);
            carousel.classList.add('next');
        } else {
            listHTML.prepend(items[items.length - 1]);
            carousel.classList.add('prev');
        }
        
        clearTimeout(unAcceptClick);
        unAcceptClick = setTimeout(() => {
            allNavButtons.forEach(btn => btn.style.pointerEvents = 'auto');
        }, 2000);
    }

    seeMoreButtons.forEach((button) => {
        button.onclick = function() {
            carousel.classList.remove('next', 'prev');
            carousel.classList.add('showDetail');
        }
    });

    backButton.onclick = function() {
        carousel.classList.remove('showDetail');
    }
});
</script>