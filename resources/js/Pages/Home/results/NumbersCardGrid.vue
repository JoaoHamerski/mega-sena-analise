<script setup lang="ts">
import { LotteryNumber } from '@/types'
import ContestNumber from '@/components/contest-number/ContestNumber.vue'

type NumbersCardGrid = {
  numbers: LotteryNumber[]
}

defineProps<NumbersCardGrid>()
</script>

<template>
  <div
    class="grid grid-cols-10 gap-1"
    v-auto-animate
  >
    <ContestNumber
      v-for="number in numbers"
      :key="number.number"
      :number="number"
    />
  </div>
</template>
