import {navigateTo} from "nuxt/app";
import {useUserStore} from "../store/user";

export async function useApiFetch(endpoint: string, options: RequestInit = {}) {
    const userStore = useUserStore()

    if (!userStore.token) {
        userStore.loadToken()
    }

    const token = userStore.token
    if (!token) {
        if (process.client) navigateTo('/admin')
        throw new Error('Session expirée ou non autorisée')
    }

    const defautHeader = {
        'Content-Type': 'application/json',
        ...(token && { Authorization: `Bearer ${token.value}` }),
    }

    const response = await fetch(`http://backend.localhost:8000${endpoint}`, {
        ...options,
        headers: {
            ...defautHeader,
            ...(options.headers || {})
        }
    })

    if (!response.ok) {
        userStore.logout()
        if (process.client) navigateTo('/admin')
        throw new Error('Session expirée ou non autorisée')
    }

    return await response.json()
}