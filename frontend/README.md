# HumanImagesPrompts — Frontend

This is the **Nuxt 4** frontend for the HumanImagesPrompts Engine.

## 📖 Main Documentation

**See the root [`README.md`](../README.md) for complete setup, API reference, and deployment guide.**

---

## Quick Start / Inicio Rápido

```bash
# Install dependencies
npm install

# Development server (port 3000, proxies /api to backend:8000)
npm run dev

# Type checking
npx nuxi typecheck

# Production build
npm run build

# Preview production build
npm run preview
```

## Key Files / Archivos Clave

| File | Purpose |
|------|---------|
| `nuxt.config.ts` | Nuxt config, API proxy, runtime config |
| `app/composables/useApi.ts` | Typed API client (session auth) |
| `app/stores/` | Pinia stores (characters, poses, outfits, scenes, lightings, time) |
| `app/components/` | Vue components (editors, sidebar, block editors) |
| `app/pages/` | Pages: login, dashboard, scene editor |

## Tech Stack / Pila Tecnológica

- **Nuxt 4** (Vue 3.5, SSR disabled → SPA)
- **Pinia** (state management)
- **Tailwind CSS 4** (styling)
- **TypeScript strict**
- **@phosphor-icons/vue** (icons)
- **vue-draggable-next** (drag & drop)

---

**Root docs:** [`../README.md`](../README.md) | **Domain docs:** [`../docs/domain/`](../docs/domain/)