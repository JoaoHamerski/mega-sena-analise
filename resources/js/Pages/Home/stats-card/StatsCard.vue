<script setup>
import { ref } from 'vue';
import StatsCardLateNumbers from './StatsCardLateNumbers.vue';

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
      <StatsCardLateNumbers
        v-model:loading="loading"
        :heatmap="heatmap"
      />
    </template>
  </AppCard>
</template>
