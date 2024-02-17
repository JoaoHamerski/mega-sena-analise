<script setup lang="ts">
import type { Contest } from '@/types'
import ContestNumber from '@/components/contest-number/ContestNumber.vue'
import { DateTime } from 'luxon'
import { computed } from 'vue'

type ContestListItemProps = {
  contest: Contest
}

const props = defineProps<ContestListItemProps>()

const formattedDate = computed(() => DateTime.fromISO(props.contest.data).toLocaleString())
</script>

<template>
  <div
    class="p-3 flex flex-col gap-3 hover:bg-base-200 active:bg-base-300 transition-colors cursor-pointer"
  >
    <div class="flex justify-between items-start text-base-content">
      <span class="font-bold text-sm">{{ contest.concurso }}</span>
      <span class="text-xs text-neutral-600">{{ formattedDate }}</span>
    </div>
    <div class="flex justify-between">
      <ContestNumber
        :number="contest.bola_01"
        type="compact"
      />
      <ContestNumber
        :number="contest.bola_02"
        type="compact"
      />
      <ContestNumber
        :number="contest.bola_03"
        type="compact"
      />
      <ContestNumber
        :number="contest.bola_04"
        type="compact"
      />
      <ContestNumber
        :number="contest.bola_05"
        type="compact"
      />
      <ContestNumber
        :number="contest.bola_06"
        type="compact"
      />
    </div>
  </div>
</template>
