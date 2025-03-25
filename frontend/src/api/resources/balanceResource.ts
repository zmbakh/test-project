import type {TransactionResource} from "@/api/resources/transactionResource.ts";

export type UserBalanceResource = {
  balance: number
}


export type UserBalanceWithTransactionsResource = {
  balance: UserBalanceResource
  transactions: TransactionResource[]
}
