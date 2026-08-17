# prompt-builder Specification (Delta)

## Purpose
Extended to support structured `prompt_modifiers` per block via `appliedOverrides`, enabling the "Avanzado" panels to persist weights, conditionals, and tags that affect compilation.

## MODIFIED Requirements

### Requirement: Compile active blocks into a plain-text prompt
The system SHALL merge data from all active blocks into a single editable plain-text prompt string. Inactive blocks SHALL be excluded from the compiled output. **Each block's canonical data MAY include `prompt_modifiers` (array of weight/conditional/tag modifiers) which SHALL be persisted via `appliedOverrides` and rendered by `PromptCompiler`.**

#### Scenario: Successful compilation with prompt_modifiers
- **WHEN** the user clicks "Compile Prompt"
- **GIVEN** Character, Outfit, and Lighting blocks are active
- **AND** Outfit block has `prompt_modifiers` with a weight modifier on `style_category`
- **THEN** the output contains formatted descriptions of all three blocks
- **AND** the Outfit description reflects the weight modifier (e.g., `(formal:1.3)`)

### Requirement: Prompt is editable before copying
The compiled prompt SHALL be displayed in an editable textarea so the user can hand-edit the text before copying. **Modifications from `prompt_modifiers` are baked into the compiled text; user can further edit manually.**

### Requirement: Copy prompt to clipboard
The system SHALL provide a "Copy" button that writes the current (possibly edited) compiled prompt text to the system clipboard. (Unchanged)