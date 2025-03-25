import type { AxiosError, AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios'
import axios from 'axios'
import { notify } from '@kyvg/vue3-notification'
import { useUserStore } from '@/stores/user.ts'
import { useRouter } from 'vue-router'

const apiClient: AxiosInstance = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL, // Load from env file
  headers: {
    'Content-Type': 'application/json',
  },
})

const formatErrorMessages = (errorObj: string | object | null) => {
  if (typeof errorObj !== 'object' || errorObj === null) {
    return String(errorObj)
  }

  return Object.values(errorObj)
    .flat()
    .map((msg) => `• ${msg}`)
    .join('\n')
}

export function useHttpClient() {
  const userStore = useUserStore()
  const router = useRouter()

  apiClient.interceptors.response.use(
    (response) => response,
    (error: AxiosError<{ message?: string | null; errors?: object | string | null }>) => {
      if (error.status === 401) {
        userStore.userLogout()
        router.push({ name: 'sign-in' })
      }

      notify({
        title: error.response?.data?.message || 'Error',
        text: error.response?.data?.errors
          ? formatErrorMessages(error.response.data.errors)
          : undefined,
        type: 'error',
      })
    },
  )

  const request = async <T>(
    method: 'get' | 'post' | 'put' | 'delete',
    url: string,
    data: object | null = null,
    config: AxiosRequestConfig = {},
  ): Promise<T | null> => {
    if (userStore.token) {
      config.headers = {
        ...config.headers,
        Authorization: `Bearer ${userStore.token}`,
      }
    }

    const response: AxiosResponse<{ data: T }> = await apiClient({ method, url, data, ...config })
    return response.data?.data
  }

  return {
    get: <T>(url: string, config?: AxiosRequestConfig) => request<T>('get', url, null, config),
    post: <T>(url: string, data: object | null, config?: AxiosRequestConfig) =>
      request<T>('post', url, data, config),
    put: <T>(url: string, data: object | null, config?: AxiosRequestConfig) =>
      request<T>('put', url, data, config),
    del: <T>(url: string, config?: AxiosRequestConfig) => request<T>('delete', url, null, config),
  }
}
