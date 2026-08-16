<template>
  <div class="grid grid-cols-2 gap-3">
    <UiSelect
      v-model="character.data.eye_profile.primary_color"
      label="Color primario"
      :options="colorOptions"
    />
    <UiSelect
      v-model="character.data.eye_profile.secondary_color"
      label="Color secundario"
      :options="colorOptionsWithNone"
    />
    <UiSelect
      v-model="character.data.eye_profile.eye_shape"
      label="Forma de ojos"
      :options="eyeShapeOptions"
    />
    <UiSelect
      v-model="character.data.eye_profile.eyelash_details"
      label="Pestañas"
      :options="eyelashOptions"
    />
  </div>
</template>

<script setup lang="ts">
const character = useCharacterStore();

const colorOptions = [
  { value: 'BROWN', label: 'Marrón' },
  { value: 'BLUE', label: 'Azul' },
  { value: 'GREEN', label: 'Verde' },
  { value: 'HAZEL', label: 'Avellana' },
  { value: 'AMBER', label: 'Ámbar' },
  { value: 'GRAY', label: 'Gris' },
];

const colorOptionsWithNone = [
  { value: null, label: 'Ninguno' },
  ...colorOptions,
];

const eyeShapeOptions = [
  { value: 'ALMOND', label: 'Almendra' },
  { value: 'ROUND', label: 'Redonda' },
  { value: 'HOODED', label: 'Caída' },
  { value: 'UPTURNED', label: 'Caudalada' },
  { value: 'DOWNTURNED', label: 'Invertida' },
];

const eyelashOptions = [
  { value: 'LONG_DENSE', label: 'Largas y densas' },
  { value: 'SHORT_SPARSE', label: 'Cortas y escasas' },
  { value: 'MEDIUM', label: 'Medias' },
  { value: 'CURLED', label: 'Rizadas' },
];
</script>
