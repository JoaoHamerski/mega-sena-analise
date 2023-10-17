<script setup>
import { computed } from 'vue';

const props = defineProps({
  color: {
    type: String,
    default: 'bg-primary'
  },
  padding: {
    type: Boolean,
    default: true
  }
})

const headerClass = computed(() => {
  const classes = []

  classes.push(props.color)

  return classes
})
</script>

<template>
  <div class="bg-white rounded-lg shadow-lg">
    <div
      v-if="$slots.header"
      class="p-5 text-white font-bold rounded-t-lg"
      :class="headerClass"
    >
      <slot name="header" />
    </div>
    <div
      :class="{
        'p-5': padding
      }"
    >
      <slot name="body" />
    </div>
  </div>
</template>
