<script setup>
import { ref, provide, onMounted } from 'vue';

import NumbersCard from './numbers-card/NumbersCard.vue'
import ResultsCard from './results-card/ResultsCard.vue'
import StatsCard from './stats-card/StatsCard.vue'
import { router } from '@inertiajs/vue3';

defineProps({
  numbers: {
    type: Array,
    default: () => []
  }
})

const heatmap = ref(route().params.heatmap === 'true')
const month = ref(route().params.month ?? '')

const updateHeatmap = (value) => heatmap.value = value
const updateMonth = (value) => month.value = value

provide('month', { month, updateMonth })
provide('heatmap', { heatmap, updateHeatmap })

onMounted(() => {
  router.reload({
    only: ['numbers'],
  })
})
</script>

<template>
  <div class="py-10 px-10">
    <div class="grid grid-cols-[1.7fr,.9fr,1.1fr] gap-x-5 mb-5">
      <NumbersCard :numbers="numbers" />
      <ResultsCard />
      <StatsCard />
    </div>
  </div>
</template>
