export const useApi = () => {
  const fetchServices = async () => {
    try {
      const response = await $fetch('/api/services')
      return response || []
    } catch (error) {
      console.error('Error fetching services:', error)
      return []
    }
  }

  const fetchProjects = async () => {
    try {
      const response = await $fetch('/api/projects')
      return response || []
    } catch (error) {
      console.error('Error fetching projects:', error)
      return []
    }
  }

  const fetchBlogPosts = async () => {
    try {
      const response = await $fetch('/api/blog/posts')
      return response || []
    } catch (error) {
      console.error('Error fetching blog posts:', error)
      return []
    }
  }

  const fetchBlogPost = async (slug: string) => {
    try {
      const response = await $fetch(`/api/blog/posts/${slug}`)
      return response
    } catch (error) {
      console.error('Error fetching blog post:', error)
      return null
    }
  }

  const sendContactMessage = async (formData: {
    name: string
    email: string
    subject: string
    message: string
  }) => {
    try {
      const response = await $fetch('/api/contact', {
        method: 'POST',
        body: formData
      })
      return response
    } catch (error) {
      console.error('Error sending contact message:', error)
      throw error
    }
  }

  return {
    fetchServices,
    fetchProjects,
    fetchBlogPosts,
    fetchBlogPost,
    sendContactMessage
  }
}
