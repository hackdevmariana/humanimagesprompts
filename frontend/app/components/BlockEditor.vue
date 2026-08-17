<template>
<div class="group relative rounded-lg border border-stone-200 bg-white shadow-card transition-shadow duration-150 hover:shadow-raised dark:border-stone-800 dark:bg-stone-900">
    <div class="drag-handle absolute right-2 top-2 z-10 flex cursor-move items-center p-1.5 text-stone-400 opacity-0 transition-opacity duration-150 group-hover:opacity-100 hover:text-iris-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-iris-500 rounded-md" title="Arrastrar para reordenar" aria-label="Arrastrar para reordenar">
      <GripIcon class="h-4 w-4" />
    </div>

    <UiAccordion
      :title="blockLabel"
      :default-open="true"
    >
      <div class="space-y-3 px-4 pb-4">
        <component
          :is="editorComponent"
          class="block"
        />

        <div class="flex flex-wrap gap-2 border-t border-stone-200 pt-3 dark:border-stone-800">
          <UiButton
            variant="primary"
            size="sm"
            @click="saveAsset"
          >
            <SaveIcon class="mr-1.5 h-3.5 w-3.5" />
            Guardar
          </UiButton>
          <UiButton
            variant="ghost"
            size="sm"
            @click="loadAsset"
          >
            <LoadIcon class="mr-1.5 h-3.5 w-3.5" />
            Cargar
          </UiButton>
          <UiButton
            variant="ghost"
            size="sm"
            :disabled="sectionLoading"
            @click="createSectionPrompt"
          >
            <span
              v-if="sectionLoading"
              class="mr-1.5 h-3 w-3 animate-spin rounded-full border border-stone-400 border-t-transparent"
            ></span>
            <TerminalIcon class="mr-1.5 h-3.5 w-3.5" />
            Crear prompt
          </UiButton>
          <UiButton
            v-if="supportsRandom"
            variant="ghost"
            size="sm"
            title="Rellenar con valores aleatorios"
            @click="randomizeBlock"
          >
            <DiceIcon class="mr-1.5 h-3.5 w-3.5" />
            Carga aleatoria
          </UiButton>
          <UiButton
            variant="ghost"
            size="sm"
            title="Editar en profundidad"
            @click="navigateToArea"
          >
            <ExpandIcon class="mr-1.5 h-3.5 w-3.5" />
            Editar en profundidad
          </UiButton>
        </div>

        <div
          v-if="sectionPromptText"
          class="space-y-2 rounded-md border border-iris-200 bg-iris-50/50 p-3 dark:border-iris-900 dark:bg-iris-950/40"
        >
          <div class="flex items-center justify-between">
            <span class="text-xs font-semibold uppercase tracking-wide text-iris-700 dark:text-iris-300">
              Prompt de {{ blockLabel }}
            </span>
            <UiButton
              variant="ghost"
              size="sm"
              @click="copySectionPrompt"
            >
              <CopyIcon class="mr-1.5 h-3.5 w-3.5" />
              Copiar
            </UiButton>
          </div>
          <pre class="max-h-56 overflow-y-auto whitespace-pre-wrap font-mono text-xs leading-relaxed text-stone-700 dark:text-stone-300">{{ sectionPromptText }}</pre>
        </div>

        <div
          v-else-if="sectionEmptyMessage"
          class="rounded-md border border-stone-200 bg-stone-50 px-3 py-2 text-xs text-stone-500 dark:border-stone-800 dark:bg-stone-900 dark:text-stone-400"
        >
          {{ sectionEmptyMessage }}
        </div>
      </div>
    </UiAccordion>
  </div>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { useRouter } from 'vue-router';
import {
  PhDiceFive,
  PhFloppyDisk,
  PhFolderOpen,
  PhCopy,
  PhTerminal,
  PhDotsSixVertical,
  PhArrowSquareOut,
} from '@phosphor-icons/vue';
import CharacterEditor from './editor/CharacterEditor.vue';
import PoseEditor from './editor/PoseEditor.vue';
import OutfitEditor from './editor/OutfitEditor.vue';
import SceneEditor from './editor/SceneEditor.vue';
import LightingEditor from './editor/LightingEditor.vue';
import TimeWeatherEditor from './editor/TimeWeatherEditor.vue';

const DiceIcon = PhDiceFive;
const SaveIcon = PhFloppyDisk;
const LoadIcon = PhFolderOpen;
const CopyIcon = PhCopy;
const TerminalIcon = PhTerminal;
const GripIcon = PhDotsSixVertical;
const ExpandIcon = PhArrowSquareOut;

const router = useRouter();

const props = withDefaults(defineProps<{
  blockKey: string;
}>(), {
  blockKey: 'character',
});

const dashboard = useDashboardStore();
const assetLibraryStore = useAssetLibraryStore();
const { randomize } = useRandom();
const sectionPrompt = useSectionPrompt();
const toast = useToast();

const sectionLoading = ref(false);
const sectionPromptText = ref('');
const sectionEmptyMessage = ref('');

const supportsRandom = computed(() => true);

function getStore() {
  switch (props.blockKey) {
    case 'character': return useCharacterStore();
    case 'pose': return usePoseStore();
    case 'outfit': return useOutfitStore();
    case 'scene': return useSceneStore();
    case 'lighting': return useLightingStore();
    case 'time': return useTimeStore();
    default: return null;
  }
}

const blockLabel = computed(() => {
  const labels: Record<string, string> = {
    character: 'Personaje',
    outfit: 'Outfit',
    pose: 'Pose',
    scene: 'Escenario',
    lighting: 'Iluminación',
    time: 'Tiempo',
  };
  return labels[props.blockKey] ?? props.blockKey;
});

const editorComponent = computed(() => {
  switch (props.blockKey) {
    case 'character': return CharacterEditor;
    case 'pose': return PoseEditor;
    case 'outfit': return OutfitEditor;
    case 'scene': return SceneEditor;
    case 'lighting': return LightingEditor;
    case 'time': return TimeWeatherEditor;
    default: return CharacterEditor;
  }
});

function saveAsset() {
  const store = getStore() as any;
  if (store?.save) {
    store.save();
  }
}

function loadAsset() {
  const store = getStore() as any;
  if (store?.fetchSaved) {
    store.fetchSaved();
  }
}

function randomizeBlock() {
  randomize(props.blockKey as any);
  toast.info(`${blockLabel.value}: valores aleatorios aplicados`);
}

async function createSectionPrompt() {
  sectionLoading.value = true;
  sectionEmptyMessage.value = '';
  sectionPromptText.value = '';
  try {
    const text = await sectionPrompt.generate(props.blockKey as any);
    if (text) {
      sectionPromptText.value = text;
    } else {
      sectionEmptyMessage.value = `${blockLabel.value} no tiene valores para compilar. Completa algún campo o usa "Carga aleatoria".`;
    }
  } finally {
    sectionLoading.value = false;
  }
}

function copySectionPrompt() {
  if (sectionPromptText.value) {
    navigator.clipboard.writeText(sectionPromptText.value);
    toast.success(`Prompt de ${blockLabel.value} copiado`);
  }
}

function navigateToArea() {
  router.push(`/${props.blockKey}`);
}
</script>