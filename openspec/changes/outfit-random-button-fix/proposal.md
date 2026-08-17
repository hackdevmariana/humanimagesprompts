## Why

El bloque "Outfit" en el editor no muestra el botón "Carga aleatoria" aunque la función `randomize('outfit')` ya está implementada y funcional en `useRandom.ts`. El problema es una exclusión explícita en `BlockEditor.vue:130`: `supportsRandom = computed(() => props.blockKey !== 'outfit')`. Este fix elimina esa exclusión para habilitar la generación aleatoria de outfits contextuales (por género, clima, entorno).

## What Changes

- Eliminar la condición `props.blockKey !== 'outfit'` en `BlockEditor.vue:130` para que `supportsRandom` sea `true` también para outfits.
- El botón "Carga aleatoria" aparecerá en el bloque Outfit y al pulsarlo invocará `randomize('outfit')` existente que genera outfits contextuales por género/clima/entorno.

## Capabilities

### New Capabilities
- `outfit-random-generation`: Permitir la generación aleatoria de outfits desde el bloque Outfit del editor mediante el botón "Carga aleatoria".

### Modified Capabilities
- `block-editor`: Se elimina la restricción que impedía la aleatorización en el bloque outfit.

## Impact

- **Frontend**: `frontend/app/components/BlockEditor.vue` (línea 130)
- **Funcionalidad existente**: `useRandom.ts` ya contiene `randomize('outfit')` y `generateOutfit()` puro probado — no requiere cambios.
- **API/Backend**: Sin cambios.
- **Tests**: Sin cambios necesarios (la lógica ya existe y tiene tests implícitos en useRandom).