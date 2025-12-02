export default cachedEventHandler(async (event) => {
  const config = useRuntimeConfig()
  const slug = getRouterParam(event, 'slug')
  
  if (!slug) {
    throw createError({
      statusCode: 400,
      statusMessage: 'Slug is required'
    })
  }

  try {
    const data = await $fetch(`${config.public.apiBase}/api/projects/${slug}`)
    return data
  } catch (error: any) {
    // Si 404 depuis Symfony, on propage
    if (error?.statusCode === 404) {
      throw createError({
        statusCode: 404,
        statusMessage: 'Project not found'
      })
    }
    
    throw createError({
      statusCode: 500,
      statusMessage: 'Failed to fetch project'
    })
  }
}, {
  maxAge: process.env.NODE_ENV === 'production' ? 60 * 10 : 0, // Cache seulement en prod
  name: 'project-detail',
  getKey: (event) => `project-${getRouterParam(event, 'slug')}`
})
