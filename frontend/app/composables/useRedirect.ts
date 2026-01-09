/**
 * Composable pour gérer les redirections 301 (SEO-friendly)
 * Usage dans middleware ou pages
 */

interface RedirectRule {
  from: string
  to: string
  code?: 301 | 302 | 307 | 308
}

export const useRedirect = () => {
  const redirects: RedirectRule[] = [
    // Exemples de redirections courantes
    { from: '/old-page', to: '/new-page', code: 301 },
    { from: '/index-old', to: '/', code: 301 },
    // Ajouter tes redirections ici
  ]

  /**
   * Vérifie si l'URL courante doit être redirigée
   */
  const checkRedirect = (path: string): RedirectRule | null => {
    return redirects.find(r => r.from === path) || null
  }

  /**
   * Effectue la redirection si nécessaire
   */
  const applyRedirect = (path: string) => {
    const redirect = checkRedirect(path)
    if (redirect) {
      return navigateTo(redirect.to, { redirectCode: redirect.code || 301 })
    }
    return null
  }

  return {
    redirects,
    checkRedirect,
    applyRedirect
  }
}
