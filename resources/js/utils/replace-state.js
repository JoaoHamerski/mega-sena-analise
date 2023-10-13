import { queryParams } from "./query-params"

export const replaceState = (props) => {
  const currentParams = queryParams()
  const newParams = {...currentParams, ...props}

  history.replaceState({}, '', '?' + new URLSearchParams(newParams).toString())
}
