<script setup lang="ts">
import {ref} from "vue";
import { debounce } from 'lodash';

const description = ref<string>('')
const sortOrder = ref<string>('asc')

const search = () => {
  console.log(description.value, sortOrder.value)
}

const toggleSort = () => {
  sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc'
  search()
}

const onInput = debounce(() => {
  search()
}, 500)
</script>

<template>
<div class="container py-5">
  <h3 class="mb-4">Список транзакции</h3>
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
    <tr>
      <th scope="row">1</th>
      <td>Пополнение</td>
      <td>+ $20.05</td>
      <td>Описание данной операции</td>
      <td>$120.05</td>
      <td>2025-03-25 13:01:43</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Списание</td>
      <td>- $100.00</td>
      <td>Описание данной операции</td>
      <td>$100.00</td>
      <td>2025-03-25 13:01:43</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Списание</td>
      <td>- $100.00</td>
      <td>Описание данной операции</td>
      <td>$200.00</td>
      <td>2025-03-25 13:01:43</td>
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
