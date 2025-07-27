import { defineNuxtRouteMiddleware, navigateTo } from '#app'
import { useUserStore } from '../store/user'
import type { RouteLocationNormalized } from 'vue-router'

export default defineNuxtRouteMiddleware((to: RouteLocationNormalized) => {
  const user = useUserStore()

  if (!user.token) {
    const token = localStorage.getItem('token')
    if (token) {
      user.setToken(token)
    }
  }

  if (!user.isAuthenticated && to.path !== '/admin') {
    return navigateTo('/admin')
  }

  if (user.isAuthenticated && (to.path === '/admin' || to.path === '/admin/')) {
    return navigateTo('/admin/dashboard')
  }
})