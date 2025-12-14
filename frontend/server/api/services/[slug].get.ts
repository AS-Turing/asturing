export default defineEventHandler(async (event) => {
  const slug = event.context.params?.slug
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/services/${slug}`, {
      method: 'GET',
    })
    return data
  } catch (error) {
    console.error(`Error fetching service ${slug}:`, error)
    throw createError({
      statusCode: 404,
      message: 'Service not found'
    })
  }
})
