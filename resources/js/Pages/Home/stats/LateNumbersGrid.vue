<script setup lang="ts">
import { LateNumber } from '@/types'
import LotteryNumber from '../common/LotteryNumber.vue'

type LateNumberGrid = {
  lateNumbers: LateNumber[]
}

defineProps<LateNumberGrid>()
</script>

<template>
  <div
    class="grid grid-cols-5 gap-1"
    v-auto-animate
  >
    <LotteryNumber
      type="extended"
      v-for="number in lateNumbers"
      :number="number"
      :key="number.number"
    />
  </div>
</template>
