import type { Scene } from '@/types/api';
import { defineStore } from 'pinia';

const EMPTY_SCENE = {
  title: '',
  environment_type: 'URBAN',
  location_details: '',
  camera_and_lens: {
    focal_length: 'LENS_85MM_PORTRAIT',
    aperture: 'F_1_8',
    depth_of_field: 'SHALLOW_BOKEH',
    film_grain: 'SUBTLE_35MM',
  },
  weather_and_atmosphere: {
    weather: 'CLEAR',
    time_of_day: 'DAY',
  },
  lighting_id: null,
};

export const useSceneStore = defineStore('scene', {
  state: () => ({
    data: { ...EMPTY_SCENE } as Scene,
    saved: [] as Scene[],
    loading: false as boolean,
  }),

  actions: {
    update(field: keyof Scene, value: unknown) {
      (this.data as Record<string, unknown>)[field] = value;
    },

    async fetchSaved() {
      this.loading = true;
      try {
        const res = await $fetch<{ data: Scene[] }>('/api/scenes' as never, { credentials: 'include' });
        this.saved = res.data;
      } catch {
        useToast().error('Error al cargar escenas');
      } finally {
        this.loading = false;
      }
    },

    async save(): Promise<Scene | null> {
      const api = useApi();
      try {
        const result = await api.request<Scene>('/api/scenes', {
          method: 'POST',
          body: this.data,
        });
        this.saved.unshift(result);
        useToast().success('Escena guardada');
        return result;
      } catch {
        return null;
      }
    },

    async updateSaved(id: string): Promise<Scene | null> {
      const api = useApi();
      try {
        const result = await api.request<Scene>(`/api/scenes/${id}`, {
          method: 'PUT',
          body: this.data,
        });
        const idx = this.saved.findIndex(s => s.id === id);
        if (idx >= 0) this.saved[idx] = result;
        useToast().success('Escena actualizada');
        return result;
      } catch {
        return null;
      }
    },

    async load(id: string) {
      const api = useApi();
      try {
        const result = await api.request<Scene>(`/api/scenes/${id}`);
        this.data = { ...result };
        useToast().info(`Cargado: ${result.title}`);
      } catch {
        useToast().error('Error al cargar la escena');
      }
    },

    async remove(id: string) {
      const api = useApi();
      try {
        await api.request(`/api/scenes/${id}`, { method: 'DELETE' });
        this.saved = this.saved.filter(s => s.id !== id);
        useToast().success('Escena eliminada');
      } catch {
        useToast().error('Error al eliminar');
      }
    },

    reset() {
      this.data = { ...EMPTY_SCENE };
    },
  },
});
