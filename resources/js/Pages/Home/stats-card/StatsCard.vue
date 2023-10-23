<script setup>
import StatsCardLateNumbers from './StatsCardLateNumbers.vue';
import StatsCardOddEven from './StatsCardOddEven.vue';
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
        <StatsCardLateNumbers
          class="mt-2 mb-5"
        />
        <StatsCardOddEven class="mb-5" />
      </div>
    </template>
  </AppCard>
</template>
