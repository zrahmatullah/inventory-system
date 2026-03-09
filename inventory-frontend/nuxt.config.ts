export default defineNuxtConfig({

  srcDir: "app",

  devtools: { enabled: true },

  modules: [
    '@nuxt/ui'
  ],

  css: [
    "~/assets/toast.css",
    "~/assets/global.css"
  ],

  app: {
    head: {
      titleTemplate: "Inventory System - %s",
      link: [
        { rel: "icon", type: "image/x-icon", href: "/favicon.ico" }
      ]
    }
  }

})