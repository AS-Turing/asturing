export const useSeoTitle = (title: string, suffix = 'AS-Turing') => {
    useHead({
        title: `${title} | ${suffix}`
    })
}