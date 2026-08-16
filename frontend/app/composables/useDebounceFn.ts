export function useDebounceFn<T extends (...args: any[]) => any>(fn: T, delay: number): (...args: Parameters<T>) => void {
  let timeout: ReturnType<typeof setTimeout> | null = null;
  return (...args: Parameters<T>) => {
    if (timeout) clearTimeout(timeout);
    timeout = setTimeout(() => fn(...args), delay);
  };
}

export function useDebouncedRef<T>(initial: T, delay = 300): { value: Ref<T> } {
  const v = ref(initial) as Ref<T>;
  const debounced = ref(initial) as Ref<T>;
  let timeout: ReturnType<typeof setTimeout> | null = null;
  watch(v, () => {
    if (timeout) clearTimeout(timeout);
    timeout = setTimeout(() => {
      debounced.value = v.value;
    }, delay);
  });
  return { value: debounced };
}
