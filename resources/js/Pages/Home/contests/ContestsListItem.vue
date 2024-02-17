<script setup lang="ts">
import type { Contest } from '@/types'
import { DateTime } from 'luxon'
import { computed } from 'vue'

import ContestNumber from '@/components/contest-number/ContestNumber.vue'

type ContestListItemProps = {
  contest: Contest
}

const NUMBER_LABELS = ['bola_01', 'bola_02', 'bola_03', 'bola_04', 'bola_05', 'bola_06'] as const
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
      <template
        v-for="label in NUMBER_LABELS"
        :key="label"
      >
        <ContestNumber
          :number="contest[label]"
          type="compact"
        />
      </template>
    </div>
  </div>
</template>
