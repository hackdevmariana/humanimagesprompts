import type { GarmentSlot, Outfit } from '@/types/api';
import { defineStore } from 'pinia';

const EMPTY_GARMENT = {
  name: '',
  category: 'TOP',
  sub_category: '',
  fit: 'REGULAR',
  fabric: {
    material: 'COTTON',
    weave: 'KNITTED',
    weight: 'LIGHTWEIGHT',
    sheerness: 'OPAQUE',
  },
  primary_color: { color_name: 'White', hex_code: '#FFFFFF' },
  secondary_color: null,
  pattern: 'SOLID',
  tags: [],
};

const EMPTY_OUTFIT = {
  name: '',
  style_category: 'CASUAL',
  is_public: false,
  garments: [] as GarmentSlot[],
};

export const useOutfitStore = defineStore('outfit', {
  state: () => ({
    data: { ...EMPTY_OUTFIT } as Outfit,
    saved: [] as Outfit[],
    loading: false as boolean,
  }),

  getters: {
    garmentSlots: (state) => {
      const slots: Record<string, unknown | null> = {
        BASE_LAYER: null,
        MID_LAYER: null,
        OUTER_LAYER: null,
        FOOTWEAR: null,
        HEADWEAR: null,
        ACCESSORIES: null,
      };
      for (const gs of (state.data.garments || [])) {
        slots[gs.slot_type] = gs.garment;
      }
      return slots;
    },
  },

  actions: {
    update(field: keyof Outfit, value: unknown) {
      (this.data as Record<string, unknown>)[field] = value;
    },

    setGarment(slotType: string, garment: Record<string, unknown> | null) {
      if (!this.data.garments) this.data.garments = [];
      const idx = this.data.garments.findIndex(gs => gs.slot_type === slotType);
      if (garment === null) {
        if (idx >= 0) this.data.garments.splice(idx, 1);
      } else {
        const slot: GarmentSlot = {
          slot_type: slotType,
          garment: garment as unknown as GarmentSlot['garment'],
        };
        if (idx >= 0) {
          this.data.garments[idx] = slot;
        } else {
          this.data.garments.push(slot);
        }
      }
    },

    async fetchSaved() {
      this.loading = true;
      try {
        const res = await $fetch<{ data: Outfit[] }>('/api/outfits' as never, { credentials: 'include' });
        this.saved = res.data;
      } catch {
        useToast().error('Error al cargar outfits');
      } finally {
        this.loading = false;
      }
    },

    async save(): Promise<Outfit | null> {
      const api = useApi();
      try {
        const result = await api.request<Outfit>('/api/outfits', {
          method: 'POST',
          body: this.data,
        });
        this.saved.unshift(result);
        useToast().success('Outfit guardado');
        return result;
      } catch {
        return null;
      }
    },

    async updateSaved(id: string): Promise<Outfit | null> {
      const api = useApi();
      try {
        const result = await api.request<Outfit>(`/api/outfits/${id}`, {
          method: 'PUT',
          body: this.data,
        });
        const idx = this.saved.findIndex(o => o.id === id);
        if (idx >= 0) this.saved[idx] = result;
        useToast().success('Outfit actualizado');
        return result;
      } catch {
        return null;
      }
    },

    async load(id: string) {
      const api = useApi();
      try {
        const result = await api.request<Outfit>(`/api/outfits/${id}`);
        this.data = { ...result, garments: result.garments || [] };
        useToast().info(`Cargado: ${result.name}`);
      } catch {
        useToast().error('Error al cargar el outfit');
      }
    },

    async remove(id: string) {
      const api = useApi();
      try {
        await api.request(`/api/outfits/${id}`, { method: 'DELETE' });
        this.saved = this.saved.filter(o => o.id !== id);
        useToast().success('Outfit eliminado');
      } catch {
        useToast().error('Error al eliminar');
      }
    },

    reset() {
      this.data = { ...EMPTY_OUTFIT };
    },
  },
});

export const useGarmentStore = defineStore('garment', {
  state: () => ({
    templates: [] as Array<Record<string, unknown>>,
  }),
  actions: {
    addTemplate(garment: Record<string, unknown>) {
      this.templates.push({ ...EMPTY_GARMENT, ...garment });
    },
  },
});
