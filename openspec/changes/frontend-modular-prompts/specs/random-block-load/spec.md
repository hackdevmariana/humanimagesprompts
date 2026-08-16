# random-block-load Specification

## Purpose
Provide a "Carga aleatoria" action per block editor (personaje, pose, escenario, iluminación; **excluding outfits**) that populates the block's fields with a random, internally coherent selection of valid values generated entirely client-side, using the documented taxonomies.

## Requirements

### Requirement: Randomize a block's fields
The system SHALL provide a "Carga aleatoria" action per supported block editor that fills the block's fields with a random selection of valid values from client-side reference tables. Supported blocks: personaje, pose, escenario, iluminación. The outfit block SHALL NOT offer this action.

#### Scenario: Randomize character block
- **WHEN** the user clicks "Carga aleatoria" on the Personaje card
- **THEN** each character field is populated with a valid value from the reference taxonomy
- **AND** the selected values are internally coherent (e.g., skin tone matches its valid undertone set)

#### Scenario: Randomize pose, scene, or lighting block
- **WHEN** the user clicks "Carga aleatoria" on a Pose, Escenario, or Iluminación card
- **THEN** the block's fields are populated with valid values from the reference taxonomy

#### Scenario: Outfit block has no randomize action
- **WHEN** the user views the Outfit card
- **THEN** no "Carga aleatoria" action is offered for it

### Requirement: Random values are valid for the UI
Randomly populated values SHALL be selectable in the corresponding dropdowns or inputs, so the user can continue editing without invalid selections.

#### Scenario: Randomized values match options
- **WHEN** a block is randomized
- **THEN** every populated value is present in the dropdown/input options for that field
- **AND** the block remains editable immediately after randomization

### Requirement: Randomization does not touch other blocks or persistence
Randomizing a block SHALL only mutate that block's store slice, SHALL NOT trigger a save, and SHALL NOT affect other blocks' data.

#### Scenario: Randomize is local and non-destructive
- **WHEN** the user randomizes the Personaje block while other blocks hold values
- **THEN** only the Personaje store slice changes
- **AND** the other blocks' values are unchanged
- **AND** no asset is persisted