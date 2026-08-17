## Why

Actualmente las prendas (Garment) existen como entidad en el backend pero no tienen CRUD propio, no se serializan al guardar/cargar outfits, y no llegan al prompt compilado. El sistema de "Carga aleatoria" de outfits no hace nada, y no hay librería de prendas reutilizables ni generador basado en sexo/clima/ocasión. La taxonomía de prendas documentada en `docs/project_and_data.md` (sección Ropa, ~1700 líneas) no está sembrada. Necesitamos hacer el ciclo de prendas funcional end-to-end: catálogo CRUD, persistencia en outfits, compilación a prompt, seeder exhaustivo y generador contextual.

## What Changes

- **Nuevo** `GarmentController` CRUD `/api/garments` (list, show, create, update, delete) reutilizando `AssetCrudTrait`.
- **Fix** `OutfitController`: `fill()` procesa `garments[]` (objeto inline o `garment_id` existente); `toArray()` devuelve `garments[]` completos.
- **Alineación de enums** UI↔backend:
  - Categoría prenda: `TOP|BOTTOM|FULL_BODY|FOOTWEAR|HEADWEAR|ACCESSORY` (eliminar `DRESS/OUTERWEAR/SHOES` de UI).
  - Fit prenda: `SKINNY|SLIM|REGULAR|OVERSIZED|TAILORED` (eliminar `RELAXED/OVERSIZE/FORM_FITTING` de UI).
  - Estilo outfit: `CASUAL|FORMAL|ATHLETIC|HIGH_FASHION|TACTICAL|PERIOD_COSTUME` (unificar con UI).
- **Taxonomía de tags namespaced** en `Garment.tags`: `gender:female|male|unisex`, `season:spring|summer|autumn|winter`, `weather:cold|cool|mild|hot|rain|snow|wind`, `occasion:casual|formal|business|street|sport|elegant|beach|evening|period`, `environment:urban|nature|studio|indoor|outdoor`.
- **Fix `PromptCompiler::outfitText`**: leer `garments[]` (o normalizar), renderizar detalle por prenda (material, peso, nombre, color, patrón, fit) usando `label()` EN, y usar `Garment.label` EN si existe.
- **Migración**: añadir `label` (string, nullable) a `Garment` para nombre EN (bilingüe).
- **Seeder exhaustivo** del documento `docs/project_and_data.md` (sección Ropa): catálogo estructurado por secciones (pantalones, chaquetas, camisas, faldas, camisetas, vestidos, complementos cabeza, joyería, lencería, calzado, accesorios) con variantes × 2-3 colores/tejidos por prenda + outfits de ejemplo por estilo/ocasión.
- **Frontend**: `useGarmentStore` real (fetch, filtro por tags/slot), `GarmentPicker` modal con filtros por tags, integración en `OutfitEditor` ("Elegir del catálogo" por slot + edición inline).

**BREAKING**: Cambio de forma de outfit en API (ahora incluye `garments[]` completo en list/show). Alineación de enums en UI.

## Capabilities

### New Capabilities
- `garment-catalog`: CRUD completo de prendas, taxonomía de tags, picker por tags, serialización en outfits, seeder exhaustivo del documento.
- `outfit-generator`: Generador contextual de outfits en `useRandom.ts` basado en género del personaje + estación/clima/hora + entorno de la escena, respetando reglas de layering.

### Modified Capabilities
- `asset-library`: Extender para incluir prendas como tipo de asset buscable/pickable (delta spec).
- `prompt-compiler`: Corregir compilación de outfit para leer `garments[]` y renderizar detalle por prenda con labels EN (delta spec).

## Impact

- **Backend**: `GarmentController`, `OutfitController` (fill/toArray), `PromptCompiler::outfitText`, migración `Garment.label`, fixtures/seeder exhaustivo, tests.
- **Frontend**: `types/api.ts` (alineación enums), `stores/garment.ts` (nuevo), `stores/outfit.ts` (integración picker), `components/editor/GarmentEditor.vue`/`OutfitEditor.vue` (enums, picker), `components/editor/GarmentPicker.vue` (nuevo), `composables/useRandom.ts` (generador), `composables/useCompile.ts` (sin cambios, usa store).
- **API**: `/api/garments` nuevo endpoint; `/api/outfits` ahora devuelve `garments[]` completo.
- **DB**: Migración `Garment.label`, datos del seeder.