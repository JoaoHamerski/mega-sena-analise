<script setup>
import HeaderBar from '@/components/HeaderBar.vue'
import { router } from '@inertiajs/vue3';

import { useAppStore } from '@/pinia/app';

const app = useAppStore()

router.on('navigate', () => {
  app.setCurrentRoute()
})
</script>

<template>
  <div class="h-full">
    <HeaderBar />
    <slot />
  </div>
</template>
