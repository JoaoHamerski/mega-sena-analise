<script setup>
import StatsCardOddEvenOccurrences from './StatsCardOddEvenOccurrences.vue';
import StatsCardOddEvenResults from './StatsCardOddEvenResults.vue';

defineEmits(['update:loading'])
</script>

<template>
  <AppContainer>
    <template #title>
      Pares e ímpares
    </template>
    <template #content>
      <StatsCardOddEvenOccurrences @update:loading="$emit('update:loading', $event)" />
      <StatsCardOddEvenResults @update:loading="$emit('update:loading', $event)" />
    </template>
  </AppContainer>
</template>
