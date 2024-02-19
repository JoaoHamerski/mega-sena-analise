<script setup lang="ts">
import { ref } from 'vue'
import { useAppStore } from '@/store/app-store'

const emit = defineEmits(['update:sort-by-occurrences'])
const appStore = useAppStore()

const sortByOccurrences = ref(false)

const onSortChange = (value: boolean) => {
  sortByOccurrences.value = value

  emit('update:sort-by-occurrences', value)
}
</script>

<template>
  <div class="flex flex-col gap-2">
    <AppCheckbox
      label="Ordenar por ocorrências"
      :model-value="sortByOccurrences"
      @update:model-value="onSortChange"
    />

    <AppCheckbox
      label="Mapa de calor"
      :model-value="appStore.heatMap"
      @update:model-value="appStore.setHeatMap"
    />
  </div>
</template>
