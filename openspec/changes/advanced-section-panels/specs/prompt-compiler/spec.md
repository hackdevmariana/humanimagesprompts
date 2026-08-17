# prompt-compiler Specification (Delta)

## Purpose
Extended to interpret `prompt_modifiers` in each canonical block and render weights, conditionals, and tags in the compiled text, with motor-specific syntax adaptation.

## MODIFIED Requirements

### Requirement: Compile active blocks into a plain-text prompt
The system SHALL merge data from all active blocks into a single editable plain-text prompt string. Inactive blocks SHALL be excluded from the compiled output. **Each block's canonical data MAY include `prompt_modifiers` array. The compiler SHALL apply modifiers when rendering each section:**
- **Weight**: wrap the rendered token for `target` in `(token:weight)` (Flux/SDXL) or `token::weight` (Midjourney).
- **Conditional**: replace the rendered token for `target` with `[opt1|opt2|...]`.
- **Tag**: append `value` as comma-separated suffix to the section text.

#### Scenario: Weight modifier rendered for Flux
- **WHEN** compiling for `FLUX_1_DEV`
- **GIVEN** `outfit.prompt_modifiers` includes `{ type: 'weight', target: 'style_category', value: 'formal', weight: 1.4 }`
- **THEN** outfit section text contains `(formal:1.4)` (or wraps the rendered style token)

#### Scenario: Weight modifier rendered for Midjourney
- **WHEN** compiling for `MIDJOURNEY`
- **GIVEN** same weight modifier
- **THEN** outfit section uses Midjourney syntax `formal::1.4`

#### Scenario: Conditional modifier rendered
- **WHEN** compiling any motor
- **GIVEN** `character.prompt_modifiers` includes `{ type: 'conditional', target: 'hair_profile.andre_walker_type', options: ['TYPE_1','TYPE_2A'] }`
- **THEN** character section contains `[TYPE_1|TYPE_2A]` in place of the hair type token

#### Scenario: Tag modifier rendered
- **WHEN** compiling any motor
- **GIVEN** `scene.prompt_modifiers` includes `{ type: 'tag', target: 'environment_type', value: 'cinematic' }`
- **THEN** scene section text ends with ", cinematic"

#### Scenario: Multiple modifiers on same block
- **WHEN** block has weight + conditional + tag modifiers
- **THEN** all are applied in order: conditional replaces token, weight wraps result, tag appends

#### Scenario: Modifiers ignored for inactive blocks
- **WHEN** a block is toggled off in dashboard
- **THEN** its `prompt_modifiers` (if any in overrides) are excluded from compilation

### Requirement: Prompt is editable before copying
(Unchanged)

### Requirement: Copy prompt to clipboard
(Unchanged)