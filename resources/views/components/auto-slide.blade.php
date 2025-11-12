<div x-data="carousel()" x-init="startAutoSlide()" class="relative w-full overflow-hidden">
  <div class="flex transition-transform duration-500 ease-linear" :style="`transform: translateX(-${position}px)`">
    <!-- Original items -->
    <template x-for="i in 8" :key="i">
      <div class="flex-shrink-0 w-40 h-20 bg-gray-600 rounded-lg mx-2"></div>
    </template>
    <!-- Duplicate items untuk infinity effect -->
    <template x-for="i in 8" :key="'dup-'+i">
      <div class="flex-shrink-0 w-40 h-20 bg-gray-600 rounded-lg mx-2"></div>
    </template>
  </div>
</div>

<script>
function carousel() {
  return {
    position: 0,
    itemWidth: 176, // 160px width + 16px margin (mx-2)
    speed: 1, // pixel per frame
    
    startAutoSlide() {
      setInterval(() => {
        this.position += this.speed;
        
        // Reset ke awal saat mencapai setengah (karena ada duplikat)
        const totalWidth = this.itemWidth * 8;
        if (this.position >= totalWidth) {
          this.position = 0;
        }
      }, 20); // 50fps
    }
  }
}
</script>