<script setup>
import { inject, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import { replaceState } from '@/utils/replace-state'
import { useMegaSenaStore } from '@/pinia/mega-sena';

import DatePicker from '@/components/DatePicker.vue'

const megaSenaStore = useMegaSenaStore()
const emit = defineEmits(['update:heatmap', 'update:sort'])

defineProps({
  sort: {
    type: Boolean,
    required: true
  }
})

const { month, updateMonth } = inject('month')

const onSortChange = (value) => {
  replaceState({sort: value})

  emit('update:sort', value)
}

const onMonthChange = (value) => {
  updateMonth(value)
  submit()
}

const onHeatmapChange = (value) => {
  megaSenaStore.setHeatmap(value)
}

const submit = () => {
  const params = {
    ...route().params,
    ...{ month: month.value }
  }

  router.reload({
    data: params,
    preserveState: true,
    only: ['numbers']
  })
}

const heatmap = computed(() => megaSenaStore.heatmap)
</script>

<template>
  <form>
    <div class="grid grid-cols-2 mb-5">
      <div class="self-center mr-2">
        <div class="mb-2">
          <AppCheckbox
            :model-value="sort"
            label="Ordenar por ocorrências"
            @update:model-value="onSortChange"
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
          @update:model-value="onMonthChange"
        />
      </div>
    </div>
  </form>
</template>
