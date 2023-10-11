import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import {
  faChartSimple,
  faCircle,
  faList
} from "@fortawesome/free-solid-svg-icons";


library.add(
  faList,
  faChartSimple,
  faCircle
)

export const useFontawesomePlugin = (app) => {
  app.component('FWIcon', FontAwesomeIcon)
}
