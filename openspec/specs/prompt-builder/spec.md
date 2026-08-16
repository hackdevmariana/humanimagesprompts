# prompt-builder Specification

## Purpose
Five independent, toggleable prompt-block editors (Personaje, Pose, Outfit, Escenario, Iluminacion) built as Vue 3 components backed by per-block Pinia stores. Each block can be activated/deactivated independently; deactivating hides the editor and excludes its data from compilation. Built as part of the `frontend-dashboard` change.
## Requirements
### Requirement: Five toggleable prompt-block editors
The UI SHALL present five independent, toggleable editors: Personaje, Pose, Outfit, Escenario, Iluminacion. Each editor SHALL be independently activatable or deactivatable, and deactivating a block SHALL NOT mutate its stored data.

#### Scenario: Toggle off a block
- **WHEN** the user toggles off the Escenario block
- **THEN** Escenario data is excluded from the compiled prompt
- **THEN** the Escenario editor panel is hidden

#### Scenario: Reactivate a deactivated block
- **WHEN** the user deactivates and then reactivates the Outfit block
- **THEN** the previously entered Outfit values are still present

### Requirement: Reactive block state
Each editor SHALL bind to its own Pinia store slice so that changes propagate in real time without a full page reload.

#### Scenario: Real-time update
- **WHEN** the user edits the Character gender field
- **THEN** the Character store slice updates immediately
- **AND** any live preview reflects the new value

### Requirement: Block activation persists within the session
The active/inactive state of each block SHALL be tracked in client-side reactive state for the duration of the browser session.

#### Scenario: Persist toggle across editor interactions
- **WHEN** the user toggles off the Iluminacion block
- **THEN** the block remains off while the user interacts with other blocks

