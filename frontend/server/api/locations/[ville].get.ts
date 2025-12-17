export default defineEventHandler(async (event) => {
  const ville = event.context.params?.ville
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/locations/${ville}`, {
      method: 'GET',
      timeout: 10000,
      retry: 2
    })
    return data
  } catch (error: any) {
    console.error(`Error fetching location ${ville}:`, error)
    throw createError({
      statusCode: error.statusCode || 404,
      message: 'Location not found'
    })
  }
})
