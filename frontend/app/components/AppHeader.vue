<template>
  <header class="flex h-14 shrink-0 items-center justify-between border-b border-stone-200 bg-white dark:border-stone-800 dark:bg-stone-950 px-4">
    <div class="flex items-center gap-2">
      <span class="flex h-7 w-7 items-center justify-center rounded-md bg-iris-600 text-xs font-bold text-white shadow-sm">
        HI
      </span>
      <h1 class="text-sm font-semibold text-stone-900 dark:text-stone-100">
        HumanImagesPrompts
      </h1>
    </div>

    <div class="flex items-center gap-2">
      <UiButton
        variant="ghost"
        size="sm"
        @click="toggleTheme"
        :aria-label="isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
        :title="isDark ? 'Cambiar a modo claro' : 'Cambiar a modo oscuro'"
        class="relative"
      >
        <transition
          enter-active-class="transition ease-out duration-200"
          enter-from-class="opacity-0 scale-75"
          enter-to-class="opacity-100 scale-100"
          leave-active-class="transition ease-in duration-150"
          leave-from-class="opacity-100 scale-100"
          leave-to-class="opacity-0 scale-75"
        >
          <component
            :is="isDark ? SunIcon : MoonIcon"
            :key="isDark ? 'sun' : 'moon'"
            class="h-4 w-4"
          />
        </transition>
      </UiButton>

      <div class="flex items-center gap-2 rounded-full border border-stone-200 bg-stone-50 py-1 pl-1 pr-3 dark:border-stone-800 dark:bg-stone-900">
        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-iris-100 text-[10px] font-bold text-iris-700 dark:bg-iris-900 dark:text-iris-300">
          {{ initial }}
        </span>
        <span class="text-xs text-stone-600 dark:text-stone-400">
          {{ auth.user?.email || '...' }}
        </span>
      </div>

      <UiButton
        variant="ghost"
        size="sm"
        @click="auth.logout"
      >
        Salir
      </UiButton>
    </div>
  </header>
</template>

<script setup lang="ts">
import { PhSun, PhMoon } from '@phosphor-icons/vue';

const auth = useAuthStore();
const colorMode = useColorMode();

const SunIcon = PhSun;
const MoonIcon = PhMoon;

const isDark = computed(() => colorMode.value === 'dark');

const initial = computed(() => {
  const email = auth.user?.email || '';
  return email ? email.charAt(0).toUpperCase() : '?';
});

function toggleTheme() {
  colorMode.preference = isDark.value ? 'light' : 'dark';
}
</script>