<template>
  <div class="flex h-full flex-col overflow-hidden">
    <!-- Live Preview -->
    <div class="border-b border-stone-200 p-4 dark:border-stone-800">
      <h3 class="text-xs font-semibold uppercase tracking-wide text-stone-500">
        Vista Previa
      </h3>
      <div
        v-if="previewText"
        class="mt-2 max-h-40 overflow-y-auto rounded-md bg-stone-50 p-2 whitespace-pre-wrap text-xs leading-relaxed text-stone-600 dark:bg-stone-900 dark:text-stone-400"
      >
        {{ previewText }}
      </div>
      <div
        v-else
        class="mt-2 text-xs text-stone-400"
      >
        Activa bloques para ver la vista previa
      </div>
    </div>

    <!-- Compile Panel -->
    <div class="flex-1 space-y-3 overflow-y-auto p-4">
      <UiButton
        variant="primary"
        size="md"
        :disabled="compiling"
        class="w-full"
        @click="doCompile"
      >
        <span
          v-if="compiling"
          class="mr-2 h-3 w-3 animate-spin rounded-full border border-white border-t-transparent"
        ></span>
        {{ compiling ? 'Compilando…' : 'Compilar Prompt' }}
      </UiButton>

      <div v-if="compiledText" class="space-y-2">
        <textarea
          v-model="editedText"
          class="w-full min-h-32 resize-y rounded-md border border-stone-200 bg-white p-2 font-mono text-xs leading-relaxed text-stone-800 transition-colors focus:border-transparent focus:outline-none focus:ring-2 focus:ring-iris-500 dark:border-stone-800 dark:bg-stone-900 dark:text-stone-200"
          placeholder="Texto compilado del prompt..."
        />

        <UiButton
          variant="ghost"
          size="sm"
          class="w-full"
          @click="copyToClipboard"
        >
          <CopyIcon class="mr-1 h-4 w-4" />
          Copiar al portapapeles
        </UiButton>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';
import { PhCopy } from '@phosphor-icons/vue';

const CopyIcon = PhCopy;
const { compile, compiledText, result } = useCompile();
const dashboard = useDashboardStore();
const toast = useToast();

const compiling = ref(false);
const editedText = ref('');

const previewText = computed(() => {
  if (result.value) {
    return result.value.compiled_text;
  }
  return '';
});

function debounce<T extends (...args: any[]) => any>(fn: T, delay: number): T {
  let timeout: ReturnType<typeof setTimeout> | null = null;
  return ((...args: Parameters<T>) => {
    if (timeout) clearTimeout(timeout);
    timeout = setTimeout(() => fn(...args), delay);
  }) as T;
}

const debouncedCompile = debounce(async () => {
  if (dashboard.activeBlocks.length === 0) return;
  await compile();
}, 500);

watch(
  () => dashboard.activeBlocks,
  () => {
    void debouncedCompile();
  },
  { deep: true },
);

watch(compiledText, (newText) => {
  if (newText && !editedText.value) {
    editedText.value = newText;
  }
});

async function doCompile() {
  compiling.value = true;
  try {
    await compile();
    if (compiledText.value) {
      editedText.value = compiledText.value;
      toast.success('Prompt compilado');
    }
  } finally {
    compiling.value = false;
  }
}

function copyToClipboard() {
  if (editedText.value) {
    navigator.clipboard.writeText(editedText.value);
    toast.success('Copiado al portapapeles');
  }
}
</script>