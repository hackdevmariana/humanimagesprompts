<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
  <UiToastContainer />
</template>

<script setup lang="ts">
const auth = useAuthStore();

if (!auth.initialized) {
  await auth.fetchSession();
}
</script>
