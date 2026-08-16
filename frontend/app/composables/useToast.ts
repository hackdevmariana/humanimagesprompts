export interface Toast {
  id: number;
  message: string;
  type: 'success' | 'error' | 'info';
}

export const useToast = () => {
  const toasts = ref<Toast[]>([]);

  const push = (toast: Omit<Toast, 'id'>, duration = 4000) => {
    const id = Date.now();
    toasts.value.push({ id, ...toast });
    if (duration > 0) {
      setTimeout(() => remove(id), duration);
    }
    return id;
  };

  const remove = (id: number) => {
    toasts.value = toasts.value.filter(t => t.id !== id);
  };

  const toast = {
    success: (message: string, duration?: number) => push({ message, type: 'success' }, duration),
    error: (message: string, duration?: number) => push({ message, type: 'error' }, duration),
    info: (message: string, duration?: number) => push({ message, type: 'info' }, duration),
  };

  return { toasts: readonly(toasts), push, remove, success: toast.success, error: toast.error, info: toast.info };
};
