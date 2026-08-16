# block-reorder Specification

## Purpose
Allow operators to reorder the block editor cards visually via drag & drop so they can arrange blocks by association (e.g., outfit next to scene) while keeping the compiled prompt order canonical and deterministic.

## Requirements

### Requirement: Draggable block cards
The block editor cards on the dashboard SHALL be reorderable by drag & drop using a visible drag handle. The visual order of cards SHALL persist for the browser session.

#### Scenario: Drag a block card to a new position
- **WHEN** the user drags the Outfit card to the position above the Escenario card
- **THEN** the Outfit card is displayed above the Escenario card
- **AND** the new visual order is retained for the rest of the session

#### Scenario: Drag handle provides affordance
- **WHEN** the user hovers over a block card
- **THEN** a drag handle is visible on the card
- **AND** the cursor indicates draggable movement

### Requirement: Visual order independent of canonical prompt order
Changing the visual order of cards SHALL NOT change the order in which blocks appear in the global compiled prompt. The compiled prompt SHALL always use the canonical block order.

#### Scenario: Reordered cards keep canonical prompt order
- **WHEN** the user drags the Escenario card to the top of the list
- **AND** then clicks "Compilar prompt"
- **THEN** the compiled prompt lists blocks in canonical order (character, pose, outfit, scene, lighting)
- **AND** the Escenario section does not appear first in the prompt

### Requirement: Block activation preserved during reorder
Dragging a card SHALL NOT change the active/inactive state of the block or mutate its stored data.

#### Scenario: Reorder preserves toggle state
- **WHEN** the user drags an inactive block's card and an active block's card
- **THEN** each card keeps its active/inactive state after the drag
- **AND** all stored values remain unchanged