<script setup lang="ts">
import type { GlobalNotification } from '../../types/notification'
import { useNotifications } from '../../.nuxt/imports'

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
    class="flex w-full items-center gap-3 p-2 shadow-md md:rounded-lg md:p-4 text-primary"
    :class="notification?.type === 'error' ? `bg-red-500` : `bg-green-500`"
  >
    <span class="flex-1">{{ notification?.message }}</span>
    <button
      class="btn btn-circle btn-ghost"
      type="button"
      @click="removeCurrentNotification"
    >
      <Icon
        class="size-5"
        name="material-symbols:close"
      />
    </button>
  </div>
</template>
