<script setup>
import NumbersCardBoardItem from './NumbersCardBoardItem.vue';

defineProps({
  numbers: {
    type: Array,
    required: true,
  },
  heatmap: {
    type: Boolean,
    default: false
  }
})

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
