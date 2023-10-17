<script setup>
import { computed } from 'vue';

const props = defineProps({
  total: {
    type: Number,
    default: null
  },
  size: {
    type: Number,
    default: null
  },
  percentage: {
    type: Number,
    default: null
  },
  bgClass: {
    type: String,
    default: 'bg-emerald-600'
  }
})

const computedPercentage = computed(() =>
  props.percentage ?? (props.size * 100) / props.total
)

const remainingPercentage = computed(() => 100 - computedPercentage.value)
</script>

<template>
  <div class="h-5 flex w-full">
    <div
      class="h-full rounded-l transition-[width]"
      :class="[bgClass, {'rounded': computedPercentage === 100}]"
      :style="{
        width: `${computedPercentage}%`
      }"
    />
    <div
      class="h-full bg-slate-200 rounded-r transition-[width]"
      :style="{
        width: `${remainingPercentage}%`
      }"
    />
  </div>
</template>
