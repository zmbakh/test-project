export type UserResource = {
  id: number
  email: string
  name: string
  created_at: string
}

export type UserLoggedInResource = {
  token: string
  user: UserResource
}
