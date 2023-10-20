import { queryParams } from "./query-params"

export const replaceState = (props) => {
  const currentParams = queryParams()
  const newParams = {...currentParams, ...props}
  const queryString = '?' + new URLSearchParams(newParams).toString()

  window.history.replaceState({}, '', queryString)
}
