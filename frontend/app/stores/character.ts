import type { Character } from '@/types/api';
import { defineStore } from 'pinia';

const EMPTY_CRANIAL = {
  cranial_shape: 'MESOCEPHALIC',
  facial_structure: 'OVAL',
  jawline_definition: 'SOFT',
  cheekbones: 'HIGH_PROMINENT',
  ear_morphology: 'ATTACHED_LOBE',
};

const EMPTY_SKIN = {
  fitzpatrick_scale: 'TYPE_II',
  undertone: 'NEUTRAL',
  finish: 'DEWY',
  imperfections: [],
  freckle_density: null,
};

const EMPTY_HAIR = {
  andre_walker_type: 'TYPE_2A',
  density: 'MEDIUM',
  porosity: 'MEDIUM',
  hairline: 'STRAIGHT',
};

const EMPTY_EYES = {
  primary_color: 'BROWN',
  secondary_color: null,
  heterochromia_type: 'NONE',
  eye_shape: 'ALMOND',
  eyelash_details: 'LONG_DENSE',
};

const EMPTY_GROOMING = {
  hairstyle_name: '',
  hair_length: 'MEDIUM',
  hair_color_primary: { color_name: 'Natural Brown', hex_code: '#8B4513' },
  hair_color_secondary: null,
  hair_finish: 'STYLED',
  facial_hair_style: 'CLEAN_SHAVEN',
  facial_hair_color: null,
};

const EMPTY_MAKEUP = {
  style_name: 'No-Makeup Natural Glow',
  lipstick: null,
  eyeshadow: null,
  eyeliner: null,
  blush_and_contour: null,
  nails: null,
};

export const useCharacterStore = defineStore('character', {
  state: () => ({
    data: {
      name: '',
      gender: 'FEMALE',
      age: 25,
      ethnicity: 'CAUCASIAN',
      is_public: false,
      cranial_morphology: { ...EMPTY_CRANIAL },
      skin_profile: { ...EMPTY_SKIN },
      hair_profile: { ...EMPTY_HAIR },
      eye_profile: { ...EMPTY_EYES },
      facial_features: {},
      current_grooming: { ...EMPTY_GROOMING },
      current_makeup: { ...EMPTY_MAKEUP },
    } as Character,
    saved: [] as Character[],
    loading: false as boolean,
  }),

  getters: {
    displayName: (state) => state.data.name || '(sin nombre)',
  },

  actions: {
    update(field: string, value: unknown) {
      const keys = field.split('.');
      let obj: any = this.data;
      for (let i = 0; i < keys.length - 1; i++) {
        const key = keys[i] as string;
        if (!obj[key]) obj[key] = {};
        obj = obj[key];
      }
      obj[keys[keys.length - 1] as string] = value;
    },

    setField(path: string[], value: unknown) {
      let obj: any = this.data;
      for (let i = 0; i < path.length - 1; i++) {
        const key = path[i] as string;
        if (!obj[key]) obj[key] = {};
        obj = obj[key];
      }
      obj[path[path.length - 1] as string] = value;
    },

    async fetchSaved() {
      this.loading = true;
      try {
        const res = await $fetch<{ data: Character[] }>('/api/characters' as never, { credentials: 'include' });
        this.saved = res.data;
      } catch {
        useToast().error('Error al cargar personajes');
      } finally {
        this.loading = false;
      }
    },

    async save(): Promise<Character | null> {
      const api = useApi();
      try {
        const result = await api.request<Character>('/api/characters', {
          method: 'POST',
          body: this.data,
        });
        this.saved.unshift(result);
        useToast().success('Personaje guardado');
        return result;
      } catch {
        return null;
      }
    },

    async updateSaved(id: string): Promise<Character | null> {
      const api = useApi();
      try {
        const result = await api.request<Character>(`/api/characters/${id}`, {
          method: 'PUT',
          body: this.data,
        });
        const idx = this.saved.findIndex(c => c.id === id);
        if (idx >= 0) this.saved[idx] = result;
        useToast().success('Personaje actualizado');
        return result;
      } catch {
        return null;
      }
    },

    async load(id: string) {
      const api = useApi();
      try {
        const result = await api.request<Character>(`/api/characters/${id}`);
        this.data = { ...result };
        useToast().info(`Cargado: ${result.name}`);
      } catch {
        useToast().error('Error al cargar el personaje');
      }
    },

    async remove(id: string) {
      const api = useApi();
      try {
        await api.request(`/api/characters/${id}`, { method: 'DELETE' });
        this.saved = this.saved.filter(c => c.id !== id);
        useToast().success('Personaje eliminado');
      } catch {
        useToast().error('Error al eliminar');
      }
    },

    reset() {
      this.data = {
        name: '',
        gender: 'FEMALE',
        age: 25,
        ethnicity: 'CAUCASIAN',
        is_public: false,
        cranial_morphology: { ...EMPTY_CRANIAL },
        skin_profile: { ...EMPTY_SKIN },
        hair_profile: { ...EMPTY_HAIR },
        eye_profile: { ...EMPTY_EYES },
        facial_features: {},
        current_grooming: { ...EMPTY_GROOMING },
        current_makeup: { ...EMPTY_MAKEUP },
      };
    },
  },
});
