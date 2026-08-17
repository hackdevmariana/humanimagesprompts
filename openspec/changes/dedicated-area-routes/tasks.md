## 1. Frontend — Layout y rutas dedicadas

- [ ] 1.1 Crear `frontend/app/layouts/AreaLayout.vue`: header con breadcrumb "← Composer" + título/icono, slots `sidebar` y `editor`, responsive drawer en móvil
- [ ] 1.2 Crear `frontend/app/pages/character.vue` usando `AreaLayout` + `CharacterEditor` + `AdvancedPanel`
- [ ] 1.3 Crear `frontend/app/pages/outfit.vue` usando `AreaLayout` + `OutfitEditor` + `AdvancedPanel` + `GarmentPicker` en slot sidebar (versión integrada, no modal)
- [ ] 1.4 Crear `frontend/app/pages/pose.vue` usando `AreaLayout` + `PoseEditor` + `AdvancedPanel` + asset search en sidebar
- [ ] 1.5 Crear `frontend/app/pages/scene.vue` usando `AreaLayout` + `SceneEditor` + `AdvancedPanel` + asset search en sidebar
- [ ] 1.6 Crear `frontend/app/pages/time.vue` usando `AreaLayout` + `TimeWeatherEditor` + `AdvancedPanel` + asset search en sidebar
- [ ] 1.7 Crear `frontend/app/pages/lighting.vue` usando `AreaLayout` + `LightingEditor` + `AdvancedPanel` + asset search en sidebar
- [ ] 1.8 Añadir alias `/composer` a `pages/index.vue` (`definePageMeta({ alias: '/' })`) para breadcrumb consistente

## 2. Frontend — Navegación desde dashboard

- [ ] 2.1 `BlockSidebar.vue`: añadir botón expand (⤢) junto a cada toggle que navega a `/${blockKey}`
- [ ] 2.2 `BlockEditor.vue`: header con botón "Editar en profundidad" → navega a `/${blockKey}`
- [ ] 2.3 `AreaLayout.vue`: listener global `Esc` → `navigateTo('/')`

## 3. Frontend — Sincronización y AdvancedPanel persistente

- [ ] 3.1 Verificar que `AdvancedPanel` en rutas dedicadas usa mismo `dashboardStore.getModifiers/setModifiers` (ya reactivo)
- [ ] 3.2 En `AreaLayout`, `AdvancedPanel` siempre visible (no dentro de `UiAccordion`); prop `inline=true` para estilo sin acordeón
- [ ] 3.3 `GarmentPicker` versión integrada (no modal): componente `GarmentPickerInline.vue` para slot sidebar en `/outfit`

## 4. Frontend — Sidebar específica por área

- [ ] 4.1 `CharacterSidebar.vue`: asset search characters + lista guardados (reutiliza `assetLibraryStore`)
- [ ] 4.2 `PoseSidebar.vue`, `SceneSidebar.vue`, `TimeSidebar.vue`, `LightingSidebar.vue`: asset search correspondiente

## 5. Verificación

- [ ] 5.1 `npx nuxi typecheck` — sin errores
- [ ] 5.2 Smoke manual: login → `/` dashboard → click "Editar en profundidad" en Outfit → `/outfit` abre con editor completo + AdvancedPanel visible + GarmentPicker en sidebar → cambiar prenda en picker → volver a `/` → outfit actualizado en BlockEditor → compilar → refleja cambios → navegar `/character` → editar → volver → sincronizado