<script setup>
import { inject } from 'vue';
import NumbersCardBoardItem from './NumbersCardBoardItem.vue';

defineProps({
  numbers: {
    type: Array,
    required: true,
  }
})

const { heatmap } = inject('heatmap')
</script>

<template>
  <div
    v-auto-animate
    class="grid grid-cols-10 gap-0.5"
  >
    <NumbersCardBoardItem
      v-for="number in numbers"
      :key="number.number"
      :number="number"
      :heatmap="heatmap"
    />
  </div>
</template>
