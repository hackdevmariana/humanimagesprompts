<template>
  <AreaLayout title="Iluminación" icon="PhSunDim" blockKey="lighting">
    <template #sidebar>
      <AreaSidebar :block-key="blockKey" :store="store" />
    </template>
    <template #editor>
      <LightingEditor />
    </template>
  </AreaLayout>
</template>

<script setup lang="ts">
import AreaLayout from '@/layouts/AreaLayout.vue';
import AreaSidebar from '@/components/editor/AreaSidebar.vue';
import LightingEditor from '@/components/editor/LightingEditor.vue';
import { useLightingStore } from '@/stores/lighting';

const blockKey = 'lighting';
const store = useLightingStore();
</script>