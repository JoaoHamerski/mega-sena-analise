<script setup lang="ts">
import { LateNumber } from '@/types'

defineProps<{
  lateNumber: LateNumber
}>()
</script>

<template>
  <div class="text-sm font-bold">{{ lateNumber.number }}</div>
  <div class="text-xs">{{ lateNumber.late_by_contests }} jogos</div>
</template>
