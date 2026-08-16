import type { Pose } from '@/types/api';
import { defineStore } from 'pinia';

const EMPTY_POSE = {
  title: '',
  category: 'HIGH_FASHION',
  body_language: '',
  facial_expression: 'NEUTRAL',
  expression_intensity: 5,
  camera_angle: 'EYE_LEVEL',
  required_framing: 'MEDIUM_SHOT',
};

export const usePoseStore = defineStore('pose', {
  state: () => ({
    data: { ...EMPTY_POSE } as Pose,
    saved: [] as Pose[],
    loading: false as boolean,
  }),

  actions: {
    update(field: keyof Pose, value: unknown) {
      (this.data as Record<string, unknown>)[field] = value;
    },

    async fetchSaved() {
      this.loading = true;
      try {
        const res = await $fetch<{ data: Pose[] }>('/api/poses' as never, { credentials: 'include' });
        this.saved = res.data;
      } catch {
        useToast().error('Error al cargar poses');
      } finally {
        this.loading = false;
      }
    },

    async save(): Promise<Pose | null> {
      const api = useApi();
      try {
        const result = await api.request<Pose>('/api/poses', {
          method: 'POST',
          body: this.data,
        });
        this.saved.unshift(result);
        useToast().success('Pose guardada');
        return result;
      } catch {
        return null;
      }
    },

    async updateSaved(id: string): Promise<Pose | null> {
      const api = useApi();
      try {
        const result = await api.request<Pose>(`/api/poses/${id}`, {
          method: 'PUT',
          body: this.data,
        });
        const idx = this.saved.findIndex(p => p.id === id);
        if (idx >= 0) this.saved[idx] = result;
        useToast().success('Pose actualizada');
        return result;
      } catch {
        return null;
      }
    },

    async load(id: string) {
      const api = useApi();
      try {
        const result = await api.request<Pose>(`/api/poses/${id}`);
        this.data = { ...result };
        useToast().info(`Cargado: ${result.title}`);
      } catch {
        useToast().error('Error al cargar la pose');
      }
    },

    async remove(id: string) {
      const api = useApi();
      try {
        await api.request(`/api/poses/${id}`, { method: 'DELETE' });
        this.saved = this.saved.filter(p => p.id !== id);
        useToast().success('Pose eliminada');
      } catch {
        useToast().error('Error al eliminar');
      }
    },

    reset() {
      this.data = { ...EMPTY_POSE };
    },
  },
});
