<template>
  <button
    :type="type"
    :disabled="disabled"
    :class="[
      'inline-flex items-center justify-center rounded-md font-medium transition-[color,background-color,transform,box-shadow] duration-150 ease-out active:scale-[0.97]',
      'focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2',
      'disabled:pointer-events-none disabled:opacity-50',
      sizeClass,
      variantClass,
    ]"
    @click="onClick"
  >
    <component
      v-if="icon"
      :is="icon"
      :class="iconClass"
    />
    <slot />
  </button>
</template>

<script setup lang="ts">
import type { Component } from 'vue';
import { computed } from 'vue';

const props = withDefaults(defineProps<{
  type?: 'button' | 'submit' | 'reset';
  variant?: 'primary' | 'default' | 'ghost' | 'danger';
  size?: 'sm' | 'md' | 'lg';
  icon?: Component | null;
  iconClass?: string;
  disabled?: boolean;
}>(), {
  type: 'button',
  variant: 'default',
  size: 'md',
  icon: null,
  iconClass: '',
  disabled: false,
});

const emit = defineEmits<{
  (e: 'click', ev: MouseEvent): void;
}>();

function onClick(e: MouseEvent) {
  if (!props.disabled) {
    emit('click', e);
  }
}

const variantClass = computed(() => {
  switch (props.variant) {
    case 'primary':
      return 'bg-iris-600 text-white hover:bg-iris-700 focus-visible:ring-iris-500 shadow-sm active:bg-iris-800';
    case 'ghost':
      return 'text-stone-600 hover:bg-stone-100 dark:text-stone-300 dark:hover:bg-stone-800 focus-visible:ring-iris-500';
    case 'danger':
      return 'bg-rose-600 text-white hover:bg-rose-700 focus-visible:ring-rose-500 shadow-sm active:bg-rose-800';
    default:
      return 'bg-stone-100 text-stone-900 hover:bg-stone-200 dark:bg-stone-800 dark:text-stone-100 dark:hover:bg-stone-700 focus-visible:ring-iris-500';
  }
});

const sizeClass = computed(() => {
  switch (props.size) {
    case 'sm':
      return 'h-8 px-2.5 text-xs';
    case 'lg':
      return 'h-10 px-4 text-sm';
    default:
      return 'h-9 px-3 text-sm';
  }
});
</script>
