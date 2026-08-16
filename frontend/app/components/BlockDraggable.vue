<template>
  <draggable
    :model-value="items"
    item-key="key"
    :handle="'.drag-handle'"
    :animation="150"
    ghost-class="opacity-40"
    class="space-y-4"
    @update:model-value="emit('update:items', $event)"
  >
    <BlockEditor
      v-for="key in items"
      :key="key"
      :block-key="key"
    />
  </draggable>
</template>

<script setup lang="ts">
import { VueDraggableNext as draggable } from 'vue-draggable-next';

defineProps<{
  items: string[];
}>();

const emit = defineEmits<{
  (e: 'update:items', value: string[]): void;
}>();
</script>