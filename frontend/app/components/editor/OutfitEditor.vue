<template>
  <div class="space-y-4">
    <div class="grid grid-cols-2 gap-3">
      <UiInput
        v-model="data.name"
        label="Nombre del outfit"
        placeholder="Ej: Look veraniego"
      />
      <UiSelect
        v-model="data.style_category"
        label="Categoría de estilo"
        :options="styleOptions"
      />
    </div>

    <UiAccordion title="Prendas" :default-open="true">
      <div class="space-y-3 pt-1">
        <div
          v-for="slot in slotTypes"
          :key="slot"
          class="flex items-end gap-2"
        >
          <div class="w-24 text-xs font-medium text-stone-600 dark:text-stone-400">
            {{ slotLabels[slot] }}
          </div>
          <div class="flex-1">
            <GarmentEditor
              v-if="slots[slot]"
              :garment="slots[slot] as any"
              @update="u => outfit.setGarment(slot, u)"
            />
            <div class="text-center text-xs text-stone-500 py-2">
              Sin prenda en este slot
            </div>
          </div>
          <div v-if="slots[slot]" class="flex items-end">
            <UiButton
              variant="ghost"
              size="sm"
              @click="removeGarment(slot)"
            >
              <XIcon class="h-3 w-3" />
            </UiButton>
          </div>
        </div>
      </div>
    </UiAccordion>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { storeToRefs } from 'pinia';
import { PhX } from '@phosphor-icons/vue';
import GarmentEditor from './GarmentEditor.vue';

const XIcon = PhX;

const outfit = useOutfitStore();
const { data } = storeToRefs(outfit);
const slots = computed(() => outfit.garmentSlots);

const slotTypes = [
  'BASE_LAYER',
  'MID_LAYER',
  'OUTER_LAYER',
  'FOOTWEAR',
  'HEADWEAR',
  'ACCESSORY',
];

const slotLabels: Record<string, string> = {
  BASE_LAYER: 'Capa base',
  MID_LAYER: 'Capa media',
  OUTER_LAYER: 'Capa exterior',
  FOOTWEAR: 'Calzado',
  HEADWEAR: 'Accesorios de cabeza',
  ACCESSORY: 'Accesorios',
};

const styleOptions = [
  { value: 'CASUAL', label: 'Casual' },
  { value: 'FORMAL', label: 'Formal' },
  { value: 'ATHLETIC', label: 'Atlético' },
  { value: 'HIGH_FASHION', label: 'Alta costura' },
  { value: 'TACTICAL', label: 'Táctico' },
  { value: 'PERIOD_COSTUME', label: 'Traje época' },
];

function removeGarment(slot: string) {
  outfit.setGarment(slot, null);
}
</script>
