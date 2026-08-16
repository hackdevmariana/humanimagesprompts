import type { SearchResult } from '@/types/api';
import { defineStore } from 'pinia';

export const useAssetLibraryStore = defineStore('assetLibrary', {
  state: () => ({
    searchResults: [] as SearchResult[],
    searchQuery: '' as string,
    searching: false as boolean,
  }),

  getters: {
    filteredResults: (state) => {
      if (!state.searchQuery) return state.searchResults;
      const q = state.searchQuery.toLowerCase();
      return state.searchResults.filter(r =>
        r.label.toLowerCase().includes(q) || r.type.toLowerCase().includes(q),
      );
    },
  },

  actions: {
    async search(query: string) {
      this.searchQuery = query;
      if (!query) {
        this.searchResults = [];
        return;
      }
      this.searching = true;
      try {
        const res = await $fetch<{ results: SearchResult[]; count: number }>(
          `/api/assets/search?q=${encodeURIComponent(query)}`,
          { credentials: 'include' },
        );
        this.searchResults = res.results;
      } catch {
        useToast().error('Error en la búsqueda');
      } finally {
        this.searching = false;
      }
    },

    async loadIntoStore(type: string): Promise<void> {
      switch (type) {
        case 'character':
          await useCharacterStore().fetchSaved();
          break;
        case 'pose':
          await usePoseStore().fetchSaved();
          break;
        case 'outfit':
          await useOutfitStore().fetchSaved();
          break;
        case 'scene':
          await useSceneStore().fetchSaved();
          break;
        case 'lighting':
          await useLightingStore().fetchSaved();
          break;
      }
    },

    clearSearch() {
      this.searchQuery = '';
      this.searchResults = [];
    },
  },
});
