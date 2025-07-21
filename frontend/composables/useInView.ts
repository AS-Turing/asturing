import { ref, onMounted, watch, nextTick } from 'vue'

const useInView = () => {
    const isVisible = ref(false)
    const el = ref<HTMLElement | null>(null)

    onMounted(async () => {
        if (typeof window === 'undefined') return
        await nextTick()

        watch(
            el,
            (value) => {
                if (!value) return

                const observer = new IntersectionObserver(
                    ([entry]) => {
                        isVisible.value = entry.isIntersecting
                    },
                    { threshold: 0.3 }
                )

                observer.observe(value)
            },
            { immediate: true }
        )
    })

    return { isVisible, el }
}

export default useInView
