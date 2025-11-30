export default defineEventHandler(async (event) => {
  const config = useRuntimeConfig()
  const slug = getRouterParam(event, 'slug')
  
  if (!slug) {
    throw createError({
      statusCode: 400,
      message: 'Slug is required'
    })
  }
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/blog/posts/${slug}`)
    return data
  } catch (error: any) {
    if (error.statusCode === 404) {
      throw createError({
        statusCode: 404,
        message: 'Blog post not found'
      })
    }
    throw createError({
      statusCode: 500,
      message: 'Failed to fetch blog post'
    })
  }
})
