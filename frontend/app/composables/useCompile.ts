import type { CompileResult } from '@/types/api';
import type { BlockKey } from '@/stores/dashboard';

export const useCompile = () => {
  const dashboard = useDashboardStore();
  const character = useCharacterStore();
  const outfit = useOutfitStore();
  const pose = usePoseStore();
  const scene = useSceneStore();
  const lighting = useLightingStore();

  const building = ref(false);
  const result = ref<CompileResult | null>(null);

  const activeBlocksMap: Record<BlockKey, () => Record<string, unknown> | null> = {
    character: () => character.data as Record<string, unknown>,
    outfit: () => outfit.data as Record<string, unknown>,
    pose: () => pose.data as Record<string, unknown>,
    scene: () => scene.data as Record<string, unknown>,
    lighting: () => lighting.data as Record<string, unknown>,
  };

  function gatherComposition(): Record<string, unknown> {
    const composition: Record<string, unknown> = {};
    for (const key of dashboard.activeBlocks) {
      const fn = activeBlocksMap[key];
      if (fn) {
        composition[key] = fn();
      }
    }
    composition.applied_overrides = dashboard.appliedOverrides;
    return composition;
  }

  async function compile(): Promise<CompileResult | null> {
    building.value = true;
    try {
      const res = await $fetch<CompileResult>('/api/compile', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({
          composition: gatherComposition(),
          composition_id: dashboard.currentCompositionId,
          target_model_hint: dashboard.targetModelHint,
        }),
      });
      result.value = res;
      dashboard.setCompositionId(res.meta.composition_id);
      return res;
    } catch (e: any) {
      const toast = useToast();
      toast.error(e?.data?.error || 'Error al compilar el prompt');
      return null;
    } finally {
      building.value = false;
    }
  }

  const compiledText = computed(() => result.value?.compiled_text ?? '');

  return {
    building,
    result,
    compiledText,
    gatherComposition,
    compile,
  };
};
