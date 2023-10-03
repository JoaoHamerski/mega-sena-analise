<script setup>
import NumbersCardItem from './NumbersCardItem.vue';

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
  <table
    class="border-separate"
  >
    <div
      v-auto-animate
      class="grid grid-cols-10 gap-0.5"
    >
      <NumbersCardItem
        v-for="number in numbers"
        :key="number.number"
        :number="number"
        :heatmap="heatmap"
      />
    </div>
  </table>
</template>
