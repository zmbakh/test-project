import {useHttpClient} from "@/api/client/useHttpClient.ts";
import type {TransactionResource} from "@/api/resources/TransactionResource.ts";

export function useTransactionRepository() {
  const { get } = useHttpClient()

  const list = async (order?: 'asc' | 'desc', description?: string): Promise<TransactionResource[]> => {
    const params = new URLSearchParams();

    if (order) {
      params.append("order", order);
    }

    if (description) {
      params.append("description", description);
    }

    return get<TransactionResource[]>(`transactions?${params.toString()}`);
  };


  return {
    list,
  }
}
