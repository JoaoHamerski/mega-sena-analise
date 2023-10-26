<script setup>
import { inject, computed } from 'vue';
import { replaceState } from '@/utils/replace-state'
import { useMegaSenaStore } from '@/pinia/mega-sena';

import DatePicker from '@/components/DatePicker.vue'

const emit = defineEmits(['update:heatmap', 'update:sort'])

defineProps({
  sort: undefined
})

const SORT_ENUM = {
  sequential: 'sequential',
  occurrences: 'occurrences'
}

const megaSenaStore = useMegaSenaStore()
const { month, updateMonth } = inject('month')

const onSortChange = (checked, value) => {
  const emittedValue = checked ? value : false

  replaceState({sort: emittedValue})

  emit('update:sort', emittedValue)
}

const onHeatmapChange = (value) => {
  megaSenaStore.setHeatmap(value)
}

const heatmap = computed(() => megaSenaStore.heatmap)
</script>

<template>
  <form>
    <div class="grid grid-cols-2 mb-5">
      <div class="self-center mr-2">
        <div class="mb-2">
          <AppCheckbox
            :model-value="SORT_ENUM.occurrences === sort"
            label="Ordenar por ocorrências"
            @update:model-value="e => onSortChange(e, SORT_ENUM.occurrences)"
          />
        </div>
        <div class="mb-2">
          <AppCheckbox
            :model-value="SORT_ENUM.sequential === sort"
            label="Ordenar por ocorrências em sequência"
            @update:model-value="e => onSortChange(e, SORT_ENUM.sequential)"
          />
        </div>
        <div>
          <AppCheckbox
            :model-value="heatmap"
            label="Mapa de calor"
            @update:model-value="onHeatmapChange"
          />
        </div>
      </div>
      <div>
        <DatePicker
          :model-value="month"
          name="month"
          label="RESULTADOS À PARTIR DE:"
          @update:model-value="updateMonth"
        />
      </div>
    </div>
  </form>
</template>
