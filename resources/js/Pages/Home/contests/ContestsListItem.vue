<script setup lang="ts">
import type { Contest } from '@/types'
import { DateTime } from 'luxon'
import { computed } from 'vue'
import { useAppStore } from '@/store/app-store'
import { CONTEST_NUMBER_LABELS } from './contest-number-labels'

import ContestNumber from '@/components/contest-number/ContestNumber.vue'

type ContestListItemProps = {
  contest: Contest
}

const appStore = useAppStore()
const props = defineProps<ContestListItemProps>()

const formattedDate = computed(() => DateTime.fromISO(props.contest.data).toLocaleString())

const selectedContest = computed(() => appStore.selectedContest)
const isContestSelected = computed(() => selectedContest.value?.concurso === props.contest.concurso)
const onContestItemClick = () => {
  if (selectedContest.value?.concurso === props.contest.concurso) {
    appStore.setSelectedContest(null)
    return
  }

  appStore.setSelectedContest(props.contest)
}
</script>

<template>
  <div
    @click.prevent="onContestItemClick"
    class="p-3 flex flex-col gap-3 hover:bg-base-200 active:bg-base-300 transition-all cursor-pointer"
    :class="{
      'border-l-4 border-primary': isContestSelected
    }"
  >
    <div class="flex justify-between items-start text-base-content">
      <span class="font-bold text-sm">{{ contest.concurso }}</span>
      <span class="text-xs text-neutral-600">{{ formattedDate }}</span>
    </div>

    <div class="flex justify-between">
      <template
        v-for="label in CONTEST_NUMBER_LABELS"
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
