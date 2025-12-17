export default defineEventHandler(async (event) => {
  const ville = event.context.params?.ville
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/locations/${ville}`, {
      method: 'GET',
    })
    return data
  } catch (error) {
    console.error(`Error fetching location ${ville}:`, error)
    throw createError({
      statusCode: 404,
      message: 'Location not found'
    })
  }
})
