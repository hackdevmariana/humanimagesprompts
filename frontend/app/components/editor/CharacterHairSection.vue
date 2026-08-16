<template>
  <div class="grid grid-cols-2 gap-3">
    <UiSelect
      v-model="character.data.hair_profile.andre_walker_type"
      label="Tipo de cabello"
      :options="walkerOptions"
    />
    <UiSelect
      v-model="character.data.hair_profile.density"
      label="Densidad"
      :options="densityOptions"
    />
    <UiSelect
      v-model="character.data.hair_profile.porosity"
      label="Porosidad"
      :options="porosityOptions"
    />
    <UiSelect
      v-model="character.data.hair_profile.hairline"
      label="Recedor"
      :options="hairlineOptions"
    />
  </div>
</template>

<script setup lang="ts">
const character = useCharacterStore();

const walkerOptions = [
  { value: 'TYPE_1', label: 'Tipo 1 (Liso)' },
  { value: 'TYPE_2A', label: 'Tipo 2A (Ondulado suave)' },
  { value: 'TYPE_2B', label: 'Tipo 2B (Ondulado medio)' },
  { value: 'TYPE_2C', label: 'Tipo 2C (Ondulado fuerte)' },
  { value: 'TYPE_3A', label: 'Tipo 3A (Rizo suave)' },
  { value: 'TYPE_3B', label: 'Tipo 3B (Rizo medio)' },
  { value: 'TYPE_3C', label: 'Tipo 3C (Rizo fuerte)' },
  { value: 'TYPE_4A', label: 'Tipo 4A (Kink fleco)' },
  { value: 'TYPE_4B', label: 'Tipo 4B (Kink Z)' },
  { value: 'TYPE_4C', label: 'Tipo 4C (Kink coof)' },
];

const densityOptions = [
  { value: 'SPARSE', label: 'Escasa' },
  { value: 'THIN', label: 'Delgada' },
  { value: 'MEDIUM', label: 'Media' },
  { value: 'THICK', label: 'Gruesa' },
  { value: 'DENSE', label: 'Densa' },
];

const porosityOptions = [
  { value: 'LOW', label: 'Baja' },
  { value: 'MEDIUM', label: 'Media' },
  { value: 'HIGH', label: 'Alta' },
];

const hairlineOptions = [
  { value: 'STRAIGHT', label: 'Recta' },
  { value: 'SLEEK', label: 'Lisura' },
  { value: 'WAVY', label: 'Ondulada' },
  { value: 'CURVED', label: 'Curvada' },
];
</script>
