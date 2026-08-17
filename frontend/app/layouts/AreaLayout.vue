<template>
  <div class="flex h-screen flex-col bg-stone-50 dark:bg-stone-950">
    <AppHeader />

    <main class="flex flex-1 overflow-hidden">
      <aside
        v-if="showSidebar"
        :class="[
          'border-r border-stone-200 dark:border-stone-800 transition-all duration-200',
          isMobile ? (sidebarOpen ? 'fixed inset-y-0 left-0 z-40 w-72' : 'hidden') : 'w-72 shrink-0',
        ]"
      >
        <div class="flex h-full flex-col">
          <div class="p-3 border-b border-stone-200 dark:border-stone-800">
            <h2 class="text-xs font-semibold uppercase tracking-wide text-stone-500">
              {{ blockLabel }}
            </h2>
          </div>
          <div class="flex-1 overflow-y-auto">
            <slot name="sidebar" />
          </div>
        </div>
      </aside>

      <div
        v-if="isMobile && sidebarOpen"
        class="fixed inset-0 z-30 bg-black/50"
        @click="sidebarOpen = false"
        aria-hidden="true"
      />

      <div class="flex-1 flex flex-col min-w-0">
        <header class="flex h-14 shrink-0 items-center justify-between border-b border-stone-200 bg-white dark:border-stone-800 dark:bg-stone-950 px-4">
          <div class="flex items-center gap-3">
            <button
              v-if="isMobile"
              @click="sidebarOpen = true"
              class="p-1.5 rounded-md text-stone-500 hover:bg-stone-100 dark:text-stone-400 dark:hover:bg-stone-800"
              aria-label="Abrir panel lateral"
            >
              <MenuIcon class="h-5 w-5" />
            </button>
            <NuxtLink
              to="/dashboard"
              class="flex items-center gap-2 text-sm font-medium text-stone-600 hover:text-stone-900 dark:text-stone-400 dark:hover:text-stone-100"
              title="Volver al Composer"
            >
              <ArrowLeftIcon class="h-4 w-4" />
              Composer
            </NuxtLink>
            <div class="hidden md:flex items-center gap-2">
              <component :is="icon" class="h-5 w-5 text-iris-600" />
              <span class="text-base font-semibold text-stone-900 dark:text-stone-100">
                {{ title }}
              </span>
            </div>
          </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6">
          <slot name="editor" />
        </div>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import {
  PhHamburger,
  PhArrowLeft,
  PhArrowSquareOut,
} from '@phosphor-icons/vue';

const MenuIcon = PhHamburger;
const ArrowLeftIcon = PhArrowLeft;
const ExpandIcon = PhArrowSquareOut;

interface Props {
  title: string;
  icon: string;
  blockKey: string;
}

const props = withDefaults(defineProps<Props>(), {
  title: '',
  icon: 'PhUserCircle',
  blockKey: 'character',
});

const router = useRouter();
const isMobile = ref(false);
const sidebarOpen = ref(false);

function checkMobile() {
  isMobile.value = window.innerWidth < 768;
  if (!isMobile.value) {
    sidebarOpen.value = false;
  }
}

onMounted(() => {
  checkMobile();
  window.addEventListener('resize', checkMobile);
  document.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
  window.removeEventListener('resize', checkMobile);
  document.removeEventListener('keydown', handleKeydown);
});

function handleKeydown(e: KeyboardEvent) {
  if (e.key === 'Escape') {
    router.push('/dashboard');
  }
}

const blockLabel = computed(() => {
  const labels: Record<string, string> = {
    character: 'Personaje',
    outfit: 'Outfit',
    pose: 'Pose',
    scene: 'Escenario',
    lighting: 'Iluminación',
    time: 'Tiempo',
  };
  return labels[props.blockKey] ?? props.blockKey;
});

const showSidebar = computed(() => !isMobile.value || sidebarOpen.value);
</script>