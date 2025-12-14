export default defineEventHandler(async () => {
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/services`, {
      method: 'GET',
    })
    return data
  } catch (error) {
    console.error('Error fetching services:', error)
    throw createError({
      statusCode: 500,
      message: 'Failed to fetch services'
    })
  }
})
