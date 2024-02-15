<script setup lang="ts">
import type { Game } from '@/types'

type GameListItemProps = {
  game: Game
}

defineProps<GameListItemProps>()
</script>

<template>
  <div class="p-3 hover:bg-base-200 active:bg-base-300 transition-colors cursor-pointer">
    <div class="flex justify-between text-sm text-base-content">
      <span class="font-bold">{{ game.concurso }}</span>
      <span>{{ game.data }}</span>
    </div>
  </div>
</template>
