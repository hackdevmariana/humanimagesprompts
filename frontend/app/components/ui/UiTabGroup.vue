<template>
  <div class="border-b border-stone-200 dark:border-stone-700">
    <nav
      class="flex gap-2 overflow-x-auto"
      aria-label="Tabs"
    >
      <button
        v-for="tab in tabs"
        :key="tabValue(tab)"
        :data-active="activeTab === tabValue(tab)"
        @click="setActive(tab)"
        :class="[
          'px-3 py-2 text-sm font-medium whitespace-nowrap border-b-2 transition-colors',
          activeTab === tabValue(tab)
            ? 'border-sky-500 text-sky-600 dark:text-sky-400'
            : 'border-transparent text-stone-600 hover:text-stone-900 dark:text-stone-400 dark:hover:text-stone-200',
        ]"
      >
        {{ tabLabel(tab) }}
      </button>
    </nav>
    <div class="pt-3">
      <slot></slot>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(defineProps<{
  tabs?: unknown[];
  modelValue?: string;
  valueKey?: string;
  labelKey?: string;
}>(), {
  tabs: () => [],
  modelValue: '',
  valueKey: 'value',
  labelKey: 'label',
});

const emit = defineEmits<{
  (e: 'update:modelValue', v: string): void;
}>();

const activeTab = computed(() => props.modelValue);

function tabValue(tab: unknown): string {
  const t = tab as Record<string, unknown>;
  if (typeof tab === 'string') return tab;
  return String(t[props.valueKey] ?? '');
}

function tabLabel(tab: unknown): string {
  const t = tab as Record<string, unknown>;
  if (typeof tab === 'string') return tab;
  return String(t[props.labelKey] ?? tab);
}

function setActive(tab: unknown) {
  emit('update:modelValue', tabValue(tab));
}
</script>
