<script setup lang="ts">
import { LateLotteryNumber } from '@/types'

export type ContestNumberExtendedProps = {
  lateNumber: LateLotteryNumber
}

defineProps<ContestNumberExtendedProps>()
</script>

<template>
  <div class="text-sm font-bold">{{ lateNumber.number }}</div>
  <div class="text-xs">{{ lateNumber.late_by_contests }} jogos</div>
</template>
