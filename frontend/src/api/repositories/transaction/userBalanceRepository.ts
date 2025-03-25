import type {UserBalanceWithTransactionsResource} from "@/api/resources/balanceResource.ts";
import {useHttpClient} from "@/api/client/useHttpClient.ts";

export function useUserBalanceRepository () {
  const { get } = useHttpClient()
  const getBalance = async (): Promise<UserBalanceWithTransactionsResource[]> => {
    return get<UserBalanceWithTransactionsResource[]>(`balance`)
  }
  return {
    getBalance
  }
}
