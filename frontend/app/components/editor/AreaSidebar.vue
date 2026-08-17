<template>
  <div class="space-y-4 p-3">
    <div class="flex flex-col gap-2">
      <UiButton
        variant="primary"
        size="sm"
        :disabled="store.loading"
        @click="save"
      >
        <SaveIcon class="mr-1.5 h-3.5 w-3.5" />
        Guardar actual
      </UiButton>

      <UiButton
        variant="ghost"
        size="sm"
        :disabled="store.loading"
        @click="fetchSaved"
      >
        <RefreshIcon class="mr-1.5 h-3.5 w-3.5" />
        Recargar lista
      </UiButton>
    </div>

    <div v-if="store.saved.length === 0" class="text-center py-8 text-stone-500">
      <div class="mx-auto h-10 w-10 mb-2 text-stone-300" :class="emptyIcon" />
      <p class="text-sm">No hay {{ blockLabel }} guardados</p>
      <p class="text-xs mt-1">Usa "Guardar actual" para crear el primero</p>
    </div>

    <ul v-else class="space-y-2">
      <li
        v-for="item in store.saved"
        :key="item.id"
        class="flex items-center justify-between rounded-md border border-stone-200 bg-white p-3 dark:border-stone-700 dark:bg-stone-800"
      >
        <div class="flex-1 min-w-0">
          <p class="truncate font-medium text-stone-900 dark:text-stone-100">
            {{ getDisplayName(item) }}
          </p>
          <p class="truncate text-xs text-stone-500 dark:text-stone-400">
            {{ getDisplayMeta(item) }}
          </p>
        </div>
        <div class="flex items-center gap-1.5 ml-3">
          <UiButton
            variant="ghost"
            size="sm"
            @click="load(item)"
            title="Cargar"
          >
            <ArrowDownIcon class="h-3.5 w-3.5" />
          </UiButton>
          <UiButton
            variant="ghost"
            size="sm"
            @click="remove(item)"
            title="Eliminar"
            class="text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20"
          >
            <TrashIcon class="h-3.5 w-3.5" />
          </UiButton>
        </div>
      </li>
    </ul>

    <div v-if="blockKey === 'outfit'" class="mt-4 pt-4 border-t border-stone-200 dark:border-stone-700">
      <UiButton
        variant="primary"
        size="sm"
        class="w-full"
        @click="openGarmentPicker"
      >
        <PackageIcon class="mr-1.5 h-3.5 w-3.5" />
        Abrir catálogo de prendas
      </UiButton>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted, computed, ref } from 'vue';
import {
  PhFloppyDisk,
  PhArrowClockwise,
  PhArrowDown,
  PhTrash,
  PhPackage,
  PhUserCircle,
  PhTShirt,
  PhLightning,
  PhFilmSlate,
  PhSunDim,
  PhClock,
} from '@phosphor-icons/vue';
import { useToast } from '@/composables/useToast';

const SaveIcon = PhFloppyDisk;
const RefreshIcon = PhArrowClockwise;
const ArrowDownIcon = PhArrowDown;
const TrashIcon = PhTrash;
const PackageIcon = PhPackage;

const UserCircleIcon = PhUserCircle;
const ShirtIcon = PhTShirt;
const LightningIcon = PhLightning;
const SceneIcon = PhFilmSlate;
const SunDimIcon = PhSunDim;
const ClockIcon = PhClock;

interface Props {
  blockKey: string;
  store: any;
}

const props = withDefaults(defineProps<Props>(), {
  blockKey: 'character',
  store: () => ({}),
});

const emit = defineEmits<{
  (e: 'garment-picker-open', blockKey: string): void;
}>();

const toast = useToast();
const emptyIcon = ref(UserCircleIcon);

onMounted(() => {
  fetchSaved();
  updateEmptyIcon();
});

function updateEmptyIcon() {
  const icons = {
    character: UserCircleIcon,
    outfit: ShirtIcon,
    pose: LightningIcon,
    scene: SceneIcon,
    lighting: SunDimIcon,
    time: ClockIcon,
  };
  emptyIcon.value = icons[props.blockKey as keyof typeof icons] || UserCircleIcon;
}

const blockLabel = computed(() => {
  const labels: Record<string, string> = {
    character: 'personajes',
    outfit: 'outfits',
    pose: 'poses',
    scene: 'escenarios',
    lighting: 'iluminaciones',
    time: 'tiempos',
  };
  return labels[props.blockKey] ?? props.blockKey;
});

async function fetchSaved() {
  if (typeof props.store.fetchSaved === 'function') {
    await props.store.fetchSaved();
  }
}

function getDisplayName(item: any): string {
  if (item.name) return item.name;
  if (item.title) return item.title;
  return `ID: ${item.id?.slice(0, 8) || '...'}`;
}

function getDisplayMeta(item: any): string {
  if (item.style_category) return item.style_category;
  if (item.category) return item.category;
  if (item.environment_type) return item.environment_type;
  if (item.setup_type) return item.setup_type;
  if (item.season) return `${item.season} / ${item.time_of_day || ''}`;
  return '';
}

async function save() {
  if (typeof props.store.save === 'function') {
    await props.store.save();
  }
}

async function load(item: any) {
  if (typeof props.store.load === 'function' && item.id) {
    await props.store.load(item.id);
  }
}

async function remove(item: any) {
  if (typeof props.store.remove === 'function' && item.id) {
    const confirmed = window.confirm(`¿Eliminar "${getDisplayName(item)}"?`);
    if (confirmed) {
      await props.store.remove(item.id);
    }
  }
}

function openGarmentPicker() {
  emit('garment-picker-open', props.blockKey);
}
</script>