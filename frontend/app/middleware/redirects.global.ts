/**
 * Middleware global pour gérer les redirections automatiques
 * Vérifie chaque route et redirige si nécessaire
 */
export default defineNuxtRouteMiddleware((to) => {
  const { applyRedirect } = useRedirect()
  
  // Vérifier et appliquer redirection
  const redirect = applyRedirect(to.path)
  if (redirect) {
    return redirect
  }
  
  // Normalisation des URLs (trailing slash optionnel)
  // Enlève le trailing slash sauf pour la home
  if (to.path !== '/' && to.path.endsWith('/')) {
    const pathWithoutSlash = to.path.slice(0, -1)
    return navigateTo(pathWithoutSlash, { redirectCode: 301 })
  }
})
