export default defineEventHandler(async (event) => {
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/locations`, {
      timeout: 10000,
      retry: 2
    })
    return data
  } catch (error: any) {
    throw createError({
      statusCode: error.statusCode || 500,
      message: 'Failed to fetch locations'
    })
  }
})
