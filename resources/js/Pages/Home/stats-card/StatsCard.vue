<script setup>
import { ref } from 'vue';

import StatsCardLateNumbers from './StatsCardLateNumbers.vue';
import StatsCardOddEven from './StatsCardOddEven.vue';

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
      <div class="h-[70vh] overflow-y-auto custom-scroll custom-scroll-spaced px-5 -mx-5 relative">
        <AppLoading :value="loading" />
        <StatsCardLateNumbers
          v-model:loading="loading"
          class="mt-2 mb-5"
        />
        <StatsCardOddEven class="mb-5" />
      </div>
    </template>
  </AppCard>
</template>
