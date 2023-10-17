<script setup>
import { computed } from 'vue';

const props = defineProps({
  left: {
    type: Number,
    required: true
  },
  right: {
    type: Number,
    required: true
  }
})

const total = computed(() => props.left + props.right)

const percentage = computed(() => {
  const left = (props.left * 100) / total.value
  const right = (props.right * 100) / total.value

  return {left, right}
})
</script>

<template>
  <div
    class="flex justify-between w-full px-3 h-5 text-sm text-center font-bold text-white"
  >
    <div
      class="h-full bg-emerald-600 rounded-l"
      :style="{
        width: `${percentage.left}%`
      }"
    >
      {{ left }}
    </div>
    <div
      class="h-full bg-sky-600 rounded-r"
      :style="{
        width: `${percentage.right}%`
      }"
    >
      {{ right }}
    </div>
  </div>
</template>
