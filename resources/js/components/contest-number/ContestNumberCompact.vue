<script setup lang="ts">
import { LotteryNumber } from '@/types'

export type ContestNumberCompactProps = {
  number: LotteryNumber
}

defineProps<ContestNumberCompactProps>()
</script>

<template>
  <div class="font-bold">
    {{ number.number }}
  </div>
</template>
