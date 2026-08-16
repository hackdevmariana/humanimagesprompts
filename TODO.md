# TODO — Frontend Modular Prompts

> Change: `openspec/changes/frontend-modular-prompts/`
> Specs: `section-prompt`, `block-reorder`, `random-block-load`

Orden de trabajo. Marco la casilla cuando esté hecho. Commits: uno por fichero.

## 1. Setup & dependencias
- [x] 1.1 Instalar `vue-draggable-next` en `frontend/` (commit: package.json)
- [x] 1.2 Añadir slice `uiOrder` a `useDashboardStore` + constante de orden canónico (character → pose → outfit → scene → lighting)

## 2. Generación aleatoria (frontend)
- [x] 2.1 Crear `useRandom.ts` — tablas de referencia estáticas por bloque (personaje, pose, escenario, iluminación; **sin outfit**)
- [x] 2.2 Implementar `randomize(blockKey)` que rellena el store con valores válidos y seleccionables en los desplegables
- [x] 2.3 Botón "Carga aleatoria" en el header de cada card soportada; Outfit sin este botón

## 3. Prompt por sección
- [x] 3.1 Crear `useSectionPrompt.ts` — envía payload de un solo bloque a `POST /api/compile` y devuelve `compiled_text`
- [x] 3.2 Botón "Crear prompt" por card + caja inline (mono) al pie de la card con botón de copiar
- [x] 3.3 Estado vacío cuando el bloque no tiene valores + toast al copiar

## 4. Drag & drop (reorden visual)
- [x] 4.1 Wrapper con `vue-draggable-next` usando handle de arrastre
- [x] 4.2 `dashboard.vue` renderiza las cards activas en orden `uiOrder` dentro del wrapper
- [x] 4.3 Sincronizar el reorden hacia `uiOrder`; el compile global sigue usando el orden canónico
- [x] 4.4 Estilo del handle (hover, cursor move, micro-motion iris); el drag no altera toggles ni datos

## 5. Verificación
- [x] 5.1 `npx nuxi typecheck` sin errores
- [x] 5.2 Smoke test Playwright: login → "Carga aleatoria" rellena personaje → "Crear prompt" muestra caja inline → copiar toastea → drag reordena visualmente → compile global mantiene orden canónico