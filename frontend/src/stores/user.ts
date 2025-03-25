import { ref } from 'vue'
import { defineStore } from 'pinia'
import type {UserLoggedInResource, UserResource} from "@/api/resources/userResource.ts";

export const useUserStore = defineStore('user', () => {
  const token = ref<string | null>(localStorage.getItem('user_token') ?? null)
  const user = ref<UserResource | null>(null)

  const userLogin = (userLoginResource: UserLoggedInResource) => {
    console.log(userLoginResource);
    token.value = userLoginResource.token
    user.value = userLoginResource.user

    localStorage.setItem('user_token', userLoginResource.token)
  }

  const userLogout = () => {
    token.value = null
    user.value = null

    localStorage.removeItem('user_token')
  }

  const storeUser = (userResource: UserResource) => {
    user.value = userResource
  }

  return { userLogin, userLogout, storeUser, token, user }
})
