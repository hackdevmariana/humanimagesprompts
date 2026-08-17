import type { Garment } from '@/types/api';
import { defineStore } from 'pinia';

export const useGarmentStore = defineStore('garment', {
  state: () => ({
    catalog: [] as Garment[],
    loading: false as boolean,
    error: null as string | null,
  }),

  getters: {
    bySlot: (state) => (slotType: string) => {
      const slotToCategory: Record<string, string[]> = {
        BASE_LAYER: ['TOP', 'BOTTOM', 'FULL_BODY'],
        MID_LAYER: ['TOP'],
        OUTER_LAYER: ['TOP'],
        FOOTWEAR: ['FOOTWEAR'],
        HEADWEAR: ['HEADWEAR'],
        ACCESSORY: ['ACCESSORY'],
      };
      const categories = slotToCategory[slotType] || [];
      return state.catalog.filter((g) => categories.includes(g.category));
    },

    filteredByTags: (state) => (tags: string[]) => {
      if (!tags.length) return state.catalog;
      return state.catalog.filter((g) =>
        tags.every((tag) => g.tags?.includes(tag))
      );
    },

    search: (state) => (query: string) => {
      if (!query) return state.catalog;
      const q = query.toLowerCase();
      return state.catalog.filter(
        (g) =>
          g.name.toLowerCase().includes(q) ||
          g.sub_category.toLowerCase().includes(q) ||
          g.tags?.some((t) => t.toLowerCase().includes(q))
      );
    },
  },

  actions: {
    async fetchAll(): Promise<void> {
      if (this.catalog.length > 0) return;
      this.loading = true;
      this.error = null;
      try {
        const res = await $fetch<{ data: Garment[] }>('/api/garments', {
          credentials: 'include',
        });
        this.catalog = res.data;
      } catch (e: any) {
        this.error = e?.data?.error || 'Error al cargar catálogo de prendas';
        console.error('fetchAll garments error:', e);
      } finally {
        this.loading = false;
      }
    },

    getById(id: string): Garment | undefined {
      return this.catalog.find((g) => g.id === id);
    },

    clearError() {
      this.error = null;
    },
  },
});