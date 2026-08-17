# outfit-editor-template Specification

## Purpose
Fix the Vue template compile error in `OutfitEditor.vue` caused by two sibling `v-else` elements sharing a single `v-if`, and ensure the empty-slot state renders both the informative text and the "Catálogo" picker button correctly.

## Requirements

### Requirement: Single v-else chain per v-if
The template SHALL contain exactly one `v-else` (or `v-else-if` chain) adjacent to each `v-if` / `v-else-if`.

#### Scenario: Empty slot renders picker affordance
- **WHEN** `slots[slot]` is falsy for a given slot type
- **THEN** a single `v-else` block renders containing:
  - A text node "Sin prenda en este slot" (or equivalent)
  - A `<UiButton variant="ghost">` with `HangerIcon` and label "Catálogo" that calls `openPicker(slot)` on click
- **AND** no second sibling `v-else` element exists at the same level

#### Scenario: Filled slot renders editor and remove button
- **WHEN** `slots[slot]` is truthy
- **THEN** the `v-if` branch renders `<GarmentEditor>` with the garment data
- **AND** the remove button (`<UiButton>` with `XIcon`) renders in the adjacent column (outside the `v-if`/`v-else` chain, as currently implemented)

### Requirement: TypeScript typecheck passes
The component SHALL pass `npx nuxi typecheck` with exit code 0 after the template fix.

#### Scenario: Typecheck succeeds
- **WHEN** running `npx nuxi typecheck` in `frontend/`
- **THEN** no errors related to `OutfitEditor.vue` template structure