export const queryParams = (param = null) => {
  const params = new URLSearchParams(window.location.search)
  const entries = {}

  if (param) {
    return params.get(param)
  }

  for (const [key, value] of params.entries()) {
    entries[key] = value
  }

  return entries
}
