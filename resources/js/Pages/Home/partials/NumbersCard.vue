<script setup>
import NumbersCardItems from './NumbersCardItems.vue';
import NumbersCardForm from './NumbersCardForm.vue'
import { ref } from 'vue';

defineProps({
  numbers: {
    type: Array,
    required: true,
  },
});

const heatmap = ref(false)

const onHeatmapUpdate = (value) => {
  heatmap.value = value
}
</script>

<template>
  <div class="bg-white w-fit mx-auto mt-10 rounded-lg shadow-lg p-5">
    <NumbersCardForm @update:heatmap="onHeatmapUpdate" /> 
    <NumbersCardItems
      :numbers="numbers"
      :heatmap="heatmap"
    />
  </div>
</template>
