<script setup>
import { computed } from 'vue';
import BallNumber from '../partials/BallNumber.vue';
import { formatDateTime } from '@/helpers/format-datetime';

const props = defineProps({
  loading: {
    type: Boolean,
    default: false
  },
  numbers: {
    type: Array,
    default: () => []
  },
  heatmap: {
    type: Boolean,
    default: false
  }
})

const isNumbersEmpty = computed(() => !props.numbers.length)

const dataTipFor = (item) => `Concurso: ${item.game.concurso} - ${formatDateTime(item.game.date)}`
</script>

<template>
  <div>
    <AppContainer>
      <template #title>
        Números sem ocorrência há mais de 1 mês
      </template>

      <template #content>
        <div
          v-if="loading && isNumbersEmpty"
          class="text-center text-sm"
        >
          Carregando...
        </div>

        <div class="grid grid-cols-8 gap-2">
          <BallNumber
            v-for="item in numbers"
            :key="item"
            :number="item.number"
            :relative-occurrences="item.relative_occurrences"
            :heatmap="heatmap"
            small-style
            class="tooltip tooltip-left"
            :data-tip="dataTipFor(item)"
          >
            <template #default="{ number }">
              <span class="font-bold">{{ number }}</span>
            </template>
          </BallNumber>
        </div>
      </template>
    </AppContainer>
  </div>
</template>

