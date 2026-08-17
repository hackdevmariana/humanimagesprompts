## Why

Los prompts generados salen en español mezclado con inglés: (1) las prendas usan `name` ES al no tener `label` EN; (2) los colores del catálogo son ES ("Blanco", "Gris marengo") y `colorText()` los vuelca tal cual; (3) campos de texto libre (`body_language`, `location_details`, `style_name` de maquillaje) se compilan verbatim. El objetivo es: **UI en español, prompt 100% en inglés**.

## What Changes

- **Catálogo (9 ficheros, 209 prendas)**: añadir `'label' => 'EN...'` a cada `base`. El seeder ya lee `$base['label'] ?? null`; `outfitText()` usa `label ?? name ?? sub_category`.
- **Compilador**: mapa ES→EN de 63 colores únicos en `colorText()` con fallback al nombre original.
- **Compilador**: campos EN paralelos para texto libre — `body_language_en`, `location_details_en`, `style_name_en` (maquillaje) con fallback a ES.
- **Frontend `useRandom.ts`**: arrays EN paralelos (`bodyLanguagesEn`, `locationDetailsEn`, `makeupStyleNamesEn`) y seteo de `*_en` en `randomPose()`, `randomScene()`, `randomCharacter()`.
- **Frontend `types/api.ts`**: añadir `body_language_en?`, `location_details_en?`, `style_name_en?` opcionales.
- **Fixtures `AppFixtures.php`**: añadir versiones EN de `body_language`, `location_details`, `style_name`.
- **Tests**: nuevos tests para `colorText()` con mapa y campos `*_en`.

## Capabilities

### New Capabilities
- `prompt-en-colors`: Mapa de traducción de 63 colores ES→EN en el compilador para que `colorText()` devuelva nombres en inglés.
- `prompt-en-free-text`: Campos paralelos `*_en` para `body_language`, `location_details`, `style_name` (maquillaje) con fallback a ES.
- `catalog-en-labels`: Labels EN en el catálogo de prendas (209 prendas) para que `outfitText()` use inglés.

### Modified Capabilities
- `prompt-compiler`: `colorText()` usa mapa ES→EN; `poseText()`/`sceneText()`/`characterText()` prefieren campos `*_en`.
- `random-generation`: `useRandom.ts` genera y setea campos `*_en` además de los ES.
- `garment-catalog`: Cada prenda tiene `label` EN; seeder lo persiste.

## Impact

- **Backend**: `PromptCompiler.php` (colorText, poseText, sceneText, characterText), `AppFixtures.php`, 9 catálogos en `backend/fixtures/catalog/`, `GarmentCatalogFixtures.php` (sin cambios, ya lee label).
- **Frontend**: `useRandom.ts`, `types/api.ts`.
- **Tests**: `tests/Service/PromptCompilerTest.php` — nuevos tests.
- **API/DB**: Sin cambios de schema (campos `*_en` opcionales en DTOs, entidades existentes sin cambios — los campos EN viven en JSON serializado o DTOs, no en BD).