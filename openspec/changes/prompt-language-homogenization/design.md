## Context

Hoy el prompt compilado mezcla idiomas:
1. **Prendas**: `outfitText()` usa `label ?? name ?? sub_category`. El catálogo tiene `name` ES ("Camiseta básica algodón") y **ninguna prenda tiene `label`** (grep 0 en 9 ficheros) → prompts en español.
2. **Colores**: `colorText()` devuelve `"{$name} {$hex}"` con `color_name` ES (63 únicos, 240 ocurrencias: "Blanco", "Gris marengo", "Azul marino", "Verde menta base"...).
3. **Texto libre**: `poseText()` usa `body_language` verbatim; `sceneText()` usa `location_details` verbatim; `characterText()` usa `makeup.style_name` verbatim vía `label()`. Estos vienen de `useRandom.ts` (arrays ES) y `AppFixtures.php` (strings ES).

La regla acordada: **UI en español, prompt en inglés**.

## Goals / Non-Goals

**Goals:**
- Prompts 100% en inglés (prendas, colores, texto libre de fixtures/aleatorio)
- UI sigue en español (labels/campos ES intactos)
- Cambios mínimos, sin migración de BD

**Non-Goals:**
- Traducción automática de texto libre escrito por usuario (solo fixtures/aleatorio)
- Cambios en schema de BD (campos `*_en` viven en DTOs/JSON, no en entidades)
- Markdown output (change futuro `prompt-markdown-output`)

## Decisions

1. **Labels EN en catálogo (a mano)**: Añadir `'label' => '...'` a cada `base` en 9 ficheros. El seeder ya lo lee. Ventaja: control total, sin magic strings. 209 prendas = esfuerzo manual aceptado.

2. **Mapa colores ES→EN en `colorText()`**: Mapa estático de 63 entradas en `PromptCompiler`. `colorText()` busca en mapa; si no existe, fallback a `"name hex"` original. Ventaja: UI ve "Blanco", prompt ve "White". No toca catálogo (240 ocurrencias). Mantenible: mapa centralizado.

3. **Campos `*_en` paralelos para texto libre**:
   - `body_language_en` en Pose, `location_details_en` en Scene, `style_name_en` en MakeupProfile
   - Compiler: `body_language_en ?? body_language`, etc.
   - Frontend: arrays EN paralelos en `useRandom.ts` (`bodyLanguagesEn`, `locationDetailsEn`, `makeupStyleNamesEn`) y seteo en `randomPose/scene/character()`.
   - Tipos: `types/api.ts` añade opcionales `body_language_en?`, `location_details_en?`, `style_name_en?`.
   - Fixtures: `AppFixtures.php` añade versiones EN.
   Ventaja: UI muestra ES (campo original), prompt usa EN (campo `_en`). Usuario editando sigue viendo/escribiendo ES; solo fixtures/aleatorio ganan EN.

4. **Sin cambios en BD**: Los campos `*_en` no persisten como columnas; viajan en el JSON del DTO que se compila. Las entidades usan `ArrayCollection`/`json` fields — compatibles.

## Risks / Trade-offs

- [Risk] 209 labels a mano → error humano (typos, inconsistencias). → **Mitigación**: Revisión PR + test de smoke `compileWithOutfitBlock()`.
- [Risk] Mapa 63 colores incompleto → fallback devuelve ES. → **Mitigación**: Test que verifica que todos los colores del catálogo están en el mapa (o acepta fallback).
- [Risk] Usuario edita `body_language` en UI → prompt sale ES (no hay `_en` escrito). → **Mitigación**: Aceptado; solo fixtures/aleatorio tienen EN. Futuro: botón "Traducir" o campo EN en editor.
- [Risk] `makeup.style_name` en `label()` — `label()` devuelve el string si no está en mapa. → **Mitigación**: `style_name_en` añadido y `characterText()` lo prefiere.
- [Risk] `useGarmentStore` duplicado (WARN typecheck) — ignorar import de `stores/garment.ts` vs `stores/outfit.ts`. → **Mitigación**: No tocar; WARN no bloquea.