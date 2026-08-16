<template>
  <button
    :aria-checked="modelValue"
    role="switch"
    :class="[
      'relative inline-flex h-5 w-9 items-center rounded-full transition-colors duration-150 ease-out active:scale-[0.95]',
      'focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-iris-500 focus-visible:ring-offset-2',
      modelValue
        ? 'bg-iris-600'
        : 'bg-stone-300 dark:bg-stone-600',
      disabled && 'opacity-50 cursor-not-allowed',
    ]"
    @click="toggle"
  >
    <span
      :class="[
        'inline-block h-3.5 w-3.5 transform rounded-full bg-white transition-transform',
        modelValue ? 'translate-x-4' : 'translate-x-1',
      ]"
    />
  </button>
</template>

<script setup lang="ts">
const props = withDefaults(defineProps<{
  modelValue: boolean;
  disabled?: boolean;
}>(), {
  modelValue: false,
  disabled: false,
});

const emit = defineEmits<{
  (e: 'update:modelValue', v: boolean): void;
}>();

function toggle() {
  if (!props.disabled) {
    emit('update:modelValue', !props.modelValue);
  }
}
</script>
