<script setup lang="ts">
import MainLayout from '@/Components/layouts/MainLayout.vue'
import NumbersCard from './numbers/NumbersCard.vue'
import type { Number, Game } from '@/types'

type TheHomeProps = {
  numbers: Number[]
  games: Game[]
}

defineProps<TheHomeProps>()
</script>

<template>
  <MainLayout>
    <div class="w-1/2">
      <NumbersCard :numbers="numbers" />
    </div>
  </MainLayout>
</template>
