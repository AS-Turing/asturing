module.exports = {
  content: [
    './assets/css/app.css',
    './components/**/*.{vue,js,ts}',
    './layouts/**/*.vue',
    './pages/**/*.vue',
    './app.vue',
    './assets/**/*.{css,vue,js,ts}',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1C2B49',
        secondary: '#F68A17',
        accent: '#6C63FF',
        neutral: {
          100: '#F9FAFB',
          700: '#1F2937',
          500: '#6B7280'
        },
        dark: '#0F172A'
      },
      fontFamily: {
        sans: ['Manrope', 'sans-serif'],
        heading: ['Poppins', 'sans-serif']
      },
      borderRadius: {
        xl: '1rem',
        '2xl': '1.5rem',
      },
    }
  }

}
