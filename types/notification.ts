export type NotificationType = 'error' | 'success'

export interface GlobalNotification {
  id: string
  message: string
  type: NotificationType
}
