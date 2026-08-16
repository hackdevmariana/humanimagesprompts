<template>
  <div class="flex min-h-screen items-center justify-center bg-stone-100 dark:bg-stone-950">
    <div class="w-full max-w-md space-y-6 rounded-lg bg-white dark:bg-stone-900 p-8 shadow-lg dark:border dark:border-stone-800">
      <div class="text-center">
        <h1 class="text-2xl font-bold text-stone-900 dark:text-stone-100">
          HumanImagesPrompts
        </h1>
        <p class="mt-1 text-sm text-stone-500">
          Inicia sesión para continuar
        </p>
      </div>

      <form @submit.prevent="onSubmit" class="space-y-4">
        <UiInput
          v-model="form.email"
          type="email"
          label="Email"
          placeholder="admin@example.com"
          required
        />
        <UiInput
          v-model="form.password"
          type="password"
          label="Password"
          placeholder="••••••••"
          required
        />

        <UiButton
          type="submit"
          variant="primary"
          :disabled="loading"
          class="w-full"
        >
          <span
            v-if="loading"
            class="mr-2 h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"
          ></span>
          Entrar
        </UiButton>

        <p v-if="error" class="text-center text-sm text-red-600 dark:text-red-400">
          {{ error }}
        </p>
      </form>

      <p class="text-center text-xs text-stone-400">
        Admin: admin@example.com / password
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const toast = useToast();
const auth = useAuthStore();

const form = reactive({
  email: 'admin@example.com',
  password: '',
});

const loading = ref(false);
const error = ref('');

async function onSubmit() {
  loading.value = true;
  error.value = '';

  try {
    await auth.login(form.email, form.password);
    toast.success('Sesión iniciada');
    router.replace('/dashboard');
  } catch (e: any) {
    error.value = e?.data?.error || 'Credenciales inválidas';
  } finally {
    loading.value = false;
  }
}
</script>
