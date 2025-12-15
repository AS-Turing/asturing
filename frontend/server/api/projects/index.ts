export default defineEventHandler(async (event) => {
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.public.apiBase}/api/projects`)
    return data
  } catch (error) {
    throw createError({
      statusCode: 500,
      statusMessage: 'Failed to fetch projects'
    })
  }
})

// DÉSACTIVÉ TEMPORAIREMENT : cachedEventHandler causait des problèmes de cache persistant
