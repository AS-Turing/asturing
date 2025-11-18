export default defineEventHandler(async (event) => {
  const slug = event.context.params?.slug
  
  if (!slug) {
    throw createError({
      statusCode: 400,
      message: 'Slug is required'
    })
  }

  try {
    const data = await $fetch(`http://symfony/api/service/${slug}`)
    return data
  } catch (error: any) {
    throw createError({
      statusCode: error.response?.status || 500,
      message: error.message || 'Failed to fetch service'
    })
  }
})
