<template>
  <div class="space-y-3">
    <div class="grid grid-cols-2 gap-3">
      <UiInput
        v-model="character.data.name"
        label="Nombre"
        placeholder="Ej: Aria"
      />
      <UiSelect
        v-model="character.data.gender"
        label="Género"
        :options="genderOptions"
      />
      <UiInput
        v-model.number="character.data.age"
        label="Edad"
        type="number"
      />
      <UiSelect
        v-model="character.data.ethnicity"
        label="Etnia"
        :options="ethnicityOptions"
      />
    </div>

    <UiAccordion
      v-for="tab in tabs"
      :key="tab.key"
      :title="tab.label"
      :default-open="false"
    >
      <component :is="tab.component" />
    </UiAccordion>
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from 'pinia';
import CharacterCranialSection from './CharacterCranialSection.vue';
import CharacterSkinSection from './CharacterSkinSection.vue';
import CharacterHairSection from './CharacterHairSection.vue';
import CharacterEyesSection from './CharacterEyesSection.vue';
import CharacterGroomingSection from './CharacterGroomingSection.vue';
import CharacterMakeupSection from './CharacterMakeupSection.vue';

const character = useCharacterStore();
const { data } = storeToRefs(character);

const genderOptions = [
  { value: 'FEMALE', label: 'Femenino' },
  { value: 'MALE', label: 'Masculino' },
  { value: 'NON_BINARY', label: 'No binario' },
];

const ethnicityOptions = [
  { value: 'CAUCASIAN', label: 'Caucásico' },
  { value: 'EAST_ASIAN', label: 'Asia Oriental' },
  { value: 'SOUTH_ASIAN', label: 'Asia Meridional' },
  { value: 'AFRICAN', label: 'Africano' },
  { value: 'LATINO', label: 'Latino' },
  { value: 'MIDDLE_EASTERN', label: 'Medio Oriente' },
  { value: 'MUTT', label: 'Mestizo' },
];

const tabs = [
  { key: 'cranial', label: 'Morfología Craneal', component: CharacterCranialSection },
  { key: 'skin', label: 'Piel', component: CharacterSkinSection },
  { key: 'hair', label: 'Pelo', component: CharacterHairSection },
  { key: 'eyes', label: 'Ojos', component: CharacterEyesSection },
  { key: 'grooming', label: 'Estilado', component: CharacterGroomingSection },
  { key: 'makeup', label: 'Maquillaje', component: CharacterMakeupSection },
];
</script>
