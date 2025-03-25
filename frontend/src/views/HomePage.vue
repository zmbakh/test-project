<script setup lang="ts">
import {useUserStore} from "@/stores/user.ts";
import {onMounted, onUnmounted, ref} from "vue";
import {useUserBalanceRepository} from "@/api/repositories/transaction/userBalanceRepository.ts";
import type {
  UserBalanceWithTransactionsResource
} from "@/api/resources/balanceResource.ts";

const userStore = useUserStore()
const { getBalance } = useUserBalanceRepository()
const userBalance = ref<UserBalanceWithTransactionsResource | null>(null)
let intervalId = null;

const fetchBalance = async () => {
  userBalance.value = await getBalance()
}

onMounted(() => {
  fetchBalance()
  intervalId = setInterval(fetchBalance, 5000);
})

onUnmounted(() => {
  if (intervalId) {
    clearInterval(intervalId);
  }
});
</script>

<template>
  <main class="w-auto">
    <h1 class="h3 mb-3 fw-normal">Добро пожаловать, {{ userStore.user?.name }}!</h1>
    <p class="mb-4">Ваш текущий баланс: ${{ userBalance?.balance.balance }}</p>
    <div class="list-group">
      <div v-for="transaction in userBalance?.transactions" :key="transaction.id" class="list-group-item list-group-item-action py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
          <div>
            <h6 class="mb-0">{{ transaction.type === 'credit' ? 'Пополнение баланса' : 'Списание с баланса'}}</h6>
            <p class="mb-2 opacity-75">{{ transaction.created_at }}</p>
            <p class="mb-0">{{ transaction.description }}</p>
          </div>
          <small class="opacity-75 text-nowrap" :class=" transaction.type === 'credit' ? 'text-success' : 'text-danger'">
            {{  transaction.type === 'credit' ? '+' : '-' }}${{ transaction.amount }}
          </small>
        </div>
      </div>
    </div>
    <div class="text-end">
      <router-link :to="{name: 'transactions'}" class="btn btn-primary mt-3">
        Подробнее
      </router-link>
    </div>
  </main>
</template>

<style scoped>
main {
  max-width: 460px;
  margin: 4rem auto;
}
</style>
