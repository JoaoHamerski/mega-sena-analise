<script setup>
import BallNumber from '../partials/BallNumber.vue';

defineProps({
  heatmap: {
    type: Boolean,
    default: false
  },
  number: {
    type: Object,
    required: true
  }
})

</script>

<template>
  <BallNumber
    class="px-4 py-2 text-center rounded border border-slate-500 transition-colors w-16"
    :number="number.number"
    :relative-occurrences="number.relative_occurrences"
    :heatmap="heatmap"
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
