<script setup lang="ts">
import {ref} from "vue";
import {useUserRepository} from "@/api/repositories/user/userRepository.ts";
import {useUserStore} from "@/stores/user.ts";
import {useRouter} from "vue-router";

const email = ref<string>('');
const password = ref<string>('');

const {signIn} = useUserRepository()
const userStore = useUserStore()
const router = useRouter()

const handleSignIn = async () => {
  const loginData = await signIn(email.value, password.value)

  if (!loginData) {
    return
  }

  await userStore.userLogin(loginData)

  await router.push({ name: 'home' })
};
</script>

<template>
  <main>
    <div class="form-signin w-100 m-auto text-center">
      <form @submit.prevent="handleSignIn">
        <h1 class="h3 mb-3 fw-normal">Вход</h1>

        <div class="form-floating">
          <input v-model="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
          <input v-model="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Пароль</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Войти</button>
      </form>
    </div>
  </main>
</template>

<style scoped>
main {
  height: 100dvh;
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
