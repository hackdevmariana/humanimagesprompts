// https://nuxt.com/docs/api/configuration/nuxt-config
import tailwindcss from '@tailwindcss/vite';

export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: false },

  css: ['~/assets/css/tailwind.css'],

  modules: ['@pinia/nuxt', '@nuxtjs/color-mode'],

  vite: {
    plugins: [tailwindcss()],
  },

  colorMode: {
    classSuffix: '',
  },

  routeRules: {
    '/api/**': { proxy: { to: 'http://127.0.0.1:8000/api/**' } },
  },

  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || 'http://localhost:8000',
    },
  },

  app: {
    head: {
      title: 'HumanImagesPrompts',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      ],
      link: [
        { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
        { rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: '' },
        {
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        },
      ],
    },
  },

  typescript: {
    strict: true,
  },
})