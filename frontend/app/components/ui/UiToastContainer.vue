<template>
  <div
    v-if="toasts.length"
    class="fixed top-4 right-4 z-50 flex w-80 flex-col gap-2"
  >
    <transition-group
      name="toast"
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 translate-x-4"
      enter-to-class="opacity-100 translate-x-0"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100 translate-x-0"
      leave-to-class="opacity-0 translate-x-4"
      move-class="transition-all duration-200"
    >
      <div
        v-for="toast in toasts"
        :key="toast.id"
        :class="[
          'rounded-md p-3 text-sm shadow-lg flex items-start gap-2 border',
          toast.type === 'success' && 'bg-emerald-50 border-emerald-200 text-emerald-900 dark:bg-emerald-900/40 dark:border-emerald-800 dark:text-emerald-100',
          toast.type === 'error' && 'bg-rose-50 border-rose-200 text-rose-900 dark:bg-rose-900/40 dark:border-rose-800 dark:text-rose-100',
          toast.type === 'info' && 'bg-iris-50 border-iris-200 text-iris-900 dark:bg-iris-900/40 dark:border-iris-800 dark:text-iris-100',
        ]"
      >
        <component
          :is="iconFor(toast.type)"
          class="w-4 h-4 mt-0.25 shrink-0"
        />
        <span class="flex-1">{{ toast.message }}</span>
        <button
          @click="remove(toast.id)"
          :aria-label="`Cerrar notificación`"
          class="ml-auto text-xs opacity-60 hover:opacity-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-current rounded-sm"
        >
          ×
        </button>
      </div>
    </transition-group>
  </div>
</template>

<script setup lang="ts">
import { PhCheckCircle, PhXCircle, PhInfo } from '@phosphor-icons/vue';

const { toasts, remove } = useToast();

function iconFor(type: string) {
  switch (type) {
    case 'success': return PhCheckCircle;
    case 'error': return PhXCircle;
    default: return PhInfo;
  }
}
</script>
