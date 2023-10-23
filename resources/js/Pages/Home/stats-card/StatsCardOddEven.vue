<script setup>
import { ref } from 'vue';

import StatsCardOddEvenOccurrences from './StatsCardOddEvenOccurrences.vue';
import StatsCardOddEvenResults from './StatsCardOddEvenResults.vue';


const loading = ref(false)

const onLoadingUpdate = (value) => {
  loading.value = value
}
</script>

<template>
  <AppContainer>
    <template #title>
      Pares e ímpares
    </template>
    <template #content>
      <AppLoading :value="loading" />
      <StatsCardOddEvenOccurrences @update:loading="onLoadingUpdate" />
      <StatsCardOddEvenResults @update:loading="onLoadingUpdate" />
    </template>
  </AppContainer>
</template>
