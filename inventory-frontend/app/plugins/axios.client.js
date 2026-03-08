import axios from "axios"

export default defineNuxtPlugin(() => {

  const api = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
      "Content-Type": "application/json"
    }
  })

  api.interceptors.request.use((config) => {

    const token = useCookie("token")

    if (token.value) {
      config.headers.Authorization = `Bearer ${token.value}`
    }

    return config
  })

  api.interceptors.response.use(
    (response) => response,
    (error) => {

      if (error.response?.status === 401) {

        const token = useCookie("token")
        token.value = null

        navigateTo("/login")

      }

      return Promise.reject(error)
    }
  )

  return {
    provide: {
      api
    }
  }

})