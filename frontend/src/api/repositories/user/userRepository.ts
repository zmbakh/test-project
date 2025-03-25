import type {UserLoggedInResource, UserResource} from "@/api/resources/userResource.ts";
import {useHttpClient} from "@/api/client/useHttpClient.ts";

export function useUserRepository() {
  const { get, post } = useHttpClient()

  const signIn = async (email: string, password: string): Promise<UserResource | null> => {
    return post<UserLoggedInResource>('auth/sign-in', { email, password })
  }

  const profile = async (): Promise<UserResource> => {
    return get<UserResource>('user')
  }

  return {
    signIn,
    profile,
  }
}
