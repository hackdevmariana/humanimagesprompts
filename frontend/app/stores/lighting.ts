import type { Lighting } from '@/types/api';
import { defineStore } from 'pinia';

const EMPTY_LIGHTING = {
  setup_type: 'GOLDEN_HOUR',
  color_temperature: 'WARM_2700K',
  key_light_direction: 'SIDE_45',
  hardness: 'SOFT_DIFFUSED',
  modifiers: {},
};

export const useLightingStore = defineStore('lighting', {
  state: () => ({
    data: { ...EMPTY_LIGHTING } as Lighting,
    saved: [] as Lighting[],
    loading: false as boolean,
  }),

  actions: {
    update(field: keyof Lighting, value: unknown) {
      (this.data as Record<string, unknown>)[field] = value;
    },

    async fetchSaved() {
      this.loading = true;
      try {
        const res = await $fetch<{ data: Lighting[] }>('/api/lightings' as never, { credentials: 'include' });
        this.saved = res.data;
      } catch {
        useToast().error('Error al cargar iluminaciones');
      } finally {
        this.loading = false;
      }
    },

    async save(): Promise<Lighting | null> {
      const api = useApi();
      try {
        const result = await api.request<Lighting>('/api/lightings', {
          method: 'POST',
          body: this.data,
        });
        this.saved.unshift(result);
        useToast().success('Iluminación guardada');
        return result;
      } catch {
        return null;
      }
    },

    async updateSaved(id: string): Promise<Lighting | null> {
      const api = useApi();
      try {
        const result = await api.request<Lighting>(`/api/lightings/${id}`, {
          method: 'PUT',
          body: this.data,
        });
        const idx = this.saved.findIndex(l => l.id === id);
        if (idx >= 0) this.saved[idx] = result;
        useToast().success('Iluminación actualizada');
        return result;
      } catch {
        return null;
      }
    },

    async load(id: string) {
      const api = useApi();
      try {
        const result = await api.request<Lighting>(`/api/lightings/${id}`);
        this.data = { ...result };
        useToast().info(`Cargado: ${result.setup_type}`);
      } catch {
        useToast().error('Error al cargar la iluminación');
      }
    },

    async remove(id: string) {
      const api = useApi();
      try {
        await api.request(`/api/lightings/${id}`, { method: 'DELETE' });
        this.saved = this.saved.filter(l => l.id !== id);
        useToast().success('Iluminación eliminada');
      } catch {
        useToast().error('Error al eliminar');
      }
    },

    reset() {
      this.data = { ...EMPTY_LIGHTING };
    },
  },
});
