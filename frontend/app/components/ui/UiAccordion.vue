<template>
  <div class="border-b border-stone-200 dark:border-stone-800">
    <button
      type="button"
      :aria-expanded="isOpen"
      class="flex w-full items-center justify-between py-3 text-left transition-colors duration-150 hover:bg-stone-50 dark:hover:bg-stone-900/50 rounded-md px-2 -mx-1 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-iris-500 active:scale-[0.99]"
      @click="isOpen = !isOpen"
    >
      <span class="font-medium text-stone-900 dark:text-stone-100">{{ title }}</span>
      <component
        :is="ChevronDownIcon"
        class="h-4 w-4 text-stone-500 transition-transform duration-200 ease-out"
        :class="isOpen && 'rotate-180'"
      />
    </button>
    <transition
      enter-active-class="transition-all duration-200 ease-out"
      enter-from-class="max-h-0 opacity-0"
      enter-to-class="max-h-96 opacity-100"
      leave-active-class="transition-all duration-150 ease-in"
      leave-from-class="max-h-96 opacity-100"
      leave-to-class="max-h-0 opacity-0"
    >
      <div v-if="isOpen" class="overflow-hidden px-2 pb-3">
        <slot />
      </div>
    </transition>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { PhCaretDown } from '@phosphor-icons/vue';

const ChevronDownIcon = PhCaretDown;

const props = withDefaults(defineProps<{
  title: string;
  defaultOpen?: boolean;
}>(), {
  defaultOpen: false,
});

const isOpen = ref(props.defaultOpen);
</script>
