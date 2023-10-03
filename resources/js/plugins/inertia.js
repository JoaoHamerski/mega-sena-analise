import AppLayout from '@/Pages/AppLayout.vue'

export const resolveComponent = (name) => {
  const pages = import.meta.glob('../Pages/**/*.vue', { eager: true })
  const page = pages[`../Pages/${name}.vue`]

  page.default.layout = page.default.layout || AppLayout

  return page
}
