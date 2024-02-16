<script setup lang="ts">
import { Number } from '@/types'

type LotteryNumberCompactProps = {
  number: Number
}

defineProps<LotteryNumberCompactProps>()
</script>

<template>
  <div class="font-bold">
    {{ number.number }}
  </div>
</template>
