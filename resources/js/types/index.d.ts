export type LotteryNumber = {
  number: number
  occurrences: number
  relative_occurrence: number
}

export type LateLotteryNumber = LotteryNumber & {
  last_contest: Contest
  late_by_contests: number
}

export type Contest = {
  concurso: number
  data: string
  bola_01: LotteryNumber
  bola_02: LotteryNumber
  bola_03: LotteryNumber
  bola_04: LotteryNumber
  bola_05: LotteryNumber
  bola_06: LotteryNumber
}

export type LateNumbersResponse = {
  data: LateLotteryNumber[]
  late_by_days: number
}

export type Paginated<T> = {
  data: T[]
}
