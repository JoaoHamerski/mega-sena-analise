<script setup>
import { computed } from 'vue';
import BallNumber from '../partials/BallNumber.vue';

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

