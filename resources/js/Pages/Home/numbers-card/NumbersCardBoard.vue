<script setup>
import NumbersCardBoardItem from './NumbersCardBoardItem.vue';

defineProps({
  numbers: {
    type: Array,
    required: true,
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
    />
  </div>
</template>
