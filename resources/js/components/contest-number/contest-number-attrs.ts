import type { ContestNumberTypesMap } from '@/types/components'
import type { Component } from 'vue'

import ContestNumberNormal from './ContestNumberNormal.vue'
import ContestNumberExtended from './ContestNumberExtended.vue'
import ContestNumberCompact from './ContestNumberCompact.vue'

export const contestNumberIs: ContestNumberTypesMap<Component> = {
  normal: ContestNumberNormal,
  extended: ContestNumberExtended,
  compact: ContestNumberCompact
}

export const contestNumberWrapperClass: ContestNumberTypesMap<string> = {
  normal: 'w-auto flex flex-col border-2 rounded justify-center items-center h-16',
  extended: 'w-auto flex flex-col border-2 rounded justify-center items-center h-16',
  compact: 'p-2 flex items-center justify-center border-2 rounded-full w-10 h-10 text-sm'
}
