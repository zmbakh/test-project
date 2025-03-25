<script setup lang="ts">

</script>

<template>
  <main class="w-auto">
    <h1 class="h3 mb-3 fw-normal">Добро пожаловать, Имя!</h1>
    <p class="mb-4">Ваш текущий баланс: $500.25</p>
    <div class="list-group">
      <div class="list-group-item list-group-item-action py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
          <div>
            <h6 class="mb-0">Пополнение баланса</h6>
            <p class="mb-2 opacity-75">2025-03-17 13:18:55</p>
            <p class="mb-0">Описание операции</p>
          </div>
          <small class="opacity-50 text-nowrap">$500.00</small>
        </div>
      </div>
      <div class="list-group-item list-group-item-action py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
          <div>
            <h6 class="mb-0">Списание с баланса</h6>
            <p class="mb-2 opacity-75">2025-03-17 13:18:55</p>
            <p class="mb-0">Описание операции</p>
          </div>
          <small class="opacity-50 text-nowrap">$100.45</small>
        </div>
      </div>
      <div class="list-group-item list-group-item-action py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
          <div>
            <h6 class="mb-0">Пополнение баланса</h6>
            <p class="mb-2 opacity-75">2025-03-17 13:18:55</p>
            <p class="mb-0">Описание операции</p>
          </div>
          <small class="opacity-50 text-nowrap">$500.00</small>
        </div>
      </div>
      <div class="list-group-item list-group-item-action py-3">
        <div class="d-flex gap-2 w-100 justify-content-between">
          <div>
            <h6 class="mb-0">Пополнение баланса</h6>
            <p class="mb-2 opacity-75">2025-03-17 13:18:55</p>
            <p class="mb-0">Описание операции</p>
          </div>
          <small class="opacity-50 text-nowrap">$500.00</small>
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
