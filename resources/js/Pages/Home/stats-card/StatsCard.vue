<script setup>
import { ref } from 'vue';
import StatsCardLateNumbers from './StatsCardLateNumbers.vue';
import StatsCardOddEvenOccurrences from './StatsCardOddEvenOccurrences.vue';

defineProps({
  heatmap: {
    type: Boolean,
    default: false
  }
})

const loading = ref(false)
</script>

<template>
  <AppCard
    color="bg-gray-600"
  >
    <template #header>
      <FWIcon
        icon="fas fa-chart-simple"
        fixed-width
      />
      Estatísticas
    </template>

    <template #body>
      <AppLoading :value="loading" />

      <div class="pb-5">
        <StatsCardLateNumbers
          v-model:loading="loading"
          :heatmap="heatmap"
        />
      </div>

      <div>
        <StatsCardOddEvenOccurrences v-model:loading="loading" />
      </div>
    </template>
  </AppCard>
</template>
