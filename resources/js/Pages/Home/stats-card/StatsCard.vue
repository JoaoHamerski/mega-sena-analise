<script setup>
import { ref } from 'vue';

import StatsCardLateNumbers from './StatsCardLateNumbers.vue';
import StatsCardOddEvenOccurrences from './StatsCardOddEvenOccurrences.vue';

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
        class="mb-5"
      />
      <StatsCardOddEvenOccurrences v-model:loading="loading" />
    </template>
  </AppCard>
</template>
