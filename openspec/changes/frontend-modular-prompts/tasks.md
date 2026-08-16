## 1. Setup & dependencies

- [x] 1.1 Install `vue-draggable-next` in `frontend/`
- [x] 1.2 Add visual-order slice `uiOrder` to `useDashboardStore` with canonical order constant (character → pose → outfit → scene → lighting)

## 2. Random generation (client-side)

- [x] 2.1 Create `useRandom.ts` with static reference tables per supported block (personaje, pose, escenario, iluminación) mirroring documented taxonomies, excluding outfit
- [x] 2.2 Implement `randomize(blockKey)` that populates the corresponding store slice with valid, selectable values
- [x] 2.3 Wire "Carga aleatoria" action into each supported block card header; ensure Outfit card omits it

## 3. Section prompts

- [x] 3.1 Create `useSectionPrompt.ts` that sends a single-block payload to `POST /api/compile` and returns `compiled_text`
- [x] 3.2 Add "Crear prompt" action to each block card header; render result in inline mono box at the bottom of the card with copy button
- [x] 3.3 Show empty-state message when the block has no values; toast on copy

## 4. Drag & drop reorder

- [x] 4.1 Create drag wrapper component using `vue-draggable-next` with a handle-based drag trigger
- [x] 4.2 Render active block cards in `uiOrder` order inside the wrapper in `dashboard.vue`
- [x] 4.3 Sync drag reorder results back to `uiOrder`; ensure canonical order is used for global compile
- [x] 4.4 Style drag handle (hover-revealed, move cursor, iris micro-motion) and ensure toggles/data unaffected by drag

## 5. Verification

- [x] 5.1 Run `npx nuxi typecheck` with zero errors
- [x] 5.2 Smoke test in Playwright: login → "Carga aleatoria" populates personaje → "Crear prompt" shows inline box → copy toasts → drag reorders cards visually → global compile keeps canonical order