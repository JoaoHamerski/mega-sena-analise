<script setup lang="ts">
import { ref } from 'vue'
import { useAppStore } from '@/store/app-store'

const appStore = useAppStore()
</script>

<template>
  <div class="flex flex-col gap-2">
    <AppCheckbox
      label="Ordenar por ocorrências"
      :model-value="appStore.sortByOccurrences"
      @update:model-value="appStore.setSortByOccurrences"
    />

    <AppCheckbox
      label="Mapa de calor"
      :model-value="appStore.heatMap"
      @update:model-value="appStore.setHeatMap"
    />
  </div>
</template>
