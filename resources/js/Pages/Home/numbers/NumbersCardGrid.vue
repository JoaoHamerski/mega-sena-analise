<script setup lang="ts">
import { Number } from '@/types'
import LotteryNumber from './LotteryNumber.vue'

type NumbersCardGrid = {
  numbers: Number[]
}

defineProps<NumbersCardGrid>()
</script>

<template>
  <div
    class="grid grid-cols-10 gap-1"
    v-auto-animate
  >
    <LotteryNumber
      v-for="number in numbers"
      :key="number.number"
      :number="number"
    />
  </div>
</template>
