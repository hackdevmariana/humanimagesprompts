## ADDED Requirements

### Requirement: Outfit block shows randomize button
The Outfit block in the editor SHALL display the "Carga aleatoria" button when the block is active.

#### Scenario: Button visible in Outfit block
- **WHEN** user navigates to the Outfit block in the dashboard editor
- **THEN** the "Carga aleatoria" button is visible in the block header

### Requirement: Randomize generates contextual outfit
Clicking "Carga aleatoria" in the Outfit block SHALL generate a contextual outfit using character gender, current time/weather, and scene environment.

#### Scenario: Generates outfit with gender tag
- **WHEN** user clicks "Carga aleatoria" in Outfit block AND character store has gender "FEMALE"
- **THEN** generated outfit includes garments tagged with `gender:female`

#### Scenario: Generates outfit with season tag
- **WHEN** user clicks "Carga aleatoria" in Outfit block AND time store has season "WINTER"
- **THEN** generated outfit includes garments tagged with `season:winter`

#### Scenario: Generates outfit with weather tag
- **WHEN** user clicks "Carga aleatoria" in Outfit block AND time store has weather "RAINY"
- **THEN** generated outfit includes garments tagged with `weather:rain`

#### Scenario: Generates outfit with environment tag
- **WHEN** user clicks "Carga aleatoria" in Outfit block AND scene store has environment "URBAN"
- **THEN** generated outfit includes garments tagged with `environment:urban`

#### Scenario: Falls back when no tagged garments match
- **WHEN** user clicks "Carga aleatoria" AND no garments match all context tags
- **THEN** system falls back to any garment of the required category

#### Scenario: Avoids duplicate garments
- **WHEN** user clicks "Carga aleatoria" AND multiple slots require same category
- **THEN** each slot receives a different garment

### Requirement: FULL_BODY handling in base layer
The generator SHALL set `hasFullBodyInBase` flag when a FULL_BODY garment is selected in BASE_LAYER.

#### Scenario: FULL_BODY flag set
- **WHEN** generator selects a FULL_BODY garment for BASE_LAYER
- **THEN** `hasFullBodyInBase` is true (note: skipping MID/OUTER not yet implemented)