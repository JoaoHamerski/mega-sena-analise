<script setup>
import BallNumber from '../partials/BallNumber.vue';

defineProps({
  number: {
    type: Object,
    required: true
  }
})

</script>

<template>
  <BallNumber
    :number="number.number"
    :relative-occurrences="number.relative_occurrences"
  >
    <template #default="{ number: ballNumber }">
      <div class="text-xl font-bold">
        {{ ballNumber }}
      </div>
      <div class="text-grey">
        {{ number.occurrences }}
      </div>
    </template>
  </BallNumber>
</template>
