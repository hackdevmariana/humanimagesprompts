## Why

Los paneles "Avanzado" (fase 1) permiten edición fina dentro del dashboard, pero para trabajo profundo en un área (ej. construir un personaje complejo con 20+ parámetros, o un outfit con 6 capas y reglas de layering) la pantalla única se queda corta. Rutas dedicadas por área (`/character`, `/outfit`, `/pose`, `/scene`, `/time`, `/lighting`) dan espacio completo, layout optimizado y editores especializados, reutilizando los mismos stores, editores y paneles avanzados, sincronizados con la composición central.

## What Changes

- **Nuevas rutas** Nuxt: `/character`, `/outfit`, `/pose`, `/scene`, `/time`, `/lighting` (y opcional `/composer` como alias del dashboard).
- **Layout dedicado** por área: sidebar específica + editor a pantalla completa + panel avanzado siempre visible (no acordeón).
- **Sincronización bidireccional**: cambios en ruta dedicada actualizan stores centrales (`characterStore`, `outfitStore`, etc.) y `dashboard.appliedOverrides`; cambios en dashboard se reflejan en ruta dedicada (reactividad Pinia).
- **Navegación**: enlaces "Editar en profundidad" en cada bloque del dashboard y en `BlockSidebar`; breadcrumb para volver.
- **Reutilización**: mismos componentes `CharacterEditor`, `OutfitEditor`, `AdvancedPanel`, stores, `useCompile`.

## Capabilities

### New Capabilities
- `dedicated-area-routes`: Rutas completas por área con editors a pantalla completa, panel avanzado persistente, sincronizados con dashboard central.

### Modified Capabilities
- `frontend-shell` (spec existente): Añade nuevas rutas y layout dedicado (delta spec).
- `asset-library` (spec existente): Las rutas dedicadas incluyen picker de assets integrado (delta spec).

## Impact

- **Frontend**: `frontend/app/router/` (nuevas rutas), `pages/character.vue`, `pages/outfit.vue`, `pages/pose.vue`, `pages/scene.vue`, `pages/time.vue`, `pages/lighting.vue` (nuevas), `layouts/area.vue` (nuevo layout), `components/BlockSidebar.vue` (enlaces "Editar en profundidad"), `stores/dashboard.ts` (helpers de sync), `composables/useCompile.ts` (sin cambios).
- **Backend**: Sin cambios (usa misma API).