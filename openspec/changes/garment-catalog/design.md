## Context

**Estado actual:**
- Entidad `Garment` existe con campos: `name`, `category`, `subCategory`, `fit`, `fabric`, `primaryColor`, `secondaryColor`, `pattern`, `tags` (JSON). No tiene CRUD propio.
- `Outfit` tiene relación `OneToMany` con `GarmentSlot` que apunta a `Garment`. `OutfitController::fill()` y `toArray()` ignoran `garments` → las prendas no persisten ni se cargan.
- `PromptCompiler::outfitText()` espera `layers[]` pero el frontend envía `garments[]` → el detalle de prendas no llega al prompt.
- Enums desalineados: UI usa `DRESS/OUTERWEAR/SHOES` y fits `RELAXED/OVERSIZE/FORM_FITTING`; backend usa `TOP/BOTTOM/FULL_BODY/FOOTWEAR/HEADWEAR/ACCESSORY` y fits `SKINNY/SLIM/REGULAR/OVERSIZED/TAILORED`. Estilo outfit: UI tiene `BUSINESS/ATHLEISURE/EVENING/STREET/BOHEMIAN`; backend `CASUAL/FORMAL/ATHLETIC/HIGH_FASHION/TACTICAL/PERIOD_COSTUME`.
- `useRandom.ts` tiene `case 'outfit': break` → la aleatorización de outfits no existe.
- No hay librería de prendas frontend: `useGarmentStore` es solo array en memoria `templates[]`.
- Documento fuente: `docs/project_and_data.md` sección Ropa (línea 1708+) con taxonomía exhaustiva.

## Goals / Non-Goals

**Goals:**
1. CRUD `/api/garments` funcional reutilizando `AssetCrudTrait`.
2. `OutfitController` serializa/deserializa `GarmentSlot` (acepta inline + referencia `garment_id`).
3. Alinear enums UI↔backend en categorías, fit y estilo outfit.
4. Taxonomía de tags namespaced (`gender:`, `season:`, `weather:`, `occasion:`, `environment:`).
4. Fix `PromptCompiler`: leer `garments[]`, renderizar con labels EN; migración `Garment.label` EN.
5. Seeder exhaustivo del documento (ficheros de datos por sección, expansión × colores/tejidos).
6. Frontend: `useGarmentStore` real (fetch/filtro), `GarmentPicker` modal, integración en `OutfitEditor`.
7. Generador `randomOutfit()` en `useRandom.ts` contextual (género + clima + entorno + reglas layering).

**Non-Goals:**
- Motor de traducción a Midjourney/Flux/SDXL (existe en `prompt-compiler` spec).
- Pantallas dedicadas por área (fase futura: `advanced-section-panels`, `dedicated-area-routes`).
- Validación estricta de tags en backend (solo documentación + filtro frontend; validación server-side futura).
- Multi-tenencia / aislamiento por usuario (sistema actual es single-user admin).

## Decisions

### 1. GarmentController reutiliza AssetCrudTrait
**Por qué:** Consistencia con `CharacterController`, `PoseController`, etc. `AssetCrudTrait` ya provee list/show/create/update/delete con auth. Solo requiere implementar `entityClass()`, `requiredField()`, `toArray()`, `fill()`.
**Alternativa:** Controller manual → más código, diverge del patrón.

### 2. OutfitController: `garments` como array de objetos o referencias `garment_id`
**Diseño:** `fill()` acepta `garments: Array<{garment_id?, ...garmentFields}>`.
- Si trae `garment_id`: busca `Garment` existente y crea `GarmentSlot` apuntando a él.
- Si no trae `garment_id`: crea `Garment` nuevo (cascade persist) y `GarmentSlot` asociado.
**toArray()** devuelve `garments[]` con objeto `GarmentSlot` expandido (`slot_type`, `garment` completo).
**Razón:** Permite reutilizar prendas del catálogo (picker) y crear ad-hoc (inline). Backward-compatible: el envío inline actual sigue funcionando.

### 3. Alineación de enums: backend como fuente de verdad
**Por qué:** El backend valida y persiste; la UI solo refleja. Cambiar UI es trivial (opciones de select); cambiar backend requiere migración.
- Categorías prenda: backend correcto (se alinea a `LayerSlotEnum`: `BASE_LAYER`→TOP/BOTTOM/FULL_BODY, `MID_LAYER`→TOP, `OUTER_LAYER`→TOP, `FOOTWEAR`→FOOTWEAR, `HEADWEAR`→HEADWEAR, `ACCESSORIES`→ACCESSORY).
- Fit: backend más granular (`SKINNY/SLIM/REGULAR/OVERSIZED/TAILORED` vs UI `SLIM/REGULAR/RELAXED/OVERSIZE/FORM_FITTING`).
- Estilo outfit: backend tiene 6 valores estándar; UI añade 5 más. Unificar al set backend.

### 4. Tags namespaced en `Garment.tags` (JSON array)
**Estructura:** `['gender:female', 'season:summer', 'weather:hot', 'occasion:beach', 'environment:outdoor']`.
**Por qué:** 
- Simple, sin migración (campo ya existe).
- Filtrable en frontend (`includes('gender:female')`).
- Extensible sin cambio de esquema.
- Alineado con visión tag-driven del repo (`rules-and-specifications.md`).

### 5. `PromptCompiler::outfitText` lee `garments[]` directamente
**Cambio:** `normalizeCanonical` o `outfitText` detecta `garments` (array de GarmentSlot) y mapea `slot_type` → layer label (`BASE_LAYER`→'base layer', etc.). Usa `garment.name`, `fabric.material`, `fabric.weight`, `primary_color`, `pattern`, `fit`. Labels EN via `label()` (ya tiene mapeo de categorías/fits/materiales).
**Migración `Garment.label`**: columna `label` nullable string. Si existe, se usa como nombre EN en prompt; si no, se usa `name` (ES) o `subCategory`. Se poblará en seeder.

### 6. Seeder exhaustivo: ficheros de datos por sección + fixture expansor
**Estructura:**
```
backend/src/DataFixtures/catalog/
  pants.php        // array de definiciones base
  jackets.php
  shirts.php
  skirts.php
  tshirts.php
  dresses.php
  headwear.php
  jewelry.php
  lingerie.php
  footwear.php
  accessories.php
```
Cada fichero devuelve `array<array{base: array, colors: array<string>, fabrics: array}>`.
Fixture `GarmentCatalogFixtures.php` itera, expande × colores × tejidos, crea `Garment` con tags según sección, y crea `Outfit` de ejemplo combinando prendas coherentes.
**Por qué:** Mantenible (un fichero por categoría del documento), revisable, expansible. Evita volcar 2000 líneas en un solo fixture.

### 7. Frontend: `GarmentPicker` modal + `useGarmentStore` con filtros
**Store:** `useGarmentStore` con `fetchAll()`, `getBySlot(slotType)`, `filterByTags(tags)`, `search(query)`.
**Picker:** Modal agrupado por slot (pestañas: Capa base, Capa media, Capa exterior, Calzado, Cabeza, Accesorios). Cada pestaña lista prendas del slot con filtros laterales (tags: género, ocasión, clima, entorno). Al seleccionar → `outfit.setGarment(slot, garment)`.
**Integración:** `OutfitEditor` añade botón "Catálogo" por slot que abre picker. Edición inline sigue disponible.

### 8. Generador `randomOutfit()` en `useRandom.ts`
**Algoritmo:**
1. Obtiene contexto: `characterStore.data.gender` → tag `gender:...`; `timeStore.data` → `season/weather/time_of_day` → tags `season:`, `weather:`; `sceneStore.data.environment_type` → tag `environment:`.
2. Para cada `slotType` en orden `['BASE_LAYER','MID_LAYER','OUTER_LAYER','FOOTWEAR','HEADWEAR','ACCESSORIES']`:
   - Candidatos = prendas del slot filtradas por tags de contexto (AND). Si vacío, fallback sin filtro.
   - Si slot es `BASE_LAYER`: evita conflicto FULL_BODY + TOP/BOTTOM (si elige FULL_BODY, salta MID/OUTER si serían TOP/BOTTOM en base — regla simplificada: solo una prenda en base).
   - Elige una al azar ponderada (futuro: pesos por estilo).
3. Establece `style_category` coherente con tags de ocasión predominantes.

**Lógica pura:** `generateOutfit(candidatesBySlot, contextTags)` exportable para tests.

## Risks / Trade-offs

| Riesgo | Mitigación |
|--------|------------|
| Seeder exhaustivo = miles de filas → fixtures lentas | Fixtures solo en dev; tests usan subset. Usar `doctrine:fixtures:load --append` incremental. |
| Tags string sin validación backend → datos sucios | Documentar taxonomía en `docs/domain/garment-tags.md`; validación suave en `fill()` (warn log). Validación estricta: futura spec. |
| `garment_id` vs inline en OutfitController → ambigüedad si ambos vienen | Prioridad: si `garment_id` presente, ignorar campos inline. Documentar en API. |
| Migración `Garment.label` en prod existente | Columna nullable, sin default. Backfill opcional via script. |
| Desalineación enums UI vs backend residual | Tests de integración `OutfitController` verifican round-trip con enums backend. |
| Generador frontend sin reglas server-side → inconsistencia si API cambia | Reglas de layering documentadas en `docs/domain/rules-and-specifications.md`; ambas partes consultan misma fuente. |
| Picker modal UX en móvil | Diseño responsive; slide-over bottom-sheet en móvil. |

## Migration Plan

1. Migración `Garment.label` (nullable).
2. Deploy código backend (GarmentController, OutfitController fix, PromptCompiler fix, enums alineados).
3. `doctrine:migrations:migrate`.
4. `doctrine:fixtures:load` (carga catálogo exhaustivo + outfits ejemplo).
5. Deploy frontend (tipos alineados, stores, picker, generador).
6. Verificación: `php bin/phpunit` + `npx nuxi typecheck`.

**Rollback:** Revertir migración (`doctrine:migrations:migrate prev`), revertir código. Datos del seeder solo en dev.

## Open Questions

1. ¿Nombres EN en `Garment.label` para TODAS las prendas del seeder, o solo categorías principales? (Recomiendo: todas, para prompt EN coherente).
2. ¿Pesos en generador (ej. preferir `gender:unisex` sobre `gender:female` si personaje es non-binary)? MVP: filtro exacto; pesos: futura mejora.
3. ¿Outfits de ejemplo en seeder: cuántos y qué estilos? (Propuesta: 1 por combinación estilo×ocasión×estación ≈ 30-40 outfits).