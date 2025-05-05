import type { GlobalNotification } from '~/types/notification'
import { nanoid } from 'nanoid'

const notifications = ref<GlobalNotification[]>([])

function addSuccessNotification (message: string) {
  notifications.value.push({ id: nanoid(), message, type: 'success' })
}

function addErrorNotification (message: string) {
  notifications.value.push({ id: nanoid(), message, type: 'error' })
}

function removeNotification (id: string) {
  notifications.value = notifications.value.filter((notification) => notification.id !== id)
}

export function useNotifications () {
  return {
    notifications,
    notifyError: addErrorNotification,
    notifySuccess: addSuccessNotification,
    removeNotification,
  }
}
