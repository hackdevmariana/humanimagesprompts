<template>
  <div class="space-y-3">
    <UiInput
      v-model="character.data.current_makeup.style_name"
      label="Nombre del estilo"
      placeholder="Ej: No-Makeup Natural Glow"
    />
    <div class="grid grid-cols-2 gap-3">
      <UiSelect
        v-model="character.data.current_makeup.lipstick"
        label="Lipstick"
        :options="makeupOptions"
      />
      <UiSelect
        v-model="character.data.current_makeup.eyeshadow"
        label="Delinejador de ojos"
        :options="makeupOptions"
      />
      <UiSelect
        v-model="character.data.current_makeup.eyeliner"
        label="Línea de ojos"
        :options="makeupOptions"
      />
      <UiSelect
        v-model="character.data.current_makeup.blush_and_contour"
        label="Rubor y contorno"
        :options="makeupOptions"
      />
      <UiSelect
        v-model="character.data.current_makeup.nails"
        label="Uñas"
        :options="makeupOptions"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
const character = useCharacterStore();

const makeupOptions = [
  { value: null, label: 'Ninguno' },
  { value: 'SUBTLE_NATURAL', label: 'Subtle Natural' },
  { value: 'GLITTER', label: 'Brillo' },
  { value: 'MATTE', label: 'Mate' },
  { value: 'GLOSS', label: 'Gloss' },
  { value: 'SMOKY', label: 'Ahumado' },
  { value: 'CUT_CREASE', label: 'Cut Crease' },
];
</script>
