# TODO — Frontend Time-Weather Block

> Change: `openspec/changes/frontend-time-weather-block/`
> Specs: `time-weather-block`, `prompt-builder` (delta), `asset-library` (delta)

Orden de trabajo. Marco la casilla cuando esté hecho. Commits: uno por fichero.

## 1. Backend — entidad y persistencia
- [x] 1.1 Crear entidad `TimeWeather` en `backend/src/Entity/` (season, time_of_day, weather + UuidIdentity)
- [x] 1.2 Migración `time_weather` (commit: migration)
- [x] 1.3 `TimeWeatherController` con `AssetCrudTrait` (`/api/time-weather`) (commit: controller)
- [x] 1.4 Fixture de ejemplo de `TimeWeather` (commit: fixtures)
- [x] 1.5 `PromptCompiler`: añadir `time` a `normalizeCanonical`/`buildText` + `timeText()` (commit: PromptCompiler)
- [x] 1.6 Mapeos EN en `PromptCompiler::label()` (estaciones, horas, condiciones del día)

## 2. Frontend — tipos, store y editor
- [x] 2.1 Interface `TimeWeather` en `types/api.ts` (commit: types)
- [x] 2.2 Store `stores/time.ts` (patrón lighting.ts, endpoint `/api/time-weather`) (commit: store)
- [x] 2.3 `editor/TimeWeatherEditor.vue` con los 3 selects (Estación, Hora del día, El día) (commit: editor)

## 3. Frontend — registro del bloque
- [x] 3.1 Registrar `time` en `stores/dashboard.ts`: `BlockKey`, orden canónico `character → pose → outfit → scene → time → lighting`, activeBlocks/uiOrder (commit: dashboard store)
- [x] 3.2 Entrada "Tiempo" + icono en `BlockSidebar.vue` (commit: sidebar)
- [x] 3.3 Casos `time` en `BlockEditor.vue` (getStore, label, component) (commit: BlockEditor)
- [x] 3.4 `time` en `useCompile.ts` (activeBlocksMap) (commit: useCompile)
- [x] 3.5 `time` en `useSectionPrompt.ts` (blockData/isEmpty) (commit: useSectionPrompt)
- [x] 3.6 Tablas de referencia + `randomTime()` en `useRandom.ts` (commit: useRandom)

## 4. Frontend — limpieza del clima en Escenario
- [x] 4.1 Eliminar acordeón "Clima y atmósfera" de `SceneEditor.vue` (commit: SceneEditor)
- [x] 4.2 Quitar `weather_and_atmosphere` de `EMPTY_SCENE` y de `randomScene()` (commit: scene cleanup)

## 5. Verificación
- [x] 5.1 Migración + fixtures (`doctrine:migrations:migrate` + `doctrine:fixtures:load`) sin errores
- [x] 5.2 `php bin/phpunit` en verde (CRUD TimeWeather + compilación `time`)
- [x] 5.3 `npx nuxi typecheck` sin errores
- [x] 5.4 Smoke test Playwright: login → activar Tiempo → "Carga aleatoria" rellena 3 campos → "Crear prompt" caja inline → copiar toastea → Guardar/Cargar asset → compile global incluye Tiempo tras Escenario y excluye clima de Escenario

## 6. Documentación
- [x] 6.1 Crear `README.md` bilingüe (ES/EN) en raíz: intro, stack, requisitos, setup dev, API, compilación, tests, despliegue prod, docs, OpenSpec, estructura
- [x] 6.2 Reemplazar `frontend/README.md` por guía breve apuntando a raíz

---

# TODO — Garment Catalog & Outfit Generator

> Change: `openspec/changes/garment-catalog/`
> Specs: `garment-catalog`, `outfit-generator`, `asset-library` (delta), `prompt-compiler` (delta)

## 1. Backend — Entidad, Migración y Controlador Garment
- [ ] 1.1 Añadir columna `label` (string, nullable) a `Garment` + generar migración
- [ ] 1.2 Crear `GarmentController` en `backend/src/Controller/Api/` reutilizando `AssetCrudTrait` con `entityClass()`, `requiredField()`, `toArray()`, `fill()`
- [ ] 1.3 Registrar rutas `/api/garments` (GET list, GET show, POST create, PUT update, DELETE delete) en `GarmentController`
- [ ] 1.4 Test: `php bin/phpunit` cubre CRUD Garment (list, show, create, update, delete, 404, auth)

## 2. Backend — Fix OutfitController para prendas
- [ ] 2.1 Modificar `OutfitController::fill()`: procesar `garments[]` aceptando objeto inline `{slot_type, garment:{...}}` o referencia `{slot_type, garment_id}`
- [ ] 2.2 Modificar `OutfitController::toArray()`: devolver `garments[]` expandido con `slot_type` y objeto `garment` completo
- [ ] 2.3 Test: `php bin/phpunit` cubre round-trip Outfit con prendas inline y con `garment_id` (create, show, update)

## 3. Backend — Alineación de enums y taxonomía de tags
- [ ] 3.1 Documentar taxonomía de tags en `docs/domain/garment-tags.md` (namespaces: gender, season, weather, occasion, environment + valores canónicos)
- [ ] 3.2 Añadir validación suave en `GarmentController::fill()` y `OutfitController::fill()`: log warning si tags no siguen convención namespaced
- [ ] 3.3 Test: validación de tags en fixtures/seeder

## 4. Backend — PromptCompiler fix y labels EN
- [ ] 4.1 Modificar `PromptCompiler::normalizeCanonical()` o `outfitText()` para detectar `garments[]` y mapear `slot_type` → layer label
- [ ] 4.2 `outfitText()` renderiza por prenda: material, peso, nombre (usa `Garment.label` si existe, sino `name`), color, patrón, fit — todo con `label()` EN
- [ ] 4.3 Ampliar mapa `label()` con valores EN para `subCategory` comunes (T-Shirt, Denim Jacket, Jeans, Blazer, Dress, etc.)
- [ ] 4.4 Test: `PromptCompilerTest` cubre outfit con múltiples prendas, uso de `label`, fallback a `name`

## 5. Backend — Seeder exhaustivo del documento Ropa
- [ ] 5.1 Crear estructura `backend/src/DataFixtures/catalog/` con un fichero por sección: `pants.php`, `jackets.php`, `shirts.php`, `skirts.php`, `tshirts.php`, `dresses.php`, `headwear.php`, `jewelry.php`, `lingerie.php`, `footwear.php`, `accessories.php`
- [ ] 5.2 Cada fichero devuelve array de definiciones base `{ base: {name, category, sub_category, fit, fabric, primary_color, pattern, tags}, colors: [{name, hex}], fabrics: [{material, weave, weight, sheerness}] }`
- [ ] 5.3 Crear `GarmentCatalogFixtures.php` que itera catálogo, expande × colores × tejidos, crea `Garment` con tags correctos, y crea ~30-40 `Outfit` de ejemplo combinando prendas coherentes
- [ ] 5.4 Ejecutar `php bin/console doctrine:fixtures:load` y verificar ≥500 prendas + ≥30 outfits

## 6. Frontend — Tipos y enums alineados
- [ ] 6.1 Actualizar `frontend/app/types/api.ts`: `GarmentCategoryEnum`, `GarmentFitEnum`, `OutfitStyleEnum` para coincidir exactamente con backend
- [ ] 6.2 Actualizar `GarmentEditor.vue`: `categoryOptions`, `fitOptions` alineados a enums backend
- [ ] 6.3 Actualizar `OutfitEditor.vue`: `styleOptions` alineado a enum backend
- [ ] 6.4 Test: `npx nuxi typecheck` pasa sin errores

## 7. Frontend — Garment Store real y filtros
- [ ] 7.1 Crear `frontend/app/stores/garment.ts` con `useGarmentStore`: `fetchAll()`, `getBySlot(slotType)`, `filterByTags(tags)`, `search(query)`, caché en memoria
- [ ] 7.2 Integrar en `OutfitEditor`: inyección del store para picker

## 8. Frontend — GarmentPicker modal
- [ ] 8.1 Crear `frontend/app/components/editor/GarmentPicker.vue`: modal con pestañas por slot (`BASE_LAYER`...`ACCESSORIES`), listado filtrado por tags (gender, occasion, weather, season, environment), búsqueda, selección
- [ ] 8.2 Estilo: responsive, bottom-sheet en móvil, accesible (focus trap, ESC para cerrar)
- [ ] 8.3 Integrar en `OutfitEditor`: botón "Catálogo" por slot que abre picker; al seleccionar llama `outfit.setGarment(slot, garment)`

## 9. Frontend — Generador de outfits contextual (useRandom)
- [ ] 9.1 Añadir lógica pura `generateOutfit(candidatesBySlot, contextTags)` exportable en `useRandom.ts` (o fichero separado `outfitGenerator.ts`)
- [ ] 9.2 Implementar `randomOutfit()` en `useRandom`: lee `characterStore.data.gender`, `timeStore.data` (season, weather, time_of_day), `sceneStore.data.environment_type` → deriva tags contexto
- [ ] 9.3 Filtrado por tags AND; fallback si vacío; reglas layering (FULL_BODY exclusivo en base, una prenda/slot, sin duplicados)
- [ ] 9.4 Asigna `style_category` coherente con tags `occasion` predominantes
- [ ] 9.5 Test unitario: `generateOutfit` con mocks cumple reglas; typecheck pasa

## 10. Verificación end-to-end
- [ ] 10.1 `php bin/phpunit` — todos los tests backend pasan (incluye nuevos CRUD Garment, Outfit con prendas, PromptCompiler)
- [ ] 10.2 `npx nuxi typecheck` — sin errores
- [ ] 10.3 Smoke manual: login → dashboard → activar Outfit → "Carga aleatoria" genera outfit coherente con personaje/tiempo/escena → "Crear prompt" incluye detalle de prendas en inglés → guardar outfit → recargar → prendas persisten

---

# TODO — Advanced Section Panels (Fase 1)

> Change: `openspec/changes/advanced-section-panels/`
> Specs: `advanced-section-panels`, `prompt-builder` (delta), `prompt-compiler` (delta)

## 1. Backend — PromptCompiler extiende para prompt_modifiers
- [ ] 1.1 Añadir tipo `PromptModifier` en `backend/src/Service/PromptCompiler.php` (docblock o clase interna)
- [ ] 1.2 Modificar `PromptCompiler::buildText()`: detectar `canonical[block].prompt_modifiers[]` y aplicar antes de renderizar sección
- [ ] 1.3 Implementar `applyWeightModifier(token, weight, targetMotor)` → `(token:weight)` para Flux/SDXL, `token::weight` para Midjourney
- [ ] 1.4 Implementar `applyConditionalModifier(token, options)` → `[opt1|opt2|...]`
- [ ] 1.5 Implementar `applyTagModifier(sectionText, tagValue)` → append `, {tagValue}`
- [ ] 1.6 Test: `PromptCompilerTest` cubre pesos, condicionales, tags por motor (Flux, Midjourney, SDXL)

## 2. Frontend — Tipos y helpers
- [ ] 2.1 Añadir `PromptModifier` type en `frontend/app/types/api.ts` (union discriminada weight|conditional|tag)
- [ ] 2.2 Añadir helpers en `dashboardStore`: `getModifiers(blockKey)`, `setModifiers(blockKey, modifiers[])` que leen/escriben `appliedOverrides` con `target_path: '{blockKey}.prompt_modifiers'`
- [ ] 2.3 Test: `npx nuxi typecheck` pasa

## 3. Frontend — AdvancedPanel component
- [ ] 3.1 Crear `frontend/app/components/editor/AdvancedPanel.vue`: props `blockKey`, `modifiers` (array), emits `update:modifiers`
- [ ] 3.2 UI: sección "Tags" (chips editables, añadir/eliminar), sección "Modificadores" (lista con selector tipo, inputs target/value/weight, botón eliminar)
- [ ] 3.3 Accesibilidad: focus trap en acordeón, ESC cierra, ARIA en botones
- [ ] 3.4 Responsive: en móvil, panel como bottom-sheet slide-up

## 4. Frontend — Integración en BlockEditor
- [ ] 4.1 Importar `AdvancedPanel` en `BlockEditor.vue`
- [ ] 4.2 Renderizar `<UiAccordion title="Avanzado" :default-open="false"><AdvancedPanel :blockKey="block.key" :modifiers="modifiers" @update:modifiers="saveModifiers" /></UiAccordion>` al final del editor de cada bloque
- [ ] 4.3 `modifiers` computado desde `dashboardStore.getModifiers(block.key)`
- [ ] 4.4 `saveModifiers` llama `dashboardStore.setModifiers(block.key, newModifiers)`

## 5. Verificación
- [ ] 5.1 `php bin/phpunit` — tests compiler nuevos pasan
- [ ] 5.2 `npx nuxi typecheck` — sin errores
- [ ] 5.3 Smoke manual: login → dashboard → activar Character → abrir "Avanzado" → añadir peso en `hair_profile.andre_walker_type` → compilar → peso aparece en prompt → añadir condicional en `ethnicity` → compilar → condicional aparece → añadir tag en `scene` → compilar → tag aparece → cerrar/reabrir panel → modificadores persisten

---

# TODO — Dedicated Area Routes (Fase 2)

> Change: `openspec/changes/dedicated-area-routes/`
> Specs: `dedicated-area-routes`, `asset-library` (delta)

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

---

# TODO — PromptCompiler Lighting Block Fix

> Change: `openspec/changes/prompt-compiler-lighting/`
> Spec: `prompt-compiler-lighting`

## 1. Backend — PromptCompiler: normalizeCanonical + lightingText

- [x] 1.1 Añadir `'lighting'` a la lista de claves en `normalizeCanonical()` (línea 32): `['character', 'outfit', 'pose', 'scene', 'time', 'lighting']`.
- [x] 1.2 Crear método privado `lightingText(array $l): string` que renderice `setup_type`, `color_temperature`, `key_light_direction`, `hardness` y opcional `modifiers` con `label()` EN.
- [x] 1.3 En `buildText()`, añadir `if (isset($canonical['lighting'])) { $parts[] = $this->lightingText($canonical['lighting']); }` **después del bloque `time`** (línea ~108) y antes de `modelTail()`.
- [x] 1.4 Añadir a `label()` map los valores EN faltantes para enums de lighting: `BLUE_HOUR`, `STUDIO_HARSHELL`, `WINDOW_LIGHT`, `NEON`, `CANDLELIGHT`, `WARM_3200K`, `NEUTRAL_4500K`, `COOL_7000K`, `SIDE_90`, `BACK_45`, `OVERHEAD`, `UNDER`, `SEMI_SOFT`, `HARD_SHADOW`, `CONTRAST` (líneas 298-392).

## 2. Backend — Tests

- [x] 2.1 Añadir test `testCompileWithLightingBlock()` en `PromptCompilerTest`: composición completa con `lighting` → canonical tiene `lighting`, `compiled_text` incluye "Lighting:".
- [x] 2.2 Añadir test `testCompileOmitsLightingWhenAbsent()`: composición sin `lighting` → canonical no tiene `lighting`, compiled_text sin "Lighting:".
- [x] 2.3 Verificar: `cd backend && php bin/phpunit` → 63 tests en verde.

## 3. Verificación

- [x] 3.1 `cd backend && php bin/phpunit` — todos los tests pasan (63/63).
- [x] 3.2 `cd frontend && npx nuxi typecheck` — sin errores (solo warnings preexistentes).

---

# TODO — Outfit Random Button Fix

> Change: `openspec/changes/outfit-random-button-fix/`
> Spec: `outfit-random-generation`

## 1. Frontend — Habilitar botón en BlockEditor

- [x] 1.1 Editar `frontend/app/components/BlockEditor.vue:130` — quitar `props.blockKey !== 'outfit'` de `supportsRandom`

## 2. Verificación

- [x] 2.1 `npx nuxi typecheck` — sin errores nuevos
- [x] 2.2 Prueba manual: botón "Carga aleatoria" visible en bloque Outfit y genera outfit al pulsar
- [x] 2.3 `php bin/phpunit` — 63 tests verdes (sin regresiones)

---

# TODO — Prompt Language Homogenization (UI ES / Prompt EN)

> Change: `openspec/changes/prompt-language-homogenization/`
> Specs: `prompt-en-colors`, `prompt-en-free-text`, `catalog-en-labels`

## 1. Backend — PromptCompiler (mapa colores + campos *_en)

- [ ] 1.1 Añadir mapa estático `COLOR_ES_EN` (63 entradas) en `PromptCompiler.php`
- [ ] 1.2 Modificar `colorText()` para usar mapa con fallback
- [ ] 1.3 Modificar `poseText()`: usar `body_language_en ?? body_language`
- [ ] 1.4 Modificar `sceneText()`: usar `location_details_en ?? location_details`
- [ ] 1.5 Modificar `characterText()`: usar `style_name_en ?? style_name` en maquillaje

## 2. Backend — Catálogo (labels EN, 209 prendas / 9 ficheros)

- [ ] 2.1 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/tops.php`
- [ ] 2.2 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/bottoms.php`
- [ ] 2.3 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/outerwear.php`
- [ ] 2.4 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/dresses.php`
- [ ] 2.5 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/footwear.php`
- [ ] 2.6 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/headwear.php`
- [ ] 2.7 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/accessories.php`
- [ ] 2.8 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/lingerie.php`
- [ ] 2.9 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/swimwear.php`

## 3. Backend — Fixtures AppFixtures (textos libres EN)

- [ ] 3.1 Añadir `body_language_en` a poses en `AppFixtures.php`
- [ ] 3.2 Añadir `location_details_en` a scenes en `AppFixtures.php`
- [ ] 3.3 Añadir `style_name_en` a makeup en `AppFixtures.php`

## 4. Frontend — useRandom.ts (arrays EN + campos *_en)

- [ ] 4.1 Añadir `bodyLanguagesEn`, `locationDetailsEn`, `makeupStyleNamesEn` arrays
- [ ] 4.2 Modificar `randomPose()`: setear `body_language_en`
- [ ] 4.3 Modificar `randomScene()`: setear `location_details_en`
- [ ] 4.4 Modificar `randomCharacter()`: setear `current_makeup.style_name_en`

## 5. Frontend — types/api.ts (tipos *_en)

- [ ] 5.1 Añadir `body_language_en?: string` a interface `Pose`
- [ ] 5.2 Añadir `location_details_en?: string` a interface `Scene`
- [ ] 5.3 Añadir `style_name_en?: string` a interface `MakeupProfile`

## 6. Tests

- [ ] 6.1 Test `colorText()` con mapa: colores conocidos traducidos, desconocidos fallback
- [ ] 6.2 Test `poseText()` prefiere `body_language_en`
- [ ] 6.3 Test `sceneText()` prefiere `location_details_en`
- [ ] 6.4 Test `characterText()` prefiere `style_name_en` en maquillaje
- [ ] 6.5 Test integración: `compileWithOutfitBlock()` produce prompt EN (prendas + colores)

## 7. Verificación

- [ ] 7.1 `php bin/phpunit` — 63+ tests verdes
- [ ] 7.2 `npx nuxi typecheck` — solo WARN conocido `useGarmentStore`
- [ ] 7.3 Prueba manual: compilar prompt con outfit → inglés (prendas, colores, body_language si aleatorio)