<script setup>
import ResultsCardListItem from './ResultsCardListItem.vue'

defineProps({
  results: {
    type: Array,
    required: true
  },
  heatmap: {
    type: Boolean,
    default: false
  }
})
</script>

<template>
  <ul>
    <ResultsCardListItem
      v-for="result in results"
      :key="result.id"
      :result="result"
      :heatmap="heatmap"
    />
  </ul>
</template>
