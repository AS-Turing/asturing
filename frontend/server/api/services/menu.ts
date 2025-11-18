export default defineEventHandler(async () => {
  try {
    const data = await $fetch('http://symfony/api/services/menu')
    return data
  } catch (error: any) {
    throw createError({
      statusCode: error.response?.status || 500,
      message: error.message || 'Failed to fetch services menu'
    })
  }
})
