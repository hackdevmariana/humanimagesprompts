import type { H3Error } from 'h3';

export const useApi = () => {
  const toast = useToast();

  const request = async <T = unknown>(path: string, options: RequestOptions = {}): Promise<T> => {
    try {
      const url = path.startsWith('/api') ? path : `/api/${path.replace(/^\//, '')}`;
      const method = (options.method || 'GET').toUpperCase() as 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE';
      const body = options.body as BodyInit | Record<string, any> | null | undefined;
      const data = await $fetch<T>(url as never, {
        method,
        headers: {
          'Content-Type': 'application/json',
          ...options.headers,
        },
        body,
        credentials: 'include',
      });
      return data;
    } catch (error) {
      const e = error as H3Error;
      if (e.statusCode === 401) {
        const authStore = useAuthStore();
        authStore.setUnauthenticated();
        navigateTo('/login');
      }
      if (e.statusCode >= 400) {
        toast.error((e.data as any)?.error || e.message || 'Error de servidor');
      }
      throw error;
    }
  };

  return { request };
};

interface RequestOptions {
  method?: string;
  headers?: Record<string, string>;
  body?: unknown;
}
