<template>
  <div class="flex h-screen flex-col bg-stone-50 dark:bg-stone-950">
    <AppHeader />

    <main class="flex flex-1 overflow-hidden">
      <BlockSidebar class="w-72 border-r border-stone-200 dark:border-stone-800" />

      <div class="flex-1 overflow-y-auto scrollbar-thin p-6">
        <div
          v-if="activeOrderedKeys.length === 0"
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

        <BlockDraggable
          v-else
          v-model:items="activeOrderedKeys"
        />
      </div>

      <RightPanel class="w-96 border-l border-stone-200 dark:border-stone-800" />
    </main>
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { PhSquaresFour } from '@phosphor-icons/vue';
import { CANONICAL_BLOCK_ORDER, type BlockKey } from '@/stores/dashboard';

const BlocksIcon = PhSquaresFour;

const dashboard = useDashboardStore();
const { activeBlocks, uiOrder } = storeToRefs(dashboard);

const activeOrderedKeys = computed({
  get: () => uiOrder.value.filter(key => activeBlocks.value.includes(key)),
  set: (value: string[]) => {
    const activeSet = new Set<string>(value);
    const rest = uiOrder.value.filter(key => !activeSet.has(key));
    dashboard.setUiOrder([...value, ...rest] as BlockKey[]);
  },
});

function activateAll() {
  for (const key of CANONICAL_BLOCK_ORDER) {
    if (!activeBlocks.value.includes(key)) {
      dashboard.toggleBlock(key);
    }
  }
}
</script>
