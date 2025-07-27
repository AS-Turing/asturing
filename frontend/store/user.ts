import {jwtDecode} from 'jwt-decode'

interface JwtPayload {
    exp: number
    sub?: string
    [key: string]: any
}
export const useUserStore = defineStore('user', () => {
  const token = ref<string | null>(null)

  const isAuthenticated = computed(() => !!token.value)

  let logoutTimer: ReturnType<typeof setTimeout> | null = null

  function setToken(newToken: string) {
    token.value = newToken
    localStorage.setItem('token', newToken)
  }

  function loadToken() {
    if( process.client) {
      const saved = localStorage.getItem('token')

      if (saved && !isTokenExpired(saved)) {
        token.value = saved
        startTokenTimer()
      } else {
        localStorage.removeItem('token')
      }
    }
  }

  function logout() {
    token.value = null
    localStorage.removeItem('token')
    if (logoutTimer) {
      clearTimeout(logoutTimer)
      logoutTimer = null
    }
  }

  function isTokenExpired(token: string) : boolean{
    try {
      const decoded = jwtDecode<JwtPayload>(token)
      const now = Math.floor((Date.now() / 1000))
      return decoded.exp < now
    } catch (e) {
      return true
    }
  }

  function startTokenTimer() {
    if (!token.value || logoutTimer) return

    try {
      const decoded = jwtDecode<JwtPayload>(token.value)
      const now = Math.floor(Date.now() / 1000)
      const delay = (decoded.exp - now) * 1000

      if (delay > 0) {
        logoutTimer = setTimeout(() => {
          logout()
          navigateTo('/admin')
        }, delay)
      }
    } catch {
      logout()
    }
  }

  return {
    token,
    isAuthenticated,
    setToken,
    loadToken,
    logout,
    isTokenExpired,
    startTokenTimer
  }
})