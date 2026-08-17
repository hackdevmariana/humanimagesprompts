<template>
  <AreaLayout title="Escenario" icon="PhFilmSlate" blockKey="scene">
    <template #sidebar>
      <AreaSidebar :block-key="blockKey" :store="store" />
    </template>
    <template #editor>
      <SceneEditor />
    </template>
  </AreaLayout>
</template>

<script setup lang="ts">
import AreaLayout from '@/layouts/AreaLayout.vue';
import AreaSidebar from '@/components/editor/AreaSidebar.vue';
import SceneEditor from '@/components/editor/SceneEditor.vue';
import { useSceneStore } from '@/stores/scene';

const blockKey = 'scene';
const store = useSceneStore();
</script>