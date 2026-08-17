# prompt-compiler-lighting Specification

## Purpose
Ensure the `lighting` block from the frontend composition is included in the canonical JSON and rendered in the compiled prompt text with English labels, following the canonical order (after time).

## Requirements

### Requirement: Lighting block preserved in canonical
The system SHALL include the `lighting` block from the composition into the canonical output.

#### Scenario: Lighting present in composition appears in canonical
- **WHEN** `compile()` is called with a composition containing a `lighting` key
- **THEN** `result['canonical']['lighting']` exists and equals the input lighting object (after any normalization)

#### Scenario: Lighting absent from composition does not appear in canonical
- **WHEN** `compile()` is called without a `lighting` key in composition
- **THEN** `result['canonical']` does not have a `lighting` key

### Requirement: Lighting rendered in compiled text
The system SHALL render the lighting block into the compiled text with English labels.

#### Scenario: Full lighting block produces descriptive text
- **WHEN** composition includes `lighting` with `setup_type: 'BLUE_HOUR'`, `color_temperature: 'NEUTRAL_4500K'`, `key_light_direction: 'SIDE_90'`, `hardness: 'SEMI_SOFT'`
- **THEN** `compiled_text` contains a segment like "Lighting: blue hour lighting, neutral 4500k color temp, side 90 key, semi-soft."

#### Scenario: Lighting with modifiers includes them
- **WHEN** `lighting.modifiers = ['diffusion': 'softbox', 'fill': 'reflector']`
- **THEN** `compiled_text` contains "mods: diffusion: softbox, fill: reflector" (or similar) within the lighting segment.

#### Scenario: Lighting order is after time in canonical text
- **WHEN** composition has both `time` and `lighting` blocks
- **THEN** the `lighting` text appears after the `time` text in `compiled_text`.

### Requirement: English labels for all lighting enums
All lighting enum values exposed by the LightingEditor SHALL have English labels in `label()` map.

#### Scenario: Missing labels no longer fall back to auto-capitalized tokens
- **WHEN** `label('BLUE_HOUR')` is called
- **THEN** returns `'blue hour'` (not `'Blue Hour'`)
- **AND** similar for `STUDIO_HARSHELL`, `WINDOW_LIGHT`, `NEON`, `CANDLELIGHT`, `WARM_3200K`, `NEUTRAL_4500K`, `COOL_7000K`, `SIDE_90`, `BACK_45`, `OVERHEAD`, `UNDER`, `SEMI_SOFT`, `HARD_SHADOW`, `CONTRAST`.

### Requirement: Unit test coverage
The test suite SHALL cover the lighting block compilation.

#### Scenario: TestCompileWithLightingBlock passes
- **WHEN** running `php bin/phpunit --filter testCompileWithLightingBlock`
- **THEN** test passes, verifying canonical contains lighting and compiled_text includes "Lighting:".

#### Scenario: TestCompileOmitsLightingWhenAbsent passes
- **WHEN** running `php bin/phpunit --filter testCompileOmitsLightingWhenAbsent`
- **THEN** test passes.