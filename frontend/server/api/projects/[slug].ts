export default defineEventHandler(async (event) => {
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
})

// DÉSACTIVÉ TEMPORAIREMENT : cachedEventHandler causait des problèmes de cache persistant
// Réactiver plus tard avec une stratégie d'invalidation sur webhook depuis Symfony
