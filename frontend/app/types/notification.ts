export type NotificationType = 'error' | 'success' | 'info' | 'warning'

export interface GlobalNotification {
  id: string
  message: string
  type: NotificationType
}
