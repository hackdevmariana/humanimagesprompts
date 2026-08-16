import type { PromptComposition } from '@/types/api';
import { defineStore } from 'pinia';

export type BlockKey = 'character' | 'pose' | 'outfit' | 'scene' | 'lighting';

export const useDashboardStore = defineStore('dashboard', {
  state: () => ({
    activeBlocks: ['character', 'outfit', 'pose', 'scene', 'lighting'] as BlockKey[],
    targetModelHint: 'FLUX_1_DEV' as string,
    currentCompositionId: null as string | null,
    appliedOverrides: [] as Array<{ target_path: string; overridden_value: unknown }>,
  }),

  getters: {
    isBlockActive: (state) => (key: BlockKey) => state.activeBlocks.includes(key),

    activeComposition: (state): PromptComposition => ({
      title: 'Composición activa',
      user_id: 'admin',
      status: 'DRAFT',
      target_model_hint: state.targetModelHint,
      applied_overrides: state.appliedOverrides,
      // Block IDs are resolved at compile time — the stores hold the data
      character_id: null,
      outfit_id: null,
      pose_id: null,
      scene_id: null,
    }),
  },

  actions: {
    toggleBlock(key: BlockKey) {
      const idx = this.activeBlocks.indexOf(key);
      if (idx >= 0) {
        this.activeBlocks.splice(idx, 1);
      } else {
        this.activeBlocks.push(key);
      }
    },

    setTargetModelHint(hint: string) {
      this.targetModelHint = hint;
    },

    setCompositionId(id: string | null) {
      this.currentCompositionId = id;
    },

    addOverride(targetPath: string, value: unknown) {
      this.appliedOverrides.push({ target_path: targetPath, overridden_value: value });
    },

    resetOverrides() {
      this.appliedOverrides = [];
    },
  },
});
