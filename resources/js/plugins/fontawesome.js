import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import {
  faChartSimple,
  faCircle,
  faCheck,
  faList,
} from "@fortawesome/free-solid-svg-icons";


library.add(
  faList,
  faChartSimple,
  faCircle,
  faCheck
)

export const useFontawesomePlugin = (app) => {
  app.component('FWIcon', FontAwesomeIcon)
}
