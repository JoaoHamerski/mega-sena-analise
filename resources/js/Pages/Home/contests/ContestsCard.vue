<script setup lang="ts">
import type { Contest, Paginated } from '@/types'
import ContestsListItem from './ContestsListItem.vue'
import { ref, onMounted } from 'vue'

const contests = ref<Contest[]>([])

const fetchContests = () => {
  fetch(route('api.contests'))
    .then((response) => response.json())
    .then((data: Paginated<Contest>) => {
      contests.value = data.data
    })
}

onMounted(() => {
  fetchContests()
})
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
        <ContestsListItem
          v-for="contest in contests"
          :key="contest.concurso"
          :contest="contest"
        />
      </div>
    </template>
  </AppCard>
</template>
