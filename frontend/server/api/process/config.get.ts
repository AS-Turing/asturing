export default defineEventHandler(async () => {
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/process/config`)
    return data
  } catch (error) {
    console.error('Error fetching process config:', error)
    throw createError({
      statusCode: 500,
      message: 'Failed to fetch process config'
    })
  }
})
