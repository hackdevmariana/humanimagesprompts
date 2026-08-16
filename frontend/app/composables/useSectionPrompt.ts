import type { CompileResult } from '@/types/api';
import type { BlockKey } from '@/stores/dashboard';

export const useSectionPrompt = () => {
  const dashboard = useDashboardStore();

  const blockData = (blockKey: BlockKey): Record<string, unknown> | null => {
    switch (blockKey) {
      case 'character': return useCharacterStore().data as unknown as Record<string, unknown>;
      case 'pose': return usePoseStore().data as unknown as Record<string, unknown>;
      case 'outfit': return useOutfitStore().data as unknown as Record<string, unknown>;
      case 'scene': return useSceneStore().data as unknown as Record<string, unknown>;
      case 'lighting': return useLightingStore().data as unknown as Record<string, unknown>;
      default: return null;
    }
  };

  function isEmpty(blockKey: BlockKey): boolean {
    const data = blockData(blockKey);
    if (!data) return true;
    switch (blockKey) {
      case 'character':
        return !(data.name as string)?.trim();
      case 'pose':
        return !(data.title as string)?.trim() && !(data.body_language as string)?.trim();
      case 'scene':
        return !(data.title as string)?.trim() && !(data.location_details as string)?.trim();
      default:
        return false;
    }
  }

  async function generate(blockKey: BlockKey): Promise<string | null> {
    if (isEmpty(blockKey)) return null;
    const composition: Record<string, unknown> = {};
    const data = blockData(blockKey);
    if (data) {
      composition[blockKey] = data;
    }
    try {
      const res = await $fetch<CompileResult>('/api/compile', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({
          composition,
          composition_id: dashboard.currentCompositionId,
          target_model_hint: dashboard.targetModelHint,
        }),
      });
      return res.compiled_text;
    } catch (e: any) {
      useToast().error(e?.data?.error || 'Error al generar el prompt de la sección');
      return null;
    }
  }

  return { isEmpty, generate };
};