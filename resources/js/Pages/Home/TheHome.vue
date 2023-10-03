<script setup>
import NumbersCard from './partials/NumbersCard.vue'

defineProps({
  numbers: {
    type: Array,
    required: true
  }
})
</script>

<template>
  <div>
    <NumbersCard :numbers="numbers" />
  </div>
</template>
