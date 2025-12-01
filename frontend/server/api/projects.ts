export default cachedEventHandler(async (event) => {
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
}, {
  maxAge: 60 * 5, // Cache 5 minutes
  name: 'projects-list',
  getKey: () => 'all-projects'
})
