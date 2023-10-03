module.exports = {
    env: {
      node: true,
    },
    extends: [
      'eslint:recommended',
      'plugin:vue/vue3-recommended'
    ],
    ignorePatterns: ['**/vendor/**/*.js'],
    rules: {
      'no-unused-vars': ['warn']
    }
  }
