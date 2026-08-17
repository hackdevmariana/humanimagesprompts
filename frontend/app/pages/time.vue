<template>
  <AreaLayout title="Tiempo" icon="PhClock" blockKey="time">
    <template #sidebar>
      <AreaSidebar :block-key="blockKey" :store="store" />
    </template>
    <template #editor>
      <TimeWeatherEditor />
    </template>
  </AreaLayout>
</template>

<script setup lang="ts">
import AreaLayout from '@/layouts/AreaLayout.vue';
import AreaSidebar from '@/components/editor/AreaSidebar.vue';
import TimeWeatherEditor from '@/components/editor/TimeWeatherEditor.vue';
import { useTimeStore } from '@/stores/time';

const blockKey = 'time';
const store = useTimeStore();
</script>