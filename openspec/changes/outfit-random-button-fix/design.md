## Context

El componente `BlockEditor.vue` renderiza los bloques del editor (Personaje, Pose, Outfit, Escena, Tiempo, Iluminación). En la línea 130 define:

```ts
const supportsRandom = computed(() => props.blockKey !== 'outfit')
```

Esta exclusión explícita impide que el botón "Carga aleatoria" se muestre en el bloque Outfit, aunque la funcionalidad de generación aleatoria (`randomize('outfit')`) ya está completamente implementada en `frontend/app/composables/useRandom.ts` (líneas 352-410) con generador contextual puro `generateOutfit()` que considera:
- Género del personaje (genderTag)
- Estación/tiempo (seasonTag)
- Clima (weatherTag)
- Entorno de la escena (environmentTag)

El generador filtra prendas del catálogo por categoría y tags (lógica AND estricta con fallback), evita duplicados y gestiona conflicto FULL_BODY en BASE_LAYER.

## Goals / Non-Goals

**Goals:**
- Habilitar el botón "Carga aleatoria" en el bloque Outfit
- Que al pulsar genere outfits contextuales usando la lógica existente

**Non-Goals:**
- Modificar la lógica de `generateOutfit()` (ya funciona)
- Cambiar la UI del botón o su posición
- Añadir tests nuevos (la lógica ya está probada)

## Decisions

1. **Eliminación directa de la exclusión**: Quitar `!== 'outfit'` de la computed `supportsRandom`. Es el cambio mínimo, seguro y no introduce efectos colaterales — `randomize('outfit')` ya maneja el caso correctamente.

2. **No tocar `useRandom.ts`**: La función `randomize('outfit')` ya existe, importa `useGarmentStore`, `useCharacterStore`, `useTimeStore`, `useSceneStore` y llama a `generateOutfit()`. No requiere cambios.

## Risks / Trade-offs

- [Risk] El generador usa `contextTags.every(...)` (AND estricto) que casi siempre cae al fallback sin tags → los outfits aleatorios pueden ser menos contextuales de lo ideal. → **Mitigación**: Es el comportamiento actual aceptado; se puede mejorar en change futuro `advanced-section-panels` (reglas/pesos).
- [Risk] `hasFullBodyInBase` se calcula pero no se usa para saltar MID_LAYER/OUTER_LAYER → puede generar outfits con vestido + top encima. → **Mitigación**: Bug conocido, fuera del scope de este fix; se documenta en TODO para change futuro.