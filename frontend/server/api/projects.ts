export default defineEventHandler(async (event) => {
  const config = useRuntimeConfig()
  
  try {
    const data = await $fetch(`${config.apiBase}/api/projects`)
    return data
  } catch (error) {
    throw createError({
      statusCode: 500,
      statusMessage: 'Failed to fetch projects'
    })
  }
})
