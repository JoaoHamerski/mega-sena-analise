<script setup>
import ResultsCardList from './ResultsCardList.vue'

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
  <AppCard
    class="w-fit"
    color="bg-info-content"
  >
    <template #header>
      Lista de concursos
    </template>
    <template #body>
      <div class="max-h-[70vh] overflow-auto custom-scroll -mr-3 pr-4">
        <ResultsCardList
          :results="results"
          :heatmap="heatmap"
        />
      </div>
    </template>
  </AppCard>
</template>
