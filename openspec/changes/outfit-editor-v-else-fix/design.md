## Context

**Estado actual (template roto):**
- `OutfitEditor.vue` líneas 27-44:
  ```vue
  <GarmentEditor v-if="slots[slot]" ... />
  <div v-else class="text-center text-xs text-stone-500 py-2">
    Sin prenda en este slot
  </div>
  <UiButton v-else variant="ghost" ...>
    <HangerIcon /> Catálogo
  </UiButton>
  ```
- Dos elementos hermanos (`<div v-else>` y `<UiButton v-else>`) compitiendo por el mismo `v-if` anterior. Vue solo permite un `v-else` por cadena `v-if`/`v-else-if`.

## Goals / Non-Goals

**Goals:**
1. Template válido que compile en Vite sin errores.
2. Preservar la UX: estado vacío muestra texto informativo + botón "Catálogo"; estado con prenda muestra editor + botón borrar.

**Non-Goals:**
- Cambiar la lógica de `slots[slot]` ni la integración con `GarmentPicker`.
- Añadir nuevos estilos (reutilizar clases Tailwind existentes).

## Decisions

### 1. Envolver ambos elementos en un único contenedor `v-else`
**Por qué:** Es la solución más directa y minimal. Vue permite anidar elementos arbitrarios dentro de un `v-else` si están envueltos en un contenedor padre (o usando `<template v-else>`).
**Diseño elegido:**
```vue
<div v-else class="space-y-2">
  <div class="text-center text-xs text-stone-500 py-2">Sin prenda en este slot</div>
  <UiButton variant="ghost" size="sm" class="w-full" @click="openPicker(slot)">
    <HangerIcon class="h-3 w-3 mr-1" />
    Catálogo
  </UiButton>
</div>
```
**Alternativa descartada:** Usar `<template v-else>` sin contenedor envolvente. Rechazada porque `<template>` no renderiza elemento DOM y `space-y-2` (espaciado vertical) requeriría un wrapper real para funcionar con las clases Tailwind; además, `<UiButton>` ya es un componente que renderiza su propio elemento.

### 2. Mantener `variant="ghost"` y `HangerIcon = PhTShirt`
**Por qué:** Ya corregido en commits previos (phantom `PhHanger` y `variant="outline"` inválido). El cambio actual solo reestructura el template, no toca estilos ni imports.

### 3. Clases Tailwind: `space-y-2` en el wrapper
**Por qué:** Espacia verticalmente el texto y el botón de forma limpia sin añadir márgenes manuales a cada hijo. Coherente con el resto del componente (usa `space-y-3` en el contenedor padre `pt-1`).