import type { VueGtmUseOptions } from '@gtm-support/vue-gtm'

declare module '#app' {
  interface NuxtApp {
    $gtm: ReturnType<typeof import('@gtm-support/vue-gtm').useGtm>
  }
}

declare module 'vue' {
  interface ComponentCustomProperties {
    $gtm: ReturnType<typeof import('@gtm-support/vue-gtm').useGtm>
  }
}

export {}
