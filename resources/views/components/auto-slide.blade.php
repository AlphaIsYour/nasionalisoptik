<div x-data="carousel()" x-init="startAutoSlide()" class="relative w-full overflow-hidden">
  <div class="flex transition-none" :style="`transform: translateX(-${position}px)`">
    <!-- Original items -->
    <template x-for="i in 8" :key="i">
      <div class="flex-shrink-0 w-40 h-20 bg-gray-600 rounded-lg mx-2"></div>
    </template>
    <!-- Duplicate items -->
    <template x-for="i in 8" :key="'dup-'+i">
      <div class="flex-shrink-0 w-40 h-20 bg-gray-600 rounded-lg mx-2"></div>
    </template>
  </div>
</div>

<script>
function carousel() {
  return {
    position: 0,
    itemWidth: 176,
    speed: 1,
    
    startAutoSlide() {
      setInterval(() => {
        this.position += this.speed;
        
        const totalWidth = this.itemWidth * 8;
        if (this.position >= totalWidth) {
          this.position = 0; // Reset tanpa transition
        }
      }, 20);
    }
  }
}
</script>