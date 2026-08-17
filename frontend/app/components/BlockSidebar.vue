<template>
  <aside class="flex flex-col gap-1 overflow-y-auto scrollbar-thin p-3">
    <h2 class="mb-2 px-2 text-xs font-semibold uppercase tracking-wide text-stone-500">
      Bloques de Prompt
    </h2>

    <button
      v-for="block in blocks"
      :key="block.key"
      :aria-pressed="isActive(block.key)"
      @click="toggleBlock(block.key)"
      :class="[
        'flex items-center gap-2 rounded-md px-3 py-2 text-left text-sm transition-colors duration-150',
        'focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-iris-500 focus-visible:ring-offset-1',
        isActive(block.key)
          ? 'bg-iris-50 text-iris-900 dark:bg-iris-900/30 dark:text-iris-100'
          : 'text-stone-700 hover:bg-stone-100 dark:text-stone-300 dark:hover:bg-stone-800',
      ]"
    >
      <component :is="block.icon" class="h-4 w-4" />
      <span>{{ block.label }}</span>
      <UiToggle
        :model-value="isActive(block.key)"
        @update:model-value="toggleBlock(block.key)"
        class="ml-auto"
      />
      <button
        @click.stop="navigateToArea(block.key)"
        class="ml-1 p-1 rounded text-stone-400 hover:text-stone-600 hover:bg-stone-100 dark:hover:bg-stone-800"
        title="Editar en profundidad"
        aria-label="Editar {{ block.label }} en profundidad"
      >
        <ArrowSquareOutIcon class="h-4 w-4" />
      </button>
    </button>

    <div class="mt-4 border-t border-stone-200 pt-3 dark:border-stone-800">
      <UiSelect
        v-model="targetModel"
        label="Motor de IA"
        :options="modelOptions"
        size="sm"
      />
    </div>
  </aside>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';
import {
  PhUserCircle,
  PhLightning,
  PhTShirt,
  PhFilmSlate,
  PhSunDim,
  PhClock,
  PhArrowSquareOut,
} from '@phosphor-icons/vue';

const dashboard = useDashboardStore();
const { activeBlocks, targetModelHint } = storeToRefs(dashboard);
const router = useRouter();

const UserCircleIcon = PhUserCircle;
const LightningIcon = PhLightning;
const ShirtIcon = PhTShirt;
const SceneIcon = PhFilmSlate;
const SunDimIcon = PhSunDim;
const ClockIcon = PhClock;

const blocks = [
  { key: 'character' as const, label: 'Personaje', icon: UserCircleIcon },
  { key: 'outfit' as const, label: 'Outfit', icon: ShirtIcon },
  { key: 'pose' as const, label: 'Pose', icon: LightningIcon },
  { key: 'scene' as const, label: 'Escenario', icon: SceneIcon },
  { key: 'time' as const, label: 'Tiempo', icon: ClockIcon },
  { key: 'lighting' as const, label: 'Iluminación', icon: SunDimIcon },
];

const modelOptions = [
  { value: 'FLUX_1_DEV', label: 'Flux.1 Dev' },
  { value: 'FLUX_1_SCHNELL', label: 'Flux.1 Schnell' },
  { value: 'MIDJOURNEY', label: 'Midjourney v6' },
  { value: 'SDXL', label: 'Stable Diffusion XL' },
];

const targetModel = computed({
  get: () => targetModelHint.value,
  set: (v: string) => dashboard.setTargetModelHint(v),
});

function isActive(key: string) {
  return activeBlocks.value.includes(key as any);
}

function toggleBlock(key: string) {
  dashboard.toggleBlock(key as any);
}

function navigateToArea(key: string) {
  router.push(`/${key}`);
}
</script>
