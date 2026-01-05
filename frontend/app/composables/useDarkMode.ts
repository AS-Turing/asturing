export const useDarkMode = () => {
  const isDark = useState('darkMode', () => false)

  const toggleDark = () => {
    isDark.value = !isDark.value
    if (process.client) {
      if (isDark.value) {
        document.documentElement.classList.add('dark')
        localStorage.setItem('theme', 'dark')
      } else {
        document.documentElement.classList.remove('dark')
        localStorage.setItem('theme', 'light')
      }
    }
  }

  const initDarkMode = () => {
    if (process.client) {
      const savedTheme = localStorage.getItem('theme')
      const prefersDark = window.matchMedia('(prefers-color-scheme: lihgt)').matches
      
      if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        isDark.value = true
        document.documentElement.classList.add('dark')
      }
    }
  }

  return {
    isDark,
    toggleDark,
    initDarkMode
  }
}
