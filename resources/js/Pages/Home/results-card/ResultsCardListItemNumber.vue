<script setup>
import { computed } from 'vue';
import BallNumber from '../partials/BallNumber.vue'

const props = defineProps({
  active: {
    type: Boolean,
    required: true
  },
  number: {
    type: Object,
    required: true
  },
  classes: {
    type: Object,
    required: true
  }
})

const isEven = computed(() => props.number.number % 2 === 0)
</script>

<template>
  <BallNumber
    :number="number.number"
    :relative-occurrences="number.relative_occurrences"
    style-name="circle"
  >
    <template #default="{ number: ballNumber }">
      <b>{{ ballNumber }}</b>
    </template>

    <template #append>
      <div
        class="w-full h-1 mt-3 transition-opacity"
        :class="{
          'opacity-50': !active,
          'opacity-100': active,
          [classes.even.bgColor]: isEven,
          [classes.odd.bgColor]: !isEven
        }"
      />
    </template>
  </BallNumber>
</template>
