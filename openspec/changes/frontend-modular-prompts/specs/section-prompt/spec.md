# section-prompt Specification

## Purpose
Allow operators to compile a prompt for a single block (personaje, pose, escenario, iluminación, outfit) in isolation, display it in an inline copyable box at the bottom of that block's card, without affecting the global compilation workflow.

## Requirements

### Requirement: Compile a single block prompt
The system SHALL provide a "Crear prompt" action per block editor that compiles a prompt containing only that block's data, using the same compilation logic and canonical ordering rules as the global prompt, and displays the result in an inline box at the bottom of the card.

#### Scenario: Compile a block in isolation
- **WHEN** the user clicks "Crear prompt" on the Escenario card with scene values entered
- **THEN** a prompt is compiled using only the scene data
- **AND** the resulting text is displayed in an inline box at the bottom of the Escenario card

#### Scenario: Compile an empty block
- **WHEN** the user clicks "Crear prompt" on a block with no values entered
- **THEN** the system shows a message indicating the block has no values to compile
- **AND** no prompt box is shown

### Requirement: Copy the block prompt to clipboard
The inline block-prompt box SHALL include a copy button that writes the box's text to the system clipboard and shows a confirmation toast.

#### Scenario: Copy block prompt
- **WHEN** the user clicks the copy button on an inline block-prompt box
- **THEN** the block-prompt text is written to the system clipboard
- **AND** a confirmation toast is displayed

### Requirement: Block prompt does not affect global prompt
Generating a section prompt SHALL NOT mutate the block data, the active/inactive state of blocks, or the canonical order used by the global "Compilar prompt" action.

#### Scenario: Section prompt leaves state unchanged
- **WHEN** the user generates a section prompt for the Pose block
- **THEN** all block data and active states remain identical to before generation
- **AND** the global compiled prompt still includes all active blocks in canonical order