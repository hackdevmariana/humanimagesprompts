<template>
  <div class="space-y-4">
    <div class="grid grid-cols-2 gap-3">
      <UiInput
        v-model="data.title"
        label="Título"
        placeholder="Ej: Azotea al atardecer"
      />
      <UiSelect
        v-model="data.environment_type"
        label="Tipo de entorno"
        :options="environmentOptions"
      />
      <div class="col-span-2">
        <UiInput
          v-model="data.location_details"
          label="Detalles de ubicación"
          placeholder="Ej: Azotea con vista a la ciudad, césped húmedo"
        />
      </div>
    </div>

    <UiAccordion title="Cámara y lente" :default-open="true">
      <div class="grid grid-cols-2 gap-3 pt-1">
        <UiSelect
          v-model="data.camera_and_lens.focal_length"
          label="Distancia focal"
          :options="focalLengthOptions"
        />
        <UiSelect
          v-model="data.camera_and_lens.aperture"
          label="Apertura"
          :options="apertureOptions"
        />
        <UiSelect
          v-model="data.camera_and_lens.depth_of_field"
          label="Profundidad de campo"
          :options="dofOptions"
        />
        <UiSelect
          v-model="data.camera_and_lens.film_grain"
          label="Grano de película"
          :options="filmGrainOptions"
        />
      </div>
    </UiAccordion>
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';

const scene = useSceneStore();
const { data } = storeToRefs(scene);

const environmentOptions = [
  { value: 'URBAN', label: 'Urbano' },
  { value: 'NATURAL', label: 'Natural' },
  { value: 'INDOOR', label: 'Interior' },
  { value: 'STUDIO', label: 'Estudio' },
  { value: 'FANTASY', label: 'Fantasía' },
  { value: 'SCI_FI', label: 'Ciencia ficción' },
];

const focalLengthOptions = [
  { value: 'LENS_35MM_WIDE', label: '35mm gran angular' },
  { value: 'LENS_50MM_NORMAL', label: '50mm normal' },
  { value: 'LENS_85MM_PORTRAIT', label: '85mm retrato' },
  { value: 'LENS_135MM_TELEPHOTO', label: '135mm telefoto' },
];

const apertureOptions = [
  { value: 'F_1_2', label: 'f/1.2' },
  { value: 'F_1_4', label: 'f/1.4' },
  { value: 'F_1_8', label: 'f/1.8' },
  { value: 'F_2_8', label: 'f/2.8' },
  { value: 'F_4', label: 'f/4' },
  { value: 'F_5_6', label: 'f/5.6' },
  { value: 'F_8', label: 'f/8' },
  { value: 'F_11', label: 'f/11' },
];

const dofOptions = [
  { value: 'SHALLOW_BOKEH', label: 'Superficial (bokeh)' },
  { value: 'MODERATE', label: 'Moderada' },
  { value: 'DEEP', label: 'Profunda' },
];

const filmGrainOptions = [
  { value: 'NONE', label: 'Ninguno' },
  { value: 'SUBTLE_35MM', label: 'Subtle 35mm' },
  { value: 'MEDIUM_35MM', label: 'Medio 35mm' },
  { value: 'HEAVY_35MM', label: 'Intenso 35mm' },
  { value: 'VINTAGE_8MM', label: 'Vintage 8mm' },
];
</script>
