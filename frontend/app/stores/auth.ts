import { defineStore } from 'pinia';
import { navigateTo } from '#app';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as { email: string } | null,
    initialized: false,
  }),
  getters: {
    isAuthenticated: (state) => !!state.user,
  },
  actions: {
    setUser(user: { email: string }) {
      this.user = user;
      this.initialized = true;
    },
    setUnauthenticated() {
      this.user = null;
      this.initialized = true;
    },
    async login(email: string, password: string) {
      const res = await $fetch<{ logged_in: boolean; user: { email: string } }>('/api/login' as never, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password }),
        credentials: 'include',
      });

      this.setUser(res.user);
      return res;
    },
    async fetchSession() {
      if (this.initialized) return;
      try {
        const headers = import.meta.server
          ? useRequestHeaders(['cookie'])
          : undefined;
        const me = await $fetch<{ authenticated: boolean; user: { email: string } }>('/api/me' as never, {
          headers,
          credentials: 'include',
        });
        if (me.authenticated) {
          this.setUser(me.user);
        } else {
          this.initialized = true;
        }
      } catch {
        this.initialized = true;
      }
    },
    logout() {
      this.user = null;
      this.initialized = true;
      navigateTo('/login');
    },
  },
});
