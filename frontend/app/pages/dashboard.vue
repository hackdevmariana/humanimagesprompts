<template>
  <div class="flex h-screen flex-col bg-stone-50 dark:bg-stone-950">
    <AppHeader />

    <main class="flex flex-1 overflow-hidden">
      <BlockSidebar class="w-72 border-r border-stone-200 dark:border-stone-800" />

      <div class="flex-1 overflow-y-auto scrollbar-thin p-6">
        <div
          v-if="activeKeys.length === 0"
          class="flex h-full flex-col items-center justify-center gap-3 py-12 text-center"
        >
          <div class="flex h-14 w-14 items-center justify-center rounded-full bg-stone-100 dark:bg-stone-900">
            <BlocksIcon class="h-7 w-7 text-stone-400" />
          </div>
          <p class="text-sm text-stone-500">
            Ningún bloque activo. Actívalos desde la barra lateral.
          </p>
          <UiButton
            variant="ghost"
            size="sm"
            @click="activateAll"
          >
            Activar todos
          </UiButton>
        </div>

        <div
          v-else
          class="space-y-4"
        >
          <transition-group
            name="editor-fade"
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            move-class="transition-all duration-200"
          >
            <BlockEditor
              v-for="key in activeKeys"
              :key="key"
              :block-key="key"
            />
          </transition-group>
        </div>
      </div>

      <RightPanel class="w-96 border-l border-stone-200 dark:border-stone-800" />
    </main>
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { PhSquaresFour } from '@phosphor-icons/vue';

const BlocksIcon = PhSquaresFour;

const dashboard = useDashboardStore();
const { activeBlocks } = storeToRefs(dashboard);

const activeKeys = computed(() => activeBlocks.value);

function activateAll() {
  for (const key of ['character', 'pose', 'outfit', 'scene', 'lighting']) {
    if (!activeBlocks.value.includes(key as any)) {
      dashboard.toggleBlock(key as any);
    }
  }
}
</script>
