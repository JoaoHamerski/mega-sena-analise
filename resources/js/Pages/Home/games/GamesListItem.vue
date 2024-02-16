<script setup lang="ts">
import type { Game } from '@/types'
import LotteryNumber from '../common/LotteryNumber.vue'
import { DateTime } from 'luxon'
import { computed } from 'vue'

type GameListItemProps = {
  game: Game
}

const props = defineProps<GameListItemProps>()

const formattedDate = computed(() => DateTime.fromISO(props.game.data).toLocaleString())
</script>

<template>
  <div
    class="p-3 flex flex-col gap-3 hover:bg-base-200 active:bg-base-300 transition-colors cursor-pointer"
  >
    <div class="flex justify-between items-start text-base-content">
      <span class="font-bold text-sm">{{ game.concurso }}</span>
      <span class="text-xs text-neutral-600">{{ formattedDate }}</span>
    </div>
    <div class="flex justify-between">
      <LotteryNumber
        :number="game.bola_01"
        type="compact"
      />
      <LotteryNumber
        :number="game.bola_02"
        type="compact"
      />
      <LotteryNumber
        :number="game.bola_03"
        type="compact"
      />
      <LotteryNumber
        :number="game.bola_04"
        type="compact"
      />
      <LotteryNumber
        :number="game.bola_05"
        type="compact"
      />
      <LotteryNumber
        :number="game.bola_06"
        type="compact"
      />
    </div>
  </div>
</template>
