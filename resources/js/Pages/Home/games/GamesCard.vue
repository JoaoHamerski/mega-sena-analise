<script setup lang="ts">
import type { Game } from '@/types'
import GamesListItem from './GamesListItem.vue'

type GamesCardProps = {
  games: Game[]
}

defineProps<GamesCardProps>()
</script>

<template>
  <AppCard no-padding>
    <template #title>
      <FWIcon
        :icon="['fas', 'list']"
        fixed-width
      />
      Lista de concursos
    </template>

    <template #content>
      <div class="overflow-auto relative h-[80vh]">
        <GamesListItem
          v-for="game in games"
          :key="game.concurso"
          :game="game"
        />
      </div>
    </template>
  </AppCard>
</template>
