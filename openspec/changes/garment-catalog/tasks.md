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
- [ ] 6.3 Test: `npx nuxi typecheck` pasa sin errores

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