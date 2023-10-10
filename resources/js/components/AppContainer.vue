<script setup>
defineProps({
  colorClass: {
    type: String,
    default: 'bg-blue-500'
  }
})
</script>

<template>
  <div class="relative mt-8 z-10">
    <div
      class="text-white absolute -top-8 left-3 px-5 py-1.5 rounded-t-lg font-bold"
      :class="colorClass"
    >
      <slot name="title" />
    </div>
    <div class="bg-white p-5 shadow-lg rounded-lg ">
      <slot name="content" />
    </div>
  </div>
</template>

