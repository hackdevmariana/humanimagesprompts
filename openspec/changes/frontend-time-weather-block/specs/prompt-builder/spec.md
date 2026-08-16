# prompt-builder Delta Spec

## MODIFIED Requirements

### Requirement: Six toggleable prompt-block editors
The UI SHALL present six independent, toggleable editors: Personaje, Pose, Outfit, Escenario, Iluminacion, Tiempo. Each editor SHALL be independently activatable or deactivatable, and deactivating a block SHALL NOT mutate its stored data.

#### Scenario: Toggle off a block
- **WHEN** the user toggles off the Escenario block
- **THEN** Escenario data is excluded from the compiled prompt
- **THEN** the Escenario editor panel is hidden

#### Scenario: Reactivate a deactivated block
- **WHEN** the user deactivates and then reactivates the Outfit block
- **THEN** the previously entered Outfit values are still present

#### Scenario: Toggle off the Tiempo block
- **WHEN** the user toggles off the Tiempo block
- **THEN** Tiempo data is excluded from the compiled prompt
- **THEN** the Tiempo editor panel is hidden