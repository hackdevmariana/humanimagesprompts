## Context

**Estado actual:**
- Dashboard único en `/` (`pages/index.vue`) con `BlockSidebar` + `BlockEditor` + `RightPanel` (compile preview).
- Stores Pinia centralizados: `characterStore`, `outfitStore`, `poseStore`, `sceneStore`, `lightingStore`, `timeStore`, `dashboardStore`.
- `BlockSidebar` lista bloques con toggles; `BlockEditor` renderiza editor del bloque activo.
- `AdvancedPanel` (fase 1) como acordeón dentro de `BlockEditor`.
- `appliedOverrides` en `dashboardStore` sincroniza modificadores.
- Nuxt 4 con file-based routing en `pages/`.

## Goals / Non-Goals

**Goals:**
1. 6 rutas dedicadas: `/character`, `/outfit`, `/pose`, `/scene`, `/time`, `/lighting`.
2. Layout `AreaLayout.vue`: header con breadcrumb + título área, sidebar específica de la área (picker assets + ajustes), editor a pantalla completa + `AdvancedPanel` siempre visible (no colapsado).
3. Sincronización: stores Pinia son fuente única; rutas dedicadas leen/escriben mismos stores → reactividad automática.
4. Navegación: botón "Editar en profundidad" en cada bloque del `BlockSidebar` y `BlockEditor` → navega a ruta dedicada; breadcrumb "← Composer" vuelve a `/`.
5. Reutilización: mismos componentes `*Editor.vue`, `AdvancedPanel`, `GarmentPicker`, stores, `useCompile`.

**Non-Goals:**
- Estados de URL profundos (deep linking a pestañas internas).
- Permisos por área (single-user admin).
- Nuevos endpoints API.

## Decisions

### 1. File-based routing en `pages/`
**Estructura:**
```
pages/
  character.vue
  outfit.vue
  pose.vue
  scene.vue
  time.vue
  lighting.vue
  index.vue (dashboard/composer)
```
**Por qué:** Convención Nuxt 4, simple, sin configuración extra. Cada página importa `AreaLayout` y el editor correspondiente.

### 2. `AreaLayout.vue` componente de layout compartido
**Props:** `title`, `icon`, `blockKey`.
**Slots:** `sidebar` (picker/assets), `editor` (editor completo + AdvancedPanel).
**Por qué:** DRY — las 6 páginas comparten header, breadcrumb, estructura responsive. Sidebar específica por área (ej. `/outfit` muestra `GarmentPicker`; `/character` muestra search de characters).

### 3. Sincronización via stores Pinia (sin estado duplicado)
**Diseño:** Las rutas dedicadas NO tienen estado local; usan `useCharacterStore()`, `useOutfitStore()`, etc. directamente. `dashboardStore` sigue siendo fuente de `activeBlocks`, `uiOrder`, `appliedOverrides`, `targetModelHint`.
**Por qué:** Fuente única de verdad; reactividad automática; evita bugs de desync. `AdvancedPanel` lee/escribe `appliedOverrides` igual que en dashboard.

### 3. `BlockSidebar` y `BlockEditor` añaden navegación
- `BlockSidebar`: junto a cada toggle, botón "⤢" (expand) que navega a `/${blockKey}`.
- `BlockEditor`: header del editor incluye botón "Editar en profundidad" → `/${blockKey}`.
**Por qué:** Puntos de entrada naturales desde el flujo actual.

### 4. Breadcrumb y navegación de vuelta
- `AreaLayout` renderiza `<NuxtLink to="/">← Composer</NuxtLink>` + título área.
- Atajo teclado `Esc` o `Cmd/Ctrl+B` → navega a `/`.

## Risks / Trade-offs

| Riesgo | Mitigación |
|--------|------------|
| Duplicación visual dashboard vs rutas | Layout compartido + reutilización de editores minimiza código; dashboard sigue siendo vista "resumen". |
| Confusión de usuario: ¿dónde edito? | UX claro: dashboard = visión general + composición; ruta = profundidad en un área. Tooltip "Editar en profundidad" explica. |
| Estado `appliedOverrides` compartido → cambios en ruta afectan dashboard | Deseado (sincronización). Documentar en UX. |
| Responsive en móvil: layout dos columnas | `AreaLayout` usa CSS grid; en móvil sidebar colapsa en drawer (slide-over). |

## Migration Plan

1. Crear `AreaLayout.vue`, 6 páginas en `pages/`, actualizar `BlockSidebar`/`BlockEditor` con navegación.
2. Verificar `npx nuxi typecheck`.
3. Smoke manual: navegar dashboard → click "Editar en profundidad" en Outfit → `/outfit` abre con editor completo + AdvancedPanel visible → cambiar prenda → volver a `/` → outfit actualizado en dashboard → compilar → refleja cambios.

## Open Questions

1. ¿Ruta `/composer` como alias de `/` para breadcrumb consistente? (Sí, `definePageMeta({ alias: '/' })` en `index.vue`).
2. ¿Sidebar en `/outfit` incluye `GarmentPicker` integrado (no modal)? (Sí, espacio permite picker persistente lateral).