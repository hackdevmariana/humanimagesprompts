<template>
  <div class="flex flex-col gap-1.5">
    <label
      v-if="label"
      :for="selectId"
      class="text-xs font-medium text-stone-700 dark:text-stone-300"
    >
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>
    <div class="relative">
      <select
        :id="selectId"
        v-model="value"
        :disabled="disabled"
        :class="[
          'w-full appearance-none rounded-md border bg-white dark:bg-stone-900 px-3 py-2 pr-8 text-sm',
          'text-stone-900 dark:text-stone-100',
          'transition-colors duration-150',
          'focus:outline-none focus:ring-2 focus:ring-iris-500 focus:border-transparent',
          'disabled:cursor-not-allowed disabled:opacity-50',
          errorClass,
        ]"
      >
        <option v-if="placeholder" value="" disabled>{{ placeholder }}</option>
        <option
          v-for="option in options"
          :key="optionKey(option)"
          :value="optionValue(option)"
        >
          {{ optionLabel(option) }}
        </option>
      </select>
      <component
        :is="ChevronDownIcon"
        class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2 h-4 w-4 text-stone-400"
      />
    </div>
    <p v-if="error" class="text-xs text-red-600 dark:text-red-400">
      {{ error }}
    </p>
  </div>
</template>

<script setup lang="ts">
import type { Component } from 'vue';
import { computed } from 'vue';
import { PhCaretDown } from '@phosphor-icons/vue';

const ChevronDownIcon = PhCaretDown;

const props = withDefaults(defineProps<{
  modelValue?: unknown;
  label?: string;
  options?: unknown[];
  valueKey?: string;
  labelKey?: string;
  placeholder?: string;
  error?: string;
  required?: boolean;
  disabled?: boolean;
  selectId?: string;
}>(), {
  modelValue: undefined,
  label: '',
  options: () => [],
  valueKey: 'value',
  labelKey: 'label',
  placeholder: '',
  error: '',
  required: false,
  disabled: false,
  selectId: '',
});

const emit = defineEmits<{
  (e: 'update:modelValue', v: unknown): void;
}>();

const value = computed({
  get: () => props.modelValue,
  set: (v: unknown) => emit('update:modelValue', v),
});

const errorClass = computed(() =>
  props.error
    ? 'border-red-500 focus:ring-red-500'
    : 'border-stone-300 dark:border-stone-700',
);

function optionKey(option: unknown): string {
  const o = option as Record<string, unknown>;
  if (typeof option === 'string') return option;
  return String(o[props.valueKey] ?? '');
}

function optionValue(option: unknown): unknown {
  const o = option as Record<string, unknown>;
  if (typeof option === 'string') return option;
  return o[props.valueKey] ?? option;
}

function optionLabel(option: unknown): string {
  const o = option as Record<string, unknown>;
  if (typeof option === 'string') return option;
  return String(o[props.labelKey] ?? option);
}
</script>
