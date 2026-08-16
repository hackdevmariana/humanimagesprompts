<template>
  <div class="grid grid-cols-2 gap-3">
    <UiSelect
      v-model="data.setup_type"
      label="Tipo de iluminación"
      :options="setupOptions"
    />
    <UiSelect
      v-model="data.color_temperature"
      label="Temperatura de color"
      :options="temperatureOptions"
    />
    <UiSelect
      v-model="data.key_light_direction"
      label="Dirección de luz principal"
      :options="directionOptions"
    />
    <UiSelect
      v-model="data.hardness"
      label="Dureza"
      :options="hardnessOptions"
    />
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';

const lighting = useLightingStore();
const { data } = storeToRefs(lighting);

const setupOptions = [
  { value: 'GOLDEN_HOUR', label: 'Hora dorada' },
  { value: 'BLUE_HOUR', label: 'Hora azul' },
  { value: 'STUDIO_SOFTBOX', label: 'Estudio softbox' },
  { value: 'STUDIO_HARSHELL', label: 'Estudio dureza' },
  { value: 'WINDOW_LIGHT', label: 'Luz de ventana' },
  { value: 'NEON', label: 'Neón' },
  { value: 'CANDLELIGHT', label: 'Luz de velas' },
];

const temperatureOptions = [
  { value: 'WARM_2700K', label: 'Cálida 2700K' },
  { value: 'WARM_3200K', label: 'Cálida 3200K' },
  { value: 'NEUTRAL_4500K', label: 'Neutra 4500K' },
  { value: 'COOL_5600K', label: 'Fría 5600K' },
  { value: 'COOL_7000K', label: 'Fría 7000K' },
];

const directionOptions = [
  { value: 'FRONT', label: 'Frontal' },
  { value: 'SIDE_45', label: 'Lateral 45°' },
  { value: 'SIDE_90', label: 'Lateral 90°' },
  { value: 'BACK_45', label: 'Posterior 45°' },
  { value: 'OVERHEAD', label: 'Desde arriba' },
  { value: 'UNDER', label: 'Desde abajo' },
];

const hardnessOptions = [
  { value: 'SOFT_DIFFUSED', label: 'Suave y difusa' },
  { value: 'SEMI_SOFT', label: 'Media' },
  { value: 'HARD_SHADOW', label: 'Dura con sombra' },
  { value: 'CONTRAST', label: 'Contraste alto' },
];
</script>
