## Why

`OutfitEditor.vue:32-44` tiene dos elementos hermanos con `v-else` tras un único `v-if` (el `<div>` "Sin prenda en este slot" y `<UiButton>` "Catálogo"). Esto rompe la compilación de Vite con el error: `v-else/v-else-if has no adjacent v-if or v-else-if`. La plantilla no es válida y el frontend no arranca.

## What Changes

- Reescribir el bloque de plantilla (líneas 32-44) para envolver el texto de estado vacío y el botón "Catálogo" en un **único** contenedor `v-else`.
- Estructura resultante: `<div v-else class="space-y-2">` que contiene `<div>` con el texto y `<UiButton variant="ghost">` con el icono y etiqueta "Catálogo".
- Comportamiento preservado: cuando un slot no tiene prenda, se muestra el texto informativo y el botón para abrir el `GarmentPicker`; cuando hay prenda, se muestra el `GarmentEditor` y el botón de borrar (X).

## Capabilities

### Modified Capabilities
- `editor-ui`: Corrige la plantilla del componente `OutfitEditor` para que compile sin errores de Vue.

## Impact

- **Frontend**: Solo `frontend/app/components/editor/OutfitEditor.vue` (líneas 32-44).
- **Tests/Calidad**: `npx nuxi typecheck` debe pasar sin errores tras el cambio.
- **API/Backend**: Sin cambios.
- **DB**: Sin cambios.