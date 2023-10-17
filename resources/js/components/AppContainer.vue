<script setup>
import { computed } from 'vue';

const props = defineProps({
  colorClass: {
    type: String,
    default: 'bg-blue-500'
  },
  padding: {
    type: Boolean,
    default: true
  }
})

const contentClassNames = computed(() => {
  const classes = []


  if (props.padding) {
    classes.push('p-5')
  }

  return classes
})

const titleClassNames = computed(() => {
  const classes = []

  classes.push(props.colorClass)

  return classes
})
</script>

<template>
  <div>
    <div class="h-8" />
    <div class="relative z-10">
      <div
        class="text-white absolute -top-9 left-3 rounded-t-lg font-bold shadow-lg px-5 py-1.5"
        :class="titleClassNames"
      >
        <slot name="title" />
      </div>
      <div
        class="bg-white shadow-lg rounded-lg relative z-10"
        :class="contentClassNames"
      >
        <slot name="content" />
      </div>
    </div>
  </div>
</template>

