## Why

The dashboard lacks a dedicated block to set the atmospheric time context of a shoot (season, time of day and day conditions). Today this data lives only as a coarse, hidden sub-section ("Clima y atmósfera") inside the Escenario editor with just 6 weather and 5 time values, so operators cannot compose realistic time-of-day/weather prompts (golden hour, storm, frost...) nor save them as reusable assets.

## What Changes

- Add a new **Tiempo** block editor (full-stack, mirroring the Lighting block pattern) with three select fields:
  - **Estación** (4 values: primavera, verano, otoño, invierno)
  - **Hora del día** (13 values, de-duplicated: noche cerrada, madrugada, hora azul, amanecer, hora dorada, mañana, media mañana, mediodía, tarde, atardecer, anochecer, crepúsculo, noche)
  - **El día** (34 values: soleado, despejado, parcialmente nublado, nublado, cubierto, lluvioso, lloviznando, tormentoso, con chubascos, nevando, con aguanieve, con granizo, con niebla, con bruma, ventoso, con rachas de viento, polvoriento, con calima, húmedo, bochornoso, helado, frío, fresco, templado, caluroso, muy caluroso, con tormenta eléctrica, con arcoíris, con hielo, con rocío, con escarcha, variable, inestable, cambiante)
- Add backend persistence for the block as a new asset domain (`time_weather` table, CRUD controller, fixture), reusing `AssetCrudTrait`.
- Compile the Tiempo block into the canonical prompt as a new section, placed in canonical order **after** `scene` (`character → pose → outfit → scene → time → lighting`).
- Wire the Tiempo block into every frontend integration: store, editor, sidebar, drag & drop reorder, global compile, section prompt ("Crear prompt") and random generation ("Carga aleatoria").
- **Remove** the "Clima y atmósfera" accordion from the Escenario editor (and stop populating `weather_and_atmosphere`) to avoid duplicated/contradictory climate data.

## Capabilities

### New Capabilities
- `time-weather-block`: Tiempo block editor with season/time-of-day/day selects, canonical compilation after scene, asset persistence, section prompt and client-side random generation.

### Modified Capabilities
- `prompt-builder`: the dashboard moves from five to six toggleable editors (Personaje, Pose, Outfit, Escenario, Iluminación, Tiempo); the Escenario editor no longer exposes climate/time fields.
- `asset-library`: `TimeWeather` joins the set of persisted asset domains (save/load/autocomplete/edit/delete).

## Impact

- **Backend (Symfony):** new `App\Entity\TimeWeather`, `TimeWeatherController` (`/api/time-weather` CRUD via `AssetCrudTrait`), new migration `time_weather`, fixture entry, and `PromptCompiler` gains a `time` block in `normalizeCanonical`/`buildText` plus English label mappings.
- **Frontend (Nuxt/Vue/Pinia):** `types/api.ts` (`TimeWeather`), `stores/time.ts`, `editor/TimeWeatherEditor.vue`, registration of `time` in `stores/dashboard.ts` (`BlockKey`, `CANONICAL_BLOCK_ORDER`, `activeBlocks`), `BlockSidebar.vue`, `BlockEditor.vue`, `useCompile.ts`, `useSectionPrompt.ts`, `useRandom.ts`; removal of the climate accordion in `SceneEditor.vue`.
- **No** `docs/project_and_data.md` taxonomy changes yet (reference tables live in `useRandom.ts` as today).