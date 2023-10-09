<script setup>
import NumbersCardBoard from './NumbersCardBoard.vue';
import NumbersCardForm from './NumbersCardForm.vue'
import { ref } from 'vue';

const emit = defineEmits(['update:heatmap'])
defineProps({
  numbers: {
    type: Array,
    required: true,
  },
});

const heatmap = ref(false)

const onHeatmapUpdate = (value) => {
  heatmap.value = value
  emit('update:heatmap', value)
}
</script>

<template>
  <AppCard
    color="bg-green-600"
  >
    <template #header>
      Resultados da MEGA SENA
    </template>
    <template #body>
      <NumbersCardForm @update:heatmap="onHeatmapUpdate" />
      <NumbersCardBoard
        :numbers="numbers"
        :heatmap="heatmap"
      />
    </template>
  </AppCard>
</template>
