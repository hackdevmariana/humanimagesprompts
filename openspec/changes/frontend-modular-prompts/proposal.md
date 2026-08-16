## Why

The dashboard compiles a single global prompt, but operators often want a prompt for just one block (personaje, pose, escenario, iluminación) to iterate on a section in isolation, and they waste time re-entering values. The visual order of the block cards is also fixed even though humans think in associations (outfit ↔ scene), and the block order users see is hardcoded.

## What Changes

- Add a **"Crear prompt"** action per block editor that compiles only that section, shows the result in an inline box at the bottom of the card, and offers a copy-to-clipboard button.
- Add a **"Carga aleatoria"** action per block editor that fills the section's fields with a random, coherent selection of valid values generated client-side (no backend round-trip).
- Make block cards **draggable** to reorder them visually via drag & drop (`vue-draggable-next`). The visual order is independent of the canonical prompt order.
- Keep the **canonical prompt order fixed** (character → pose → outfit → scene → lighting) so the compiled prompt stays deterministic regardless of the on-screen card order.
- Outfits are explicitly out of scope for random generation and section prompts in this change.

## Capabilities

### New Capabilities
- `section-prompt`: per-block prompt compilation with inline copy box
- `block-reorder`: draggable visual ordering of block cards, independent of canonical prompt order
- `random-block-load`: client-side random population of block fields (excluding outfits)

### Modified Capabilities
<!-- No existing spec-level requirements change. The canonical prompt order and
     active-block semantics defined by prompt-builder/prompt-compiler are preserved. -->

## Impact

- `frontend/` — new composables (`useSectionPrompt.ts`, `useRandom.ts`), a drag wrapper component, and updates to `BlockEditor.vue` (header actions + inline prompt box) and `dashboard.vue` (draggable list + visual order store).
- `package.json` — new dependency `vue-draggable-next`.
- Backend API: **no changes**. Section prompts reuse the existing `POST /api/compile` endpoint by sending only the target block's payload.
- Store state: `useDashboardStore` gains a `uiOrder` (visual card order) slice; canonical compile order stays derived from the fixed block list.
- No `docs/project_and_data.md` data-loading changes; outfits untouched.