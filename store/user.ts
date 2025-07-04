export const useUserStore = defineStore('user', () => {
    const token = ref<string | null>(null)

    const isAuthenticated = computed(() => !!token.value)

    function setToken(newToken: string) {
        token.value = newToken
        localStorage.setItem('token', newToken)
    }

    function loadToken() {
        const saved = localStorage.getItem('token')
        if (saved) token.value = saved
    }

    function logout() {
        token.value = null
        localStorage.removeItem('token')
    }

    return {
        token,
        isAuthenticated,
        setToken,
        loadToken,
        logout
    }
})