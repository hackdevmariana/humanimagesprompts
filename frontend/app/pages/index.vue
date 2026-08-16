<template>
  <div />
</template>

<script setup lang="ts">
const auth = useAuthStore();

if (!auth.initialized) {
  await auth.fetchSession();
}

if (auth.isAuthenticated) {
  navigateTo('/dashboard');
} else {
  navigateTo('/login');
}
</script>
