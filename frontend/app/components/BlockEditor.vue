<template>
  <div class="rounded-lg border border-stone-200 bg-white shadow-card transition-shadow duration-150 hover:shadow-raised dark:border-stone-800 dark:bg-stone-900">
    <UiAccordion
      :title="blockLabel"
      :default-open="true"
    >
      <div class="space-y-3 px-4 pb-4">
        <component
          :is="editorComponent"
          class="block"
        />

        <div class="flex gap-2 border-t border-stone-200 pt-3 dark:border-stone-800">
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
        </div>
      </div>
    </UiAccordion>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { PhFloppyDisk, PhFolderOpen } from '@phosphor-icons/vue';
import CharacterEditor from './editor/CharacterEditor.vue';
import PoseEditor from './editor/PoseEditor.vue';
import OutfitEditor from './editor/OutfitEditor.vue';
import SceneEditor from './editor/SceneEditor.vue';
import LightingEditor from './editor/LightingEditor.vue';

const SaveIcon = PhFloppyDisk;
const LoadIcon = PhFolderOpen;

const props = withDefaults(defineProps<{
  blockKey: string;
}>(), {
  blockKey: 'character',
});

const dashboard = useDashboardStore();
const assetLibraryStore = useAssetLibraryStore();

function getStore() {
  switch (props.blockKey) {
    case 'character': return useCharacterStore();
    case 'pose': return usePoseStore();
    case 'outfit': return useOutfitStore();
    case 'scene': return useSceneStore();
    case 'lighting': return useLightingStore();
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
</script>
