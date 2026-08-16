# Design: Frontend Time-Weather Block

## Context

The `frontend-modular-prompts` change delivered a working dashboard with five toggleable block editors (Personaje, Pose, Outfit, Escenario, Iluminación), each backed by one Pinia store, an asset library (CRUD per domain), a global prompt compiler (`POST /api/compile`), per-section prompt compilation ("Crear prompt"), client-side random generation ("Carga aleatoria") and drag & drop visual reordering.

Two facts shape this design:

1. **The Lighting block is the established full-stack pattern**: backend `Lighting` entity + `LightingController` (via `AssetCrudTrait`) + migration + fixture; frontend `stores/lighting.ts` + `editor/LightingEditor.vue` + registration in `dashboard.ts`, `BlockSidebar.vue`, `BlockEditor.vue`, `useCompile.ts`, `useSectionPrompt.ts` and `useRandom.ts`.
2. **The compiler is block-driven**: `normalizeCanonical()` in `PromptCompiler.php` only processes keys present in the payload, and `buildText()` renders one section per block. Adding a new block is additive — existing blocks are untouched. Note that `lighting` today is *not* rendered by `buildText` (it only appears embedded in `scene.lighting`); the Tiempo block **will** render its own section, fixing that class of gap for the new block.

The Escenario editor currently ships a coarse "Clima y atmósfera" accordion (`weather_and_atmosphere`: 6 weather values, 5 time-of-day values). The user wants a dedicated **Tiempo** block with richer taxonomies (4 seasons, 13 times of day, 34 day conditions) and full asset support, and wants the duplicated scene climate section removed.

## Goals / Non-Goals

**Goals:**
- Full-stack Tiempo block: `time_weather` persistence (CRUD), editor, store, sidebar, section prompt, random generation and global compilation.
- New compiled prompt section placed in canonical order after `scene` (`character → pose → outfit → scene → time → lighting`).
- Remove the "Clima y atmósfera" accordion from the Escenario editor and stop generating its data, avoiding duplicated climate state.
- Reuse the existing design system, store pattern and compilation pipeline.

**Non-Goals:**
- Loading `docs/project_and_data.md` taxonomies into stores (reference tables stay in `useRandom.ts`, as today).
- Backend migration of the `scene.weather_and_atmosphere` column (kept for backward-compatible reads of existing saved scenes; just no longer written by the UI).
- New `PromptComposition` FK to `time_weather` (matches the Lighting precedent, which has no composition FK).
- Persisting visual card order across sessions.

## Decisions

### 1. New asset domain `time_weather`, block key `time`
Backend entity `App\Entity\TimeWeather` with three string columns (`season`, `time_of_day`, `weather`, each `length: 50`) plus the `UuidIdentity` trait; controller `TimeWeatherController` exposing `/api/time-weather` CRUD via `AssetCrudTrait` (requiring `season`); migration `time_weather`; fixture entry. Frontend block key is `time`, UI label "Tiempo", sidebar icon from Phosphor (`PhCloudSun` or `PhClock`).
- **Alternatives considered:** reusing `scene.weather_and_atmosphere` JSON — rejected (keeps the fragmented coarse state and blocks asset reuse; a real entity matches the asset-library "separate table per domain with scalar columns" rule).

### 2. Canonical order: `time` after `scene`
`CANONICAL_BLOCK_ORDER` becomes `['character', 'pose', 'outfit', 'scene', 'time', 'lighting']` and the default `activeBlocks`/`uiOrder` include `time`. Weather belongs next to the scene in the compiled text.
- **Alternatives considered:** appending `time` at the end (after lighting) — rejected; lighting is a light-source detail, time-of-day/weather is atmospheric context that reads better right after the scene.

### 3. Compilation is additive in `PromptCompiler`
- `normalizeCanonical()` adds `'time'` to the key loop; no normalization is needed for the flat block (unlike `character` which renames grooming keys).
- `buildText()` adds `timeText($time)` producing: `Time: {season}, {time_of_day}, {weather} day.` e.g. `"Time: spring, golden hour, sunny day."` via the existing `label()` map.
- `label()` gains the 51 new mappings (4 seasons, 13 times, 34 day conditions). Unmapped tokens already degrade gracefully to `ucwords()`.
- `CompileController::persistedToPayload()` is untouched (no composition FK; inline payload carries the block like lighting).

### 4. Frontend block integration (mirrors Lighting exactly)
- `types/api.ts`: `TimeWeather` interface (`season`, `time_of_day`, `weather`).
- `stores/time.ts`: `useTimeStore` following `stores/lighting.ts` (`data`, `saved`, `loading`, CRUD actions, `reset`), endpoint `/api/time-weather`.
- `editor/TimeWeatherEditor.vue`: three `UiSelect`s (Estación, Hora del día, El día).
- `dashboard.ts`: add `'time'` to `BlockKey`, `CANONICAL_BLOCK_ORDER`, default `activeBlocks` and `uiOrder`.
- `BlockSidebar.vue`: block entry "Tiempo".
- `BlockEditor.vue`: `getStore()`, `blockLabel` and `editorComponent` cases for `'time'`. The card automatically gains Guardar/Cargar, "Crear prompt" and "Carga aleatoria" (outfit remains the only block without randomize).
- `useCompile.ts`: add `time` to `activeBlocksMap` (canonical loop already covers it).
- `useSectionPrompt.ts`: add `time` to `blockData` and `isEmpty` (empty when `time_of_day`/`weather`/`season` unset — the store's default selection counts as "has values" like lighting, so `isEmpty` returns `false`).
- `useRandom.ts`: reference tables `seasons`, `timeOfDays`, `weathers` + `randomTime()` populating the store.

### 5. Scene climate removal
`SceneEditor.vue` drops the "Clima y atmósfera" accordion; `stores/scene.ts` `EMPTY_SCENE` drops `weather_and_atmosphere`; `useRandom.ts` `randomScene()` stops setting it. The `Scene` TS type keeps the field optional for backward-compatible reads of saved scenes.
- **Rationale:** one source of truth for climate; Tiempo owns season/time/day from now on.

## Risks / Trade-offs

- [Reference tables in `useRandom.ts` may drift from backend/UI option lists] → generation reads values from the same token set used by `TimeWeatherEditor`; values are single-source in the editor options and mirrored in `useRandom.ts`.
- [Removing scene climate could confuse existing saved scenes that still contain `weather_and_atmosphere`] → the column and type field remain; nothing is deleted; the compiled prompt simply no longer reads it (it never did — `sceneText()` only reads env/location/lighting/camera).
- [New block expands sidebar/dashboard surface] → negligible; matches the existing six-toggle pattern and drag & drop handles it.
- [`time` block compiles while `lighting` does not — inconsistent] → intentional and documented; rendering lighting's section is out of scope for this change.

## Open Questions

- None blocking. Exact `timeText()` phrasing can be tuned during implementation; format above is a placeholder subject to prompt quality review.