<script setup lang="ts">
import { computed } from 'vue'

const COLORS_MAP_CLASS = {
  primary: {
    title: 'bg-primary text-primary-content'
  }
}
type AppContainerProps = {
  color?: keyof typeof COLORS_MAP_CLASS
}

const props = withDefaults(defineProps<AppContainerProps>(), {
  color: 'primary'
})

const classes = computed(() => COLORS_MAP_CLASS[props.color])
</script>

<template>
  <div class="relative">
    <div
      class="ml-5 text-sm font-bold inline-block px-4 py-1.5 rounded-t-lg text-neutral-50"
      :class="classes.title"
    >
      <slot name="title" />
    </div>

    <div class="shadow-lg rounded p-4">
      <slot name="content" />
    </div>
  </div>
</template>
