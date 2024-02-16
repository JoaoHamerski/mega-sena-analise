<script setup lang="ts">
import { Number } from '@/types'

type LotteryNumberNormalProps = {
  number: Number
  isSorted: boolean
}

defineProps<LotteryNumberNormalProps>()
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
