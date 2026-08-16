<template>
  <div class="grid grid-cols-2 gap-3">
    <UiInput
      v-model="data.title"
      label="Título"
      placeholder="Ej: Manos sobre la cadera"
    />
    <UiSelect
      v-model="data.category"
      label="Categoría"
      :options="categoryOptions"
    />
    <UiInput
      v-model="data.body_language"
      label="Lenguaje corporal"
      placeholder="Ej: Postura erguida, hombras relajadas"
    />
    <UiSelect
      v-model="data.facial_expression"
      label="Expresión facial"
      :options="expressionOptions"
    />
    <div class="flex items-end">
      <UiInput
        v-model.number="data.expression_intensity"
        label="Intensidad"
        type="number"
        min="0"
        max="10"
      />
    </div>
    <UiSelect
      v-model="data.camera_angle"
      label="Ángulo de cámara"
      :options="cameraAngleOptions"
    />
    <UiSelect
      v-model="data.required_framing"
      label="Encuadre"
      :options="framingOptions"
    />
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';

const pose = usePoseStore();
const { data } = storeToRefs(pose);

const categoryOptions = [
  { value: 'HIGH_FASHION', label: 'Alta costura' },
  { value: 'EDITORIAL', label: 'Editorial' },
  { value: 'PORTRAIT', label: 'Retrato' },
  { value: 'CATWALK', label: 'Pasarela' },
  { value: 'CANDID', label: 'Candid' },
];

const expressionOptions = [
  { value: 'NEUTRAL', label: 'Neutral' },
  { value: 'SMILE', label: 'Sonrisa' },
  { value: 'SOFT_SMEAR', label: 'Beso suave' },
  { value: 'PUGIL', label: 'Puño' },
  { value: 'CONFIDENT', label: 'Confiada' },
  { value: 'CONTEMPLATIVE', label: 'Contemplativa' },
  { value: 'MYSTERIOUS', label: 'Misteriosa' },
  { value: 'PASSIONATE', label: 'Apasionada' },
];

const cameraAngleOptions = [
  { value: 'EYE_LEVEL', label: 'Nivel de los ojos' },
  { value: 'HIGH_ANGLE', label: 'Ángulo alto' },
  { value: 'LOW_ANGLE', label: 'Ángulo bajo' },
  { value: 'DUTCH_ANGLE', label: 'Ángulo holandés' },
  { value: 'BIRDSEYE', label: 'Vista aérea' },
];

const framingOptions = [
  { value: 'MEDIUM_SHOT', label: 'Plano medio' },
  { value: 'CLOSE_UP', label: 'Primer plano' },
  { value: 'WIDE_SHOT', label: 'Plano general' },
  { value: 'KNEE_UP', label: 'Hasta la rodilla' },
  { value: 'THIGH_UP', label: 'Hasta el muslo' },
];
</script>
