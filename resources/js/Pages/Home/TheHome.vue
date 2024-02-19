<script setup lang="ts">
import type { Number } from '@/types'
import MainLayout from '@/components/layouts/MainLayout.vue'
import NumbersCard from './results/NumbersCard.vue'
import ContestsCard from './contests/ContestsCard.vue'
import StatsCard from './stats/StatsCard.vue'

type TheHomeProps = {
  numbers: Number[]
}

defineProps<TheHomeProps>()
</script>

<template>
  <MainLayout class="grid grid-cols-[4fr,2fr,3fr] gap-3 h-[90%]">
    <NumbersCard :numbers="numbers" />
    <ContestsCard />
    <StatsCard />
  </MainLayout>
</template>
