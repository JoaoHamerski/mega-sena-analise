<script setup>
defineProps({
  colorClass: {
    type: String,
    default: 'bg-blue-500'
  }
})
</script>

<template>
  <div>
    <div class="h-8" />
    <div class="relative z-10">
      <div
        class="text-white absolute -top-9 left-3 px-5 py-1.5 rounded-t-lg font-bold shadow-lg"
        :class="colorClass"
      >
        <slot name="title" />
      </div>
      <div class="bg-white p-5 shadow-lg rounded-lg relative z-10">
        <slot name="content" />
      </div>
    </div>
  </div>
</template>

