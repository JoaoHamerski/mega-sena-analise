<script setup>
defineProps({
    label: {
        type: String,
        default: ''
    }
})
</script> 

<template>
  <label class="cursor-pointer flex">
    <input
      type="checkbox"
      class="toggle toggle-primary me-4"
    >
    <div class="label-text">{{ label }}</div>
  </label>
</template>