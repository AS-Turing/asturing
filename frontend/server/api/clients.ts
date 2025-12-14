export default cachedEventHandler(async () => {
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
}, {
  maxAge: 60 * 5, // Cache 5 minutes
  name: 'clients-list',
  getKey: () => 'all-clients'
})
