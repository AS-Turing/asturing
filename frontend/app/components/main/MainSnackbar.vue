<script setup lang="ts">
import type { GlobalNotification } from '../../types/notification'

const props = defineProps<{
  notification: GlobalNotification
}>()

const { removeNotification } = useNotifications()

function removeCurrentNotification () {
  removeNotification(props.notification.id)
}

const timeToWait = 7000
setTimeout(removeCurrentNotification, timeToWait)
</script>

<template>
  <div
    class="flex w-full items-center gap-4 p-5 shadow-2xl md:rounded-2xl md:p-6 text-white backdrop-blur-lg border-2 transition-all duration-300 hover:scale-[1.02] hover:shadow-3xl animate-gradient"
    :class="{
      'bg-gradient-to-br from-red-500 via-red-600 to-coral border-red-400/50': notification?.type === 'error',
      'bg-gradient-to-br from-primary via-secondary to-accent border-primary/50': notification?.type === 'success',
      'bg-gradient-to-br from-blue-500 via-cyan-500 to-blue-600 border-blue-400/50': notification?.type === 'info',
      'bg-gradient-to-br from-yellow-500 via-orange-500 to-coral border-yellow-400/50': notification?.type === 'warning'
    }"
  >
    <span class="font-semibold leading-tight text-shadow flex-1">{{ notification?.message }}</span>
    <button
      class="p-2 hover:bg-white/30 rounded-full transition-all duration-200 hover:rotate-90 flex-shrink-0"
      type="button"
      @click="removeCurrentNotification"
      aria-label="Fermer la notification"
    >
      <Icon
        class="w-5 h-5"
        name="mdi:close"
      />
    </button>
  </div>
</template>
