export type Number = {
  number: number
  occurrences: number
  relative_occurrence: number
}

export type LateNumber = Number & {
  last_game: Game
  late_by_games: number
}

export type Game = {
  concurso: number
  data: string
  bola_01: Number
  bola_02: Number
  bola_03: Number
  bola_04: Number
  bola_05: Number
  bola_06: Number
}

export type LateNumbersResponse = {
  data: LateNumber[]
  late_by_days: number
}
