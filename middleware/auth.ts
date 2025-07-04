import {useUserStore} from "../store/user";

export default defineNuxtRouteMiddleware((to, from) => {
    const user = useUserStore()

    if(!user.token) {
        const token = localStorage.getItem('token')

        if(token) {
            user.setToken(token)
        } else {
            return navigateTo('/admin')
        }
    }
})