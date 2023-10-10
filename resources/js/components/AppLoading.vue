<script setup>
defineProps({
  value: {
    type: Boolean,
    default: false
  }
})
</script>

<template>
  <div
    v-if="value"
    class="absolute top-0 left-0 bottom-0 right-0 z-20 flex justify-center items-center"
  >
    <div class="bg-white w-full h-full absolute opacity-30" />
    <span class="loading loading-ring loading-lg absolute" />
  </div>
</template>
