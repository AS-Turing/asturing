export default defineEventHandler(async () => {
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/clients`)
    return data
  } catch (error) {
    console.error('Error fetching clients:', error)
    throw createError({
      statusCode: 500,
      message: 'Failed to fetch clients'
    })
  }
})
