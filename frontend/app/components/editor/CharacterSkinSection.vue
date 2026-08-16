<template>
  <div class="grid grid-cols-2 gap-3">
    <UiSelect
      v-model="character.data.skin_profile.fitzpatrick_scale"
      label="Escala Fitzpatrick"
      :options="fitzpatrickOptions"
    />
    <UiSelect
      v-model="character.data.skin_profile.undertone"
      label="Subtono"
      :options="undertoneOptions"
    />
    <UiSelect
      v-model="character.data.skin_profile.finish"
      label="Acabado"
      :options="finishOptions"
    />
  </div>
</template>

<script setup lang="ts">
const character = useCharacterStore();

const fitzpatrickOptions = [
  { value: 'TYPE_I', label: 'Tipo I' },
  { value: 'TYPE_II', label: 'Tipo II' },
  { value: 'TYPE_III', label: 'Tipo III' },
  { value: 'TYPE_IV', label: 'Tipo IV' },
  { value: 'TYPE_V', label: 'Tipo V' },
  { value: 'TYPE_VI', label: 'Tipo VI' },
];

const undertoneOptions = [
  { value: 'COOL', label: 'Frío' },
  { value: 'WARM', label: 'Cálido' },
  { value: 'NEUTRAL', label: 'Neutro' },
  { value: 'OLIVE', label: 'Oliva' },
];

const finishOptions = [
  { value: 'DEWY', label: 'Húmedo' },
  { value: 'MATTE', label: 'Mate' },
  { value: 'LUMINOUS', label: 'Luminoso' },
  { value: 'SATIN', label: 'Satinado' },
];
</script>
