import { DateTime } from "luxon"

export const formatDateTime = (dateTime, format = 'dd/MM/yyyy') => {
  return DateTime.fromISO(dateTime).toFormat(format)
}

