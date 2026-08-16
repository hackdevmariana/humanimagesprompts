<template>
  <div class="space-y-3">
    <UiInput
      v-model="character.data.current_grooming.hairstyle_name"
      label="Nombre del peinado"
      placeholder="Ej: Bob despeinado"
    />
    <div class="grid grid-cols-2 gap-3">
      <UiSelect
        v-model="character.data.current_grooming.hair_length"
        label="Longitud"
        :options="hairLengthOptions"
      />
      <UiSelect
        v-model="character.data.current_grooming.hair_color_primary"
        label="Color principal"
        :options="hairColorOptions"
      />
      <UiSelect
        v-model="character.data.current_grooming.hair_color_secondary"
        label="Color secundario"
        :options="hairColorOptionsWithNone"
      />
      <UiSelect
        v-model="character.data.current_grooming.hair_finish"
        label="Acabado"
        :options="finishOptions"
      />
      <UiSelect
        v-model="character.data.current_grooming.facial_hair_style"
        label="Barba"
        :options="facialHairOptions"
      />
      <UiSelect
        v-model="character.data.current_grooming.facial_hair_color"
        label="Color de barba"
        :options="hairColorOptionsWithNone"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
const character = useCharacterStore();

const hairLengthOptions = [
  { value: 'BALD', label: 'Calvo' },
  { value: 'SHORT', label: 'Corto' },
  { value: 'MEDIUM', label: 'Medio' },
  { value: 'LONG', label: 'Largo' },
  { value: 'VERY_LONG', label: 'Muy largo' },
];

const hairColorOptions = [
  { value: 'Natural Brown', label: 'Marrón natural' },
  { value: 'Black', label: 'Negro' },
  { value: 'Blonde', label: 'Rubio' },
  { value: 'Red', label: 'Rojo' },
  { value: 'Gray', label: 'Gris' },
  { value: 'Blue', label: 'Azul' },
  { value: 'Pink', label: 'Rosa' },
  { value: 'Green', label: 'Verde' },
];

const hairColorOptionsWithNone = [
  { value: null, label: 'Ninguno' },
  ...hairColorOptions,
];

const finishOptions = [
  { value: 'NATURAL', label: 'Natural' },
  { value: 'STYLED', label: 'Estilizado' },
  { value: 'MESSY', label: 'Despeinado' },
  { value: 'SLEEK', label: 'Liso' },
];

const facialHairOptions = [
  { value: 'CLEAN_SHAVEN', label: 'Sin barba' },
  { value: 'STUBBLE', label: 'Poco vello' },
  { value: 'SHORT_BEARD', label: 'Barba corta' },
  { value: 'LONG_BEARD', label: 'Barba larga' },
  { value: 'MUSTACHE', label: 'Bigote' },
  { value: 'GOATEE', label: 'Perilla' },
];
</script>
