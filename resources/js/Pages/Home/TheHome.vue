<script setup>
import { ref } from 'vue';

import NumbersCard from './numbers-card/NumbersCard.vue'
import ResultsCard from './results-card/ResultsCard.vue'
import StatsCard from './stats-card/StatsCard.vue'

defineProps({
  numbers: {
    type: Array,
    required: true
  }
})

const heatmap = ref(route().params.heatmap === 'true')
</script>

<template>
  <div class="py-10 px-10">
    <div class="grid grid-cols-[1.7fr,.9fr,1.1fr] gap-x-5 mb-5">
      <NumbersCard
        v-model:heatmap="heatmap"
        :numbers="numbers"
      />
      <ResultsCard
        :heatmap="heatmap"
      />
      <StatsCard :heatmap="heatmap" />
    </div>
  </div>
</template>
