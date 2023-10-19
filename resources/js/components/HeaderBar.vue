<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { useAppStore } from '@/pinia/app';

const app = useAppStore()

const currentRoute = computed(() => {
  return app.route.current()
})
</script>

<template>
  <div class="h-14 bg-white shadow-lg px-10">
    <div class="flex gap-3 h-full font-bold items-center">
      <div>
        <Link
          :href="route('home.index')"
          :class="{
            'text-primary': currentRoute === 'home.index'
          }"
        >
          INÍCIO
        </Link>
      </div>
      <div>
        <Link
          :href="route('simulation.index')"
          :class="{
            'text-primary': currentRoute === 'simulation.index'
          }"
        >
          SIMULAÇÃO
        </Link>
      </div>
    </div>
  </div>
</template>
