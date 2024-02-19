import type { LateLotteryNumber, LotteryNumber } from '@/types'
import type { Component } from 'vue'

export type ContestNumberTypes = 'normal' | 'compact' | 'extended'
export type ContestNumberTypesMap<P> = Record<ContestNumberTypes, P>

export type ContestNumberProps = {
  number: LotteryNumber | LateLotteryNumber
  type?: ContestNumberTypes
}

export type ContestNumberAttrs = {
  is: Component
  attrs: object
  wrapperClass: any
}
