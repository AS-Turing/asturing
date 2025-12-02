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
  maxAge: process.env.NODE_ENV === 'production' ? 60 * 5 : 0, // Cache seulement en prod
  name: 'projects-list',
  getKey: () => 'all-projects'
})
