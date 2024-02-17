<script setup lang="ts">
import type { Number, Game } from '@/types'
import MainLayout from '@/Components/layouts/MainLayout.vue'
import NumbersCard from './numbers/NumbersCard.vue'
import GamesCard from './games/GamesCard.vue'
import StatsCard from './stats/StatsCard.vue'

type Paginated<T> = {
  data: T[]
}

type TheHomeProps = {
  numbers: Number[]
  games: Paginated<Game>
}

defineProps<TheHomeProps>()
</script>

<template>
  <MainLayout class="grid grid-cols-[4fr,2fr,3fr] gap-3 h-[90%]">
    <NumbersCard :numbers="numbers" />
    <GamesCard :games="games.data" />
    <StatsCard />
  </MainLayout>
</template>
