<script setup lang="ts">
import { Number } from '@/types'

type ContestNumberCompactProps = {
  number: Number
}

defineProps<ContestNumberCompactProps>()
</script>

<template>
  <div class="font-bold">
    {{ number.number }}
  </div>
</template>
