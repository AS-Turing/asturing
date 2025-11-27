export default defineEventHandler(async (event) => {
  const body = await readBody(event)

  try {
    const response = await $fetch('http://symfony/api/mail/contact', {
      method: 'POST',
      body: body,
    })

    return response
  } catch (error: any) {
    throw createError({
      statusCode: error.response?.status || 500,
      message: error.message || 'Erreur lors de l\'envoi du message',
    })
  }
})
