export default defineEventHandler(async () => {
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/contact/config`)
    return data
  } catch (error) {
    console.error('Error fetching contact config:', error)
    throw createError({
      statusCode: 500,
      message: 'Failed to fetch contact config'
    })
  }
})
