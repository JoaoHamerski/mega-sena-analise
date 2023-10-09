<script setup>
import { ref } from 'vue';
import NumbersCard from './numbers-card/NumbersCard.vue'
import ResultsCard from './results-card/ResultsCard.vue'

defineProps({
  numbers: {
    type: Array,
    required: true
  },
  results: {
    type: Object,
    default: () => ({})
  }
})

const heatmap = ref(false)

const onHeatmapUpdate = (value) => {
  heatmap.value = value
}
</script>

<template>
  <div class="mt-10 px-10 flex justify-around">
    <NumbersCard
      :numbers="numbers"
      @update:heatmap="onHeatmapUpdate"
    />

    <!-- <ResultsCard
      :results="results"
      :heatmap="heatmap"
    /> -->
  </div>
</template>
