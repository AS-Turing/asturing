import {useUserStore} from '../store/user'

export default defineNuxtRouteMiddleware(() => {
  const user = useUserStore()

  if(!user.token) {
    const token: string | null = localStorage.getItem('token')

    if(token) {
      user.setToken(token)
    } else {
      return navigateTo('/admin')
    }
  }
})