<script setup lang="ts">
import type { Number, Game } from '@/types'
import MainLayout from '@/Components/layouts/MainLayout.vue'
import NumbersCard from './numbers/NumbersCard.vue'
import GamesCard from './games/GamesCard.vue'

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
  <MainLayout class="grid grid-cols-[2fr,1fr,1fr] gap-3 h-[90%]">
    <NumbersCard :numbers="numbers" />
    <GamesCard :games="games.data" />
  </MainLayout>
</template>
