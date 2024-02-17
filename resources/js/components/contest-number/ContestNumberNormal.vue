<script setup lang="ts">
import { Number } from '@/types'

type ContestNumberNormalProps = {
  number: Number
  isSorted: boolean
}

defineProps<ContestNumberNormalProps>()
</script>

<template>
  <span class="font-bold text-lg">{{ number.number }}</span>
  <span
    class="text-xs"
    :class="isSorted ? 'font-bold' : ''"
  >
    {{ number.occurrences }}
  </span>
</template>
