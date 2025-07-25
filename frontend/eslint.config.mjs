// eslint.config.js
import js from '@eslint/js'
import ts from '@typescript-eslint/eslint-plugin'
import tsParser from '@typescript-eslint/parser'
import vuePlugin from 'eslint-plugin-vue'
import vueParser from 'vue-eslint-parser'

/** @type {import("eslint").Linter.FlatConfig[]} */
export default [
  {
    ignores: ['node_modules', '.nuxt', 'dist'],
  },
  {
    files: ['**/*.ts', '**/*.js'],
    languageOptions: {
      globals: {
        defineNuxtConfig: 'readonly',
        defineNuxtRouteMiddleware: 'readonly',
        defineStore: 'readonly',
        useHead: 'readonly',
        useRoute: 'readonly',
        navigateTo: 'readonly',
        useRuntimeConfig: 'readonly',
        ref: 'readonly',
        computed: 'readonly',
        process: 'readonly',
        localStorage: 'readonly',
        fetch: 'readonly',
        clearTimeout: 'readonly',
        setTimeout: 'readonly',
        console: 'readonly',
      },
      parser: tsParser,
      parserOptions: {
        project: './tsconfig.json',
        ecmaVersion: 'latest',
        sourceType: 'module',
      },
    },
    plugins: {
      '@typescript-eslint': ts,
    },
    rules: {
      ...js.configs.recommended.rules,
      ...ts.configs.recommended.rules,
      indent: ['error', 2],
      semi: ['error', 'never'],
      quotes: ['error', 'single', { avoidEscape: true }],
    },
  },
  {
    files: ['**/*.vue'],
    languageOptions: {
      globals: {
        defineNuxtConfig: 'readonly',
        defineNuxtRouteMiddleware: 'readonly',
        defineStore: 'readonly',
        useHead: 'readonly',
        useRoute: 'readonly',
        navigateTo: 'readonly',
        useRuntimeConfig: 'readonly',
        ref: 'readonly',
        computed: 'readonly',
        process: 'readonly',
        localStorage: 'readonly',
        fetch: 'readonly',
        clearTimeout: 'readonly',
        setTimeout: 'readonly',
        console: 'readonly',
      },
      parser: vueParser,
      parserOptions: {
        parser: tsParser,
        ecmaVersion: 'latest',
        sourceType: 'module',
        extraFileExtensions: ['.vue'],
        project: './tsconfig.json',
      },
    },
    plugins: {
      vue: vuePlugin,
    },
    rules: {
      // ...vuePlugin.configs['vue3-recommended'].rules,
      'vue/html-indent': ['error', 2],
      // Auto-imports handling - no need to import Vue components or Nuxt modules
      'import/no-unresolved': 'off',
      'import/named': 'off',
      'import/namespace': 'off',
      'import/default': 'off',
      'import/no-named-as-default': 'off',
      'import/no-named-as-default-member': 'off',
      'import/no-duplicates': 'off',

      // Tab/spacing rules
      'indent': ['error', 2], // Use 2 spaces for indentation
      'no-tabs': 'error', // Disallow tabs

      // Semicolon rules
      'semi': ['error', 'never'], // No semicolons
      'semi-spacing': ['error', { 'before': false, 'after': true }],

      // Common best practices
      'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
      'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',

      // Quotes
      'quotes': ['error', 'single', { 'avoidEscape': true }],

      // Trailing commas
      'comma-dangle': ['error', 'always-multiline'],

      // Object spacing
      'object-curly-spacing': ['error', 'always'],

      // Array spacing
      'array-bracket-spacing': ['error', 'never'],

      // Spacing around operators
      'space-infix-ops': 'error',

      // Spacing in function calls
      'func-call-spacing': ['error', 'never'],

      // Spacing in blocks
      'block-spacing': ['error', 'always'],

      // Brace style
      'brace-style': ['error', '1tbs', { 'allowSingleLine': true }],

      // Max line length
      // 'max-len': ['error', { 'code': 100, 'ignoreUrls': true, 'ignoreStrings': true, 'ignoreTemplateLiterals': true, 'ignoreRegExpLiterals': true }],

      // Variables
      'no-unused-vars': ['error', { 'argsIgnorePattern': '^_' }],
    },
  },
]

