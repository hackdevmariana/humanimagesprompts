<template>
  <div class="flex flex-col gap-1.5">
    <label
      v-if="$slots.label || label"
      :for="inputId"
      class="text-xs font-medium text-stone-700 dark:text-stone-300"
    >
      <slot name="label">{{ label }}</slot>
      <span v-if="required" class="text-red-500">*</span>
    </label>
    <input
      :id="inputId"
      v-model="value"
      :type="type"
      :placeholder="placeholder"
      :disabled="disabled"
      :class="[
        'w-full rounded-md border bg-white dark:bg-stone-900 px-3 py-2 text-sm',
        'text-stone-900 dark:text-stone-100 placeholder-stone-400',
        'transition-colors duration-150',
        'focus:outline-none focus:ring-2 focus:ring-iris-500 focus:border-transparent',
        'focus-visible:ring-offset-1',
        'disabled:cursor-not-allowed disabled:opacity-50',
        errorClass,
      ]"
      @input="onInput"
    />
    <p
      v-if="error"
      class="text-xs text-red-600 dark:text-red-400"
    >
      {{ error }}
    </p>
    <p
      v-else-if="$slots.hint || hint"
      class="text-xs text-stone-500"
    >
      <slot name="hint">{{ hint }}</slot>
    </p>
  </div>
</template>

<script setup lang="ts">
const props = withDefaults(defineProps<{
  modelValue: string | number;
  label?: string;
  type?: 'text' | 'email' | 'password' | 'number';
  placeholder?: string;
  error?: string;
  hint?: string;
  required?: boolean;
  disabled?: boolean;
  inputId?: string;
}>(), {
  modelValue: '',
  label: '',
  type: 'text',
  placeholder: '',
  error: '',
  hint: '',
  required: false,
  disabled: false,
  inputId: '',
});

const emit = defineEmits<{
  (e: 'update:modelValue', v: string | number): void;
}>();

const value = computed({
  get: () => props.modelValue,
  set: (v: string | number) => emit('update:modelValue', v),
});

const errorClass = computed(() =>
  props.error
    ? 'border-red-500 focus:ring-red-500'
    : 'border-stone-300 dark:border-stone-700',
);

function onInput(e: Event) {
  const target = e.target as HTMLInputElement;
  if (props.type === 'number') {
    emit('update:modelValue', parseFloat(target.value));
  } else {
    emit('update:modelValue', target.value);
  }
}
</script>
