<script setup lang="ts">
import { computed } from 'vue'

type AppCardProps = {
  color?: keyof typeof COLORS_CLASSES_MAP
}

const COLORS_CLASSES_MAP = {
  success: {
    title: 'bg-success text-success-content'
  },
  primary: {
    title: 'bg-primary text-primary-content'
  }
}

const props = withDefaults(defineProps<AppCardProps>(), {
  color: 'primary'
})

const classes = computed(() => COLORS_CLASSES_MAP[props.color])
</script>

<template>
  <div class="shadow-lg rounded-lg overflow-hidden">
    <div
      class="p-4 font-bold"
      :class="classes.title"
    >
      <slot name="title" />
    </div>
    <div class="bg-white p-4">
      <slot name="content" />
    </div>
  </div>
</template>
