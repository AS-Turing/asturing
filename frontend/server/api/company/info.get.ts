export default defineEventHandler(async (event) => {
  const config = useRuntimeConfig()
  const apiBase = config.public.apiBase || 'http://symfony'

  try {
    const data = await $fetch(`${apiBase}/api/company/info`)
    return data
  } catch (error) {
    console.error('Error fetching company info:', error)
    throw createError({
      statusCode: 500,
      statusMessage: 'Failed to fetch company information'
    })
  }
})
