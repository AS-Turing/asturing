import type { GlobalNotification } from '../types/notification'
import { nanoid } from 'nanoid'

const notifications = ref<GlobalNotification[]>([])

function addSuccessNotification (message: string) {
  notifications.value.push({ id: nanoid(), message, type: 'success' })
}

function addErrorNotification (message: string) {
  notifications.value.push({ id: nanoid(), message, type: 'error' })
}

function addInfoNotification (message: string) {
  notifications.value.push({ id: nanoid(), message, type: 'info' })
}

function addWarningNotification (message: string) {
  notifications.value.push({ id: nanoid(), message, type: 'warning' })
}

function removeNotification (id: string) {
  notifications.value = notifications.value.filter((notification: GlobalNotification) :boolean => notification.id !== id)
}

export function useNotifications () {
  return {
    notifications,
    notifyError: addErrorNotification,
    notifySuccess: addSuccessNotification,
    notifyInfo: addInfoNotification,
    notifyWarning: addWarningNotification,
    removeNotification,
  }
}
