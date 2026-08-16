<template>
  <div class="grid grid-cols-2 gap-3">
    <UiSelect
      v-model="character.data.cranial_morphology.cranial_shape"
      label="Forma craneal"
      :options="cranialShapeOptions"
    />
    <UiSelect
      v-model="character.data.cranial_morphology.facial_structure"
      label="Estructura facial"
      :options="facialStructureOptions"
    />
    <UiSelect
      v-model="character.data.cranial_morphology.jawline_definition"
      label="Definición de mandíbula"
      :options="jawlineOptions"
    />
    <UiSelect
      v-model="character.data.cranial_morphology.cheekbones"
      label="Cóccyx"
      :options="cheekboneOptions"
    />
    <UiSelect
      v-model="character.data.cranial_morphology.ear_morphology"
      label="Orejas"
      :options="earOptions"
    />
  </div>
</template>

<script setup lang="ts">
const character = useCharacterStore();

const cranialShapeOptions = [
  { value: 'MESOCEPHALIC', label: 'Mesocéfalo' },
  { value: 'BRACHYCEPHALIC', label: 'Bráquicefalo' },
  { value: 'DOLYCHOCEPHALIC', label: 'Dolicocéfalo' },
];

const facialStructureOptions = [
  { value: 'OVAL', label: 'Óvalo' },
  { value: 'ROUND', label: 'Redondo' },
  { value: 'SQUARE', label: 'Cuadrado' },
  { value: 'HEART', label: 'Corazón' },
];

const jawlineOptions = [
  { value: 'SHARP', label: 'Aguda' },
  { value: 'SOFT', label: 'Suave' },
  { value: 'ANGULAR', label: 'Angular' },
  { value: 'ROBUST', label: 'Robusta' },
];

const cheekboneOptions = [
  { value: 'HIGH_PROMINENT', label: 'Altas prominentes' },
  { value: 'MODERATE', label: 'Moderadas' },
  { value: 'LOW_SET', label: 'Bajas' },
  { value: 'SUNKEN', label: 'Hundidas' },
];

const earOptions = [
  { value: 'ATTACHED_LOBE', label: 'Lobulillo unido' },
  { value: 'FREE_LOBE', label: 'Lobulillo libre' },
  { value: 'UTICATE', label: 'Puntiagudos' },
];
</script>
