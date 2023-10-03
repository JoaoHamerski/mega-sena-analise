const components = import.meta.glob('./**/App*.vue', {
    eager: true
  })
  
  export const registerGlobalComponents = (Vue) => {
    Object.entries(components).forEach(([path, definition]) => {
      const componentName = path
      .split('/')
      .pop()
      .replace(/\.\w+$/, '')
  
      Vue.component(componentName, definition.default)
    })
  }