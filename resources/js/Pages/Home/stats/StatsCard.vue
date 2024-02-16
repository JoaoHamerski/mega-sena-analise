<script setup lang="ts">
import LateNumbers from './LateNumbers.vue'
</script>

<template>
  <AppCard color="secondary">
    <template #title>
      <FWIcon
        :icon="['fas', 'chart-simple']"
        fixed-width
      />
      Estatísticas
    </template>

    <template #content>
      <LateNumbers />
    </template>
  </AppCard>
</template>
