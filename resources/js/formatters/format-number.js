export const formatNumber = (value) => {
  return new Intl.NumberFormat('pt-BR').format(value)
}
