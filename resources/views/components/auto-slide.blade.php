<div x-data="carousel()" x-init="startAutoSlide()" class="relative w-full overflow-hidden bg-white py-8">
  <div class="flex transition-none" :style="`transform: translateX(-${position}px)`">
    <!-- Original items -->
    <template x-for="i in 9" :key="i">
      <div class="flex-shrink-0 w-40 h-24 mx-4 flex items-center justify-center">
        <img :src="`/image/logo/${i}.png`" :alt="`Logo ${i}`" class="max-w-full max-h-full object-contain">
      </div>
    </template>
    <!-- Duplicate items for seamless loop -->
    <template x-for="i in 9" :key="'dup-'+i">
      <div class="flex-shrink-0 w-40 h-24 mx-4 flex items-center justify-center">
        <img :src="`/image/logo/${i}.png`" :alt="`Logo ${i}`" class="max-w-full max-h-full object-contain">
      </div>
    </template>
  </div>
</div>

<script>
function carousel() {
  return {
    position: 0,
    itemWidth: 192, // 160px (w-40) + 32px (mx-4 total)
    speed: 1,
    
    startAutoSlide() {
      setInterval(() => {
        this.position += this.speed;
        
        const totalWidth = this.itemWidth * 9;
        if (this.position >= totalWidth) {
          this.position = 0;
        }
      }, 20);
    }
  }
}
</script>