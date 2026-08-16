import type { TimeWeather } from '@/types/api';
import { defineStore } from 'pinia';

const EMPTY_TIME_WEATHER = {
  season: 'SPRING',
  time_of_day: 'MORNING',
  weather: 'CLEAR',
};

export const useTimeWeatherStore = defineStore('timeWeather', {
  state: () => ({
    data: { ...EMPTY_TIME_WEATHER } as TimeWeather,
    saved: [] as TimeWeather[],
    loading: false as boolean,
  }),

  actions: {
    update(field: keyof TimeWeather, value: unknown) {
      (this.data as Record<string, unknown>)[field] = value;
    },

    async fetchSaved() {
      this.loading = true;
      try {
        const res = await $fetch<{ data: TimeWeather[] }>('/api/time-weather' as never, { credentials: 'include' });
        this.saved = res.data;
      } catch {
        useToast().error('Error al cargar tiempos');
      } finally {
        this.loading = false;
      }
    },

    async save(): Promise<TimeWeather | null> {
      const api = useApi();
      try {
        const result = await api.request<TimeWeather>('/api/time-weather', {
          method: 'POST',
          body: this.data,
        });
        this.saved.unshift(result);
        useToast().success('Tiempo guardado');
        return result;
      } catch {
        return null;
      }
    },

    async updateSaved(id: string): Promise<TimeWeather | null> {
      const api = useApi();
      try {
        const result = await api.request<TimeWeather>(`/api/time-weather/${id}`, {
          method: 'PUT',
          body: this.data,
        });
        const idx = this.saved.findIndex(t => t.id === id);
        if (idx >= 0) this.saved[idx] = result;
        useToast().success('Tiempo actualizado');
        return result;
      } catch {
        return null;
      }
    },

    async load(id: string) {
      const api = useApi();
      try {
        const result = await api.request<TimeWeather>(`/api/time-weather/${id}`);
        this.data = { ...result };
        useToast().info(`Cargado: ${result.season}, ${result.time_of_day}, ${result.weather}`);
      } catch {
        useToast().error('Error al cargar el tiempo');
      }
    },

    async remove(id: string) {
      const api = useApi();
      try {
        await api.request(`/api/time-weather/${id}`, { method: 'DELETE' });
        this.saved = this.saved.filter(t => t.id !== id);
        useToast().success('Tiempo eliminado');
      } catch {
        useToast().error('Error al eliminar');
      }
    },

    reset() {
      this.data = { ...EMPTY_TIME_WEATHER };
    },
  },
});