/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
  root: true,
  env: {
    node: true
  },
  'extends': [
    'plugin:vue/vue3-essential',
    'eslint:recommended',
    '@vue/eslint-config-typescript',
    '@vue/eslint-config-prettier/skip-formatting'
  ],
  parserOptions: {
    ecmaVersion: 'latest'
  },
  rules: {
    'no-duplicate-imports': ['warn'],
    'vue/padding-line-between-blocks': ['error'],
    'vue/html-self-closing': [
      'error',
      { html: { component: 'always', void: 'always' } },
    ],
  },
}
