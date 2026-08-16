# Design: Frontend Modular Prompts

## Context

The `frontend-dashboard` change delivered a working Nuxt 4 dashboard: five toggleable block editors (Personaje, Pose, Outfit, Escenario, Iluminación) backed by one Pinia store per block, an asset library, a global prompt compiler (`POST /api/compile`), and a live preview. The visual system is "Precision Tech Editorial" (iris/indigo accent, Inter, 150ms ease-out micro-motion, `active:scale-[0.97]`).

The backend compiler is already block-agnostic: `normalizeCanonical()` in `PromptCompiler.php` only processes keys present in the payload. Sending a single-block composition (e.g. `{ pose: {...} }`) compiles just that block, so section prompts need no backend changes.

## Goals / Non-Goals

**Goals:**
- Per-block prompt compilation shown in an inline copyable box.
- Client-side random population of block fields from documented taxonomies.
- Drag & drop visual reordering of block cards, independent of canonical prompt order.
- Reuse the existing design system and compilation pipeline.

**Non-Goals:**
- Outfits (random generation and section prompts) — deferred.
- Backend API changes.
- Loading `docs/project_and_data.md` into stores (separate discussion).
- Persisting visual card order across sessions (session-only).

## Decisions

### 1. Section prompts reuse `POST /api/compile` with a single-block payload
Send only the target block's store slice to the existing endpoint and render `compiled_text` inline. The backend's `normalizeCanonical` already supports partial compositions.
- **Alternatives considered:** local text template mirroring the backend — rejected (drifts from backend formatting; the backend quirks like "urban scene: ," are already visible in the global flow and keeping one source of truth is simpler).

### 2. Random generation is client-side reference tables
`useRandom.ts` holds static reference tables per supported block (personaje, pose, escenario, iluminación), mirroring the documented taxonomies, and a `randomize(blockKey)` function that writes valid values into the store slice. Values must be selectable in existing dropdowns/inputs.
- **Alternatives considered:** backend `GET /api/random/{block}` endpoint — rejected by the user (frontend only makes sense when the backend returns all values, which it does). Server-driven option noted for future if the value set grows.

### 3. Visual order lives in `useDashboardStore.uiOrder`; canonical order stays hardcoded
The store keeps `uiOrder` (array of active block keys in visual order, session-scoped). The canonical compile order (`character → pose → outfit → scene → lighting`) is a separate constant used by the global compiler. Card rendering iterates `uiOrder`; compile iterates the canonical constant.
- **Rationale:** deterministic prompts regardless of how the operator arranges cards; this matches the user's requirement that the visual arrangement aids human association while prompt importance stays canonical.

### 4. Drag & drop via `vue-draggable-next`
Wrap the rendered card list in `vue-draggable-next` with `handle=".drag-handle"` so only the handle initiates drags. `@change` writes the new order back to `uiOrder`. Handle is hover-revealed with the existing micro-motion language.
- **Alternatives considered:** HTML5 native DnD — more code, worse touch/a11y story; rejected in favor of the well-integrated library.

### 5. Header actions per card
Each `BlockEditor` card header gains, alongside existing Guardar/Cargar actions: "Crear prompt" and "Carga aleatoria". Section prompt output renders in a mono-styled inline box at the bottom of the card with a copy button. Outfit card omits the randomize action.
- **Component touch points:** `BlockEditor.vue` (header actions + inline box), `dashboard.vue` (draggable list), `useDashboardStore` (uiOrder), new `useSectionPrompt.ts`, new `useRandom.ts`.

## Risks / Trade-offs

- Reference tables in `useRandom.ts` may drift from backend enums → generation reads values only from the existing store option lists where possible; tables are the single source for option values.
- Dragging while a save/load is in flight could reorder mid-request → card order is session state only and compile is canonical, so impact is cosmetic.
- Section prompt via backend adds a round-trip per generation → acceptable; global compile already does the same and results stay consistent.
- `vue-draggable-next` adds a dependency → pinned version; no functional impact on the rest of the app.

## Open Questions

- None blocking. Deferred: outfit taxonomy from `docs/project_and_data.md`.