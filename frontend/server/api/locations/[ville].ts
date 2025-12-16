export default defineEventHandler(async (event) => {
  const config = useRuntimeConfig()
  const ville = getRouterParam(event, 'ville')
  
  if (!ville) {
    throw createError({
      statusCode: 400,
      message: 'Ville is required'
    })
  }
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/locations/${ville}`, {
      timeout: 10000,
      retry: 2
    })
    return data
  } catch (error: any) {
    if (error.statusCode === 404) {
      throw createError({
        statusCode: 404,
        message: 'Location not found'
      })
    }
    throw createError({
      statusCode: 500,
      message: 'Failed to fetch location'
    })
  }
})
