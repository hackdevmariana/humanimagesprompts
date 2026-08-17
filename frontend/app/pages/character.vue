<template>
  <AreaLayout title="Personaje" icon="PhUserCircle" blockKey="character">
    <template #sidebar>
      <AreaSidebar :block-key="blockKey" :store="store" />
    </template>
    <template #editor>
      <CharacterEditor />
    </template>
  </AreaLayout>
</template>

<script setup lang="ts">
import AreaLayout from '@/layouts/AreaLayout.vue';
import AreaSidebar from '@/components/editor/AreaSidebar.vue';
import CharacterEditor from '@/components/editor/CharacterEditor.vue';
import { useCharacterStore } from '@/stores/character';

const blockKey = 'character';
const store = useCharacterStore();
</script>