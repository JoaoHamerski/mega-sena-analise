<script setup lang="ts">
import { LotteryNumber } from '@/types'

export type ContestNumberNormalProps = {
  number: LotteryNumber
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
