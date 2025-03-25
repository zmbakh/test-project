<script setup lang="ts">
import {onMounted, ref} from "vue";
import { debounce } from 'lodash';
import {useTransactionRepository} from "@/api/repositories/transaction/transactionRepository.ts";
import type {TransactionResource} from "@/api/resources/TransactionResource.ts";

const { list } = useTransactionRepository()

const transactions = ref<TransactionResource[]>([])
const description = ref<string>('')
const sortOrder = ref<string>('desc')

const search = async() => {
  transactions.value = await list(sortOrder.value, description.value)
}

const toggleSort = () => {
  sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc'
  search()
}

const onInput = debounce(() => {
  search()
}, 500)

onMounted(() => {
  search()
})
</script>

<template>
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-baseline">
    <h3 class="mb-4">Список транзакции</h3>
    <RouterLink :to="{name: 'home'}" class="btn btn-primary">На главную</RouterLink>
  </div>
  <div class="d-flex justify-content-end">
    <input v-model="description" @input="onInput" class="form-control search-input" type="text" placeholder="Поиск по описанию">
  </div>
  <table class="table table-striped table-hover">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Тип</th>
      <th scope="col">Сумма</th>
      <th scope="col">Описание</th>
      <th scope="col">Баланс</th>
      <th scope="col" class="sortable" @click="toggleSort">
        Дата
        <i :class="sortOrder === 'asc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
      </th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="transaction in transactions" :key="transaction.id">
      <th scope="row">{{ transaction.id }}</th>
      <td>{{ transaction.type === 'credit' ? 'Пополнение' : 'Списание' }}</td>
      <td :class="transaction.type === 'credit' ? 'text-success' : 'text-danger'">${{ transaction.amount }}</td>
      <td>{{ transaction.description }}</td>
      <td>${{ transaction.balance_after }}</td>
      <td>{{ transaction.created_at }}</td>
    </tr>
    </tbody>
  </table>
</div>
</template>

<style scoped>
.search-input {
  width: 300px;
}
</style>
