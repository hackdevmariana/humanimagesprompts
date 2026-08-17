<template>
  <AreaLayout title="Outfit" icon="PhTShirt" blockKey="outfit">
    <template #sidebar>
      <AreaSidebar :block-key="blockKey" :store="store" />
    </template>
    <template #editor>
      <OutfitEditor />
    </template>
  </AreaLayout>
</template>

<script setup lang="ts">
import AreaLayout from '@/layouts/AreaLayout.vue';
import AreaSidebar from '@/components/editor/AreaSidebar.vue';
import OutfitEditor from '@/components/editor/OutfitEditor.vue';
import { useOutfitStore } from '@/stores/outfit';

const blockKey = 'outfit';
const store = useOutfitStore();
</script>