<template>
  <AreaLayout title="Pose" icon="PhLightning" blockKey="pose">
    <template #sidebar>
      <AreaSidebar :block-key="blockKey" :store="store" />
    </template>
    <template #editor>
      <PoseEditor />
    </template>
  </AreaLayout>
</template>

<script setup lang="ts">
import AreaLayout from '@/layouts/AreaLayout.vue';
import AreaSidebar from '@/components/editor/AreaSidebar.vue';
import PoseEditor from '@/components/editor/PoseEditor.vue';
import { usePoseStore } from '@/stores/pose';

const blockKey = 'pose';
const store = usePoseStore();
</script>