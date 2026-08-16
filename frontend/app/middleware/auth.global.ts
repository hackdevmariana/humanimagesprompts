export default defineNuxtRouteMiddleware(async (to) => {
  const auth = useAuthStore();

  if (!auth.initialized) {
    await auth.fetchSession();
  }

  if (to.path === '/login') {
    if (auth.isAuthenticated) {
      return navigateTo('/dashboard');
    }
    return;
  }

  if (!auth.isAuthenticated) {
    return navigateTo('/login');
  }
});