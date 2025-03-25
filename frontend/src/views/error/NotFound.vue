<template>
  <div class="d-flex flex-column align-items-center justify-content-center vh-100">
    <h1 class="display-1 fw-bold">404</h1>
    <p class="lead">Упс! Страница не найдена.</p>
    <router-link :to="{ name: 'home' }" class="btn btn-primary mt-4">
      На главную
    </router-link>
  </div>
</template>
