<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import {onBeforeMount} from "vue";
import {useUserStore} from "@/stores/user.ts";
import {useUserRepository} from "@/api/repositories/user/userRepository.ts";

const userStore = useUserStore()
const { profile } = useUserRepository()

onBeforeMount(async () => {
  if (userStore.token && !userStore.user) {
    const userData = await profile();
    if (userData) {
      await userStore.storeUser(userData)
    }
  }
})
</script>

<template>
  <RouterView />
  <Notifications />
</template>
