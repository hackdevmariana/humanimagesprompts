# advanced-section-panels Specification

## Purpose
Provide expandable "Avanzado" panels per block in the dashboard that allow editing structured prompt modifiers (weights, conditionals, tags) per section, persisted via the existing `appliedOverrides` mechanism and rendered by `PromptCompiler`.

## Requirements

### Requirement: Canonical blocks accept prompt_modifiers
The system SHALL allow each canonical block (Character, Outfit, Pose, Scene, Lighting, TimeWeather) to contain an optional `prompt_modifiers` array of structured modifiers.

#### Scenario: Block with prompt_modifiers in canonical
- **WHEN** `PromptCompiler.normalizeCanonical()` processes a composition
- **GIVEN** `composition.outfit.prompt_modifiers` exists with modifiers
- **THEN** `canonical.outfit.prompt_modifiers` is preserved and passed to `buildText()`

### Requirement: PromptModifier type definition
The system SHALL define `PromptModifier` as a discriminated union supporting three modifier types.

#### Scenario: Weight modifier structure
- **WHEN** creating a weight modifier
- **THEN** it has `{ type: 'weight', target: string, value: string, weight: number }` where `weight` is a positive float (e.g., 1.2)

#### Scenario: Conditional modifier structure
- **WHEN** creating a conditional modifier
- **THEN** it has `{ type: 'conditional', target: string, options: string[] }` with ≥2 options

#### Scenario: Tag modifier structure
- **WHEN** creating a tag modifier
- **THEN** it has `{ type: 'tag', target: string, value: string }`

### Requirement: Advanced panel UI per block
The system SHALL render an "Avanzado" accordion in `BlockEditor` for each active block, allowing view/edit of `prompt_modifiers`.

#### Scenario: Open advanced panel shows current modifiers
- **WHEN** user expands "Avanzado" accordion for Outfit block
- **GIVEN** `outfit.prompt_modifiers` has 2 modifiers
- **THEN** panel lists both modifiers with type, target, value, weight (if applicable)

#### Scenario: Add weight modifier via panel
- **WHEN** user clicks "Añadir modificador", selects "Peso", rellena target="style_category", value="formal", weight=1.3
- **THEN** modifier added to `outfit.prompt_modifiers`; `dashboard.appliedOverrides` updated with `target_path: 'outfit.prompt_modifiers'`

#### Scenario: Add conditional modifier via panel
- **WHEN** user adds conditional with target="character.hair_profile.andre_walker_type", options=["TYPE_1","TYPE_2A"]
- **THEN** modifier added; compiled prompt will render `[TYPE_1|TYPE_2A]` for that field

#### Scenario: Add tag modifier via panel
- **WHEN** user adds tag with target="scene.environment_type", value="cinematic"
- **THEN** modifier added; compiled prompt appends "cinematic" to scene description

#### Scenario: Delete modifier via panel
- **WHEN** user clicks delete on a modifier
- **THEN** modifier removed from array; override updated; compile reflects removal

### Requirement: Persistence via appliedOverrides
The system SHALL persist `prompt_modifiers` per block using `dashboard.appliedOverrides` with `target_path = '{blockKey}.prompt_modifiers'`.

#### Scenario: Override created on first modifier add
- **WHEN** first modifier added to Character block
- **THEN** `dashboard.appliedOverrides` gains entry `{ target_path: 'character.prompt_modifiers', overridden_value: [...] }`

#### Scenario: Override updated on modifier change
- **WHEN** user modifies existing modifier in panel
- **THEN** corresponding override `overridden_value` updated in place

#### Scenario: Override removed when modifiers array empty
- **WHEN** user deletes last modifier of a block
- **THEN** corresponding override entry removed from `appliedOverrides`

### Requirement: Compile reflects modifiers in real time
The system SHALL reflect advanced panel changes in the compiled prompt immediately (reactive).

#### Scenario: Weight appears in compiled text
- **WHEN** user adds weight modifier target="outfit.style_category", value="formal", weight=1.5
- **AND** clicks "Compile Prompt"
- **THEN** compiled text contains `(formal:1.5)` (or motor-specific syntax) in outfit section

#### Scenario: Conditional appears in compiled text
- **WHEN** user adds conditional target="character.hair_profile.andre_walker_type", options=["TYPE_1","TYPE_2A"]
- **AND** compiles
- **THEN** compiled text contains `[TYPE_1|TYPE_2A]` in character section

#### Scenario: Tag appears in compiled text
- **WHEN** user adds tag target="scene.environment_type", value="cinematic"
- **AND** compiles
- **THEN** compiled text contains "cinematic" appended to scene section