<template>
  <Teleport to="body">
    <div v-if="isOpen" class="fixed inset-0 z-50 overflow-y-auto" @click.self="close">
      <div class="fixed inset-0 bg-black/50 transition-opacity" aria-hidden="true" />
      <div class="relative mx-auto mt-10 max-w-4xl w-full px-4">
        <div class="bg-white dark:bg-stone-900 rounded-xl shadow-xl">
          <!-- Header -->
          <header class="flex items-center justify-between p-4 border-b border-stone-200 dark:border-stone-700">
            <h2 class="text-lg font-semibold text-stone-900 dark:text-stone-100">
              Catálogo de prendas — {{ activeSlotLabel }}
            </h2>
            <div class="flex items-center gap-2">
              <UiButton variant="ghost" size="sm" @click="close">
                <XIcon class="h-5 w-5" />
              </UiButton>
            </div>
          </header>

          <!-- Filters -->
          <div class="p-4 border-b border-stone-200 dark:border-stone-700 bg-stone-50 dark:bg-stone-800/50">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-3">
              <UiInput
                v-model="searchQuery"
                placeholder="Buscar por nombre, subcategoría, tags..."
                class="md:col-span-2"
                size="sm"
              />
              <UiSelect
                v-model="filterGender"
                :options="genderOptions"
                placeholder="Género"
                size="sm"
              />
              <UiSelect
                v-model="filterSeason"
                :options="seasonOptions"
                placeholder="Estación"
                size="sm"
              />
              <UiSelect
                v-model="filterWeather"
                :options="weatherOptions"
                placeholder="Clima"
                size="sm"
              />
              <UiSelect
                v-model="filterOccasion"
                :options="occasionOptions"
                placeholder="Ocasión"
                size="sm"
              />
            </div>
          </div>

          <!-- Garment List -->
          <div class="max-h-[60vh] overflow-y-auto p-4">
            <div v-if="filteredGarments.length === 0" class="text-center py-12 text-stone-500">
              <MagnifyingGlassIcon class="mx-auto h-8 w-8 mb-2 text-stone-300" />
              <p>No se encontraron prendas con los filtros actuales</p>
            </div>

            <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
              <div
                v-for="garment in filteredGarments"
                :key="garment.id"
                class="bg-white dark:bg-stone-800 rounded-lg border border-stone-200 dark:border-stone-700 p-3 hover:shadow-md transition-shadow cursor-pointer"
                tabindex="0"
                @click="selectGarment(garment)"
                @keydown.enter="selectGarment(garment)"
                @keydown.space.prevent="selectGarment(garment)"
                role="button"
                aria-label="Seleccionar prenda"
              >
                <div class="flex items-start gap-3">
                  <div class="p-2 bg-stone-100 dark:bg-stone-700 rounded-lg">
                    <HangerIcon class="h-5 w-5 text-stone-600 dark:text-stone-400" />
                  </div>
                  <div class="flex-1 min-w-0">
                    <h4 class="font-medium text-stone-900 dark:text-stone-100 truncate">{{ garment.name }}</h4>
                    <p class="text-xs text-stone-500 dark:text-stone-400 truncate">{{ garment.sub_category }}</p>
                    <div class="flex flex-wrap gap-1 mt-1">
                      <span
                        v-for="tag in garment.tags?.slice(0, 4) || []"
                        :key="tag"
                        class="inline-flex items-center gap-0.5 px-1.5 py-0.5 text-[10px] font-medium bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300 rounded"
                      >
                        <TagIcon class="h-2.5 w-2.5" />
                        {{ tag }}
                      </span>
                      <span v-if="(garment.tags?.length || 0) > 4" class="text-xs text-stone-400">+{{ (garment.tags?.length || 0) - 4 }}</span>
                    </div>
                    <div class="flex items-center gap-2 mt-2 text-xs text-stone-500 dark:text-stone-400">
                      <span class="px-1.5 py-0.5 bg-stone-100 dark:bg-stone-800 rounded">{{ garment.category }}</span>
                      <span v-if="garment.fit" class="px-1.5 py-0.5 bg-stone-100 dark:bg-stone-800 rounded">{{ garment.fit }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Footer -->
          <footer class="p-4 border-t border-stone-200 dark:border-stone-700 flex justify-end gap-2">
            <UiButton variant="ghost" @click="close">Cancelar</UiButton>
          </footer>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { PhX, PhMagnifyingGlass, PhTag, PhTShirt } from '@phosphor-icons/vue';
import type { Garment } from '@/types/api';
import { useGarmentStore } from '@/stores/garment';

const XIcon = PhX;
const MagnifyingGlassIcon = PhMagnifyingGlass;
const TagIcon = PhTag;
const HangerIcon = PhTShirt;

interface Props {
  isOpen: boolean;
  slotType: string;
}

interface Emits {
  (e: 'select', garment: Garment): void;
  (e: 'close'): void;
}

const props = defineProps<Props>();
const emit = defineEmits<Emits>();

const garmentStore = useGarmentStore();

const activeSlotLabel = computed(() => {
  const labels: Record<string, string> = {
    BASE_LAYER: 'Capa base',
    MID_LAYER: 'Capa media',
    OUTER_LAYER: 'Capa exterior',
    FOOTWEAR: 'Calzado',
    HEADWEAR: 'Accesorios de cabeza',
    ACCESSORY: 'Accesorios',
  };
  return labels[props.slotType] || props.slotType;
});

const searchQuery = ref('');
const filterGender = ref('');
const filterSeason = ref('');
const filterWeather = ref('');
const filterOccasion = ref('');

const genderOptions = [
  { value: '', label: 'Todos' },
  { value: 'gender:female', label: 'Mujer' },
  { value: 'gender:male', label: 'Hombre' },
  { value: 'gender:unisex', label: 'Unisex' },
];

const seasonOptions = [
  { value: '', label: 'Todas' },
  { value: 'season:spring', label: 'Primavera' },
  { value: 'season:summer', label: 'Verano' },
  { value: 'season:autumn', label: 'Otoño' },
  { value: 'season:winter', label: 'Invierno' },
];

const weatherOptions = [
  { value: '', label: 'Todos' },
  { value: 'weather:hot', label: 'Calor' },
  { value: 'weather:warm', label: 'Cálido' },
  { value: 'weather:mild', label: 'Templado' },
  { value: 'weather:cool', label: 'Fresco' },
  { value: 'weather:cold', label: 'Frío' },
  { value: 'weather:rain', label: 'Lluvia' },
  { value: 'weather:snow', label: 'Nieve' },
];

const occasionOptions = [
  { value: '', label: 'Todas' },
  { value: 'occasion:casual', label: 'Casual' },
  { value: 'occasion:formal', label: 'Formal' },
  { value: 'occasion:business', label: 'Negocios' },
  { value: 'occasion:street', label: 'Streetwear' },
  { value: 'occasion:sport', label: 'Deporte' },
  { value: 'occasion:elegant', label: 'Elegante' },
  { value: 'occasion:beach', label: 'Playa' },
  { value: 'occasion:evening', label: 'Noche' },
];

const filteredGarments = computed(() => {
  let result = garmentStore.catalog;

  // Filter by slot type (category)
  const slotToCategory: Record<string, string[]> = {
    BASE_LAYER: ['TOP', 'BOTTOM', 'FULL_BODY'],
    MID_LAYER: ['TOP'],
    OUTER_LAYER: ['TOP'],
    FOOTWEAR: ['FOOTWEAR'],
    HEADWEAR: ['HEADWEAR'],
    ACCESSORY: ['ACCESSORY'],
  };
  const allowedCategories = slotToCategory[props.slotType] || [];
  if (allowedCategories.length) {
    result = result.filter((g) => allowedCategories.includes(g.category));
  }

  // Search query
  if (searchQuery.value) {
    const q = searchQuery.value.toLowerCase();
    result = result.filter(
      (g) =>
        g.name.toLowerCase().includes(q) ||
        g.sub_category.toLowerCase().includes(q) ||
        g.tags?.some((t) => t.toLowerCase().includes(q))
    );
  }

  // Tag filters
  const tagFilters = [filterGender.value, filterSeason.value, filterWeather.value, filterOccasion.value].filter(Boolean);
  if (tagFilters.length) {
    result = result.filter((g) => tagFilters.every((tag) => g.tags?.includes(tag)));
  }

  return result;
});

async function onOpen() {
  if (garmentStore.catalog.length === 0) {
    await garmentStore.fetchAll();
  }
}

function selectGarment(garment: Garment) {
  emit('select', garment);
  emit('close');
}

function close() {
  emit('close');
}

onMounted(() => {
  onOpen();
});
</script>