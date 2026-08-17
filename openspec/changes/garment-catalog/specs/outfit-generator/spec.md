# outfit-generator Specification

## Purpose
Provide a contextual random outfit generator in `useRandom.ts` that creates coherent outfits based on character gender, time/weather block, and scene environment, respecting layering rules.

## Requirements

### Requirement: Contextual outfit generation
The system SHALL generate an outfit by filtering the garment catalog by tags derived from the current composition context.

#### Scenario: Generate outfit for female character in summer beach scene
- **WHEN** `useRandom().randomize('outfit')` is called
- **GIVEN** `characterStore.data.gender === 'FEMALE'`
- **AND** `timeStore.data.season === 'SUMMER'`
- **AND** `timeStore.data.weather === 'SUNNY'`
- **AND** `sceneStore.data.environment_type === 'NATURE'`
- **THEN** generated outfit uses garments tagged `gender:female|unisex`, `season:summer`, `weather:hot|mild`, `occasion:beach|casual`, `environment:nature|outdoor`

#### Scenario: Generate outfit for male character in winter urban night
- **WHEN** `useRandom().randomize('outfit')` is called
- **GIVEN** `characterStore.data.gender === 'MALE'`
- **AND** `timeStore.data.season === 'WINTER'`
- **AND** `timeStore.data.time_of_day === 'NIGHT'`
- **AND** `timeStore.data.weather === 'SNOWY'`
- **AND** `sceneStore.data.environment_type === 'URBAN'`
- **THEN** generated outfit uses garments tagged `gender:male|unisex`, `season:winter`, `weather:cold|snow`, `occasion:street|casual|elegant`, `environment:urban`

#### Scenario: Fallback when no tagged garments match
- **WHEN** context tags yield zero candidates for a slot
- **THEN** generator falls back to all garments of that slot type (ignoring tags) to avoid empty slots

### Requirement: Layering rules enforcement
The system SHALL respect domain layering rules when assigning garments to slots.

#### Scenario: No FULL_BODY with TOP/BOTTOM in base layer
- **WHEN** generator picks a `FULL_BODY` garment for `BASE_LAYER`
- **THEN** `MID_LAYER` and `OUTER_LAYER` slots are left empty or receive only layer-appropriate garments (no additional BASE_LAYER TOP/BOTTOM)

#### Scenario: One garment per slot
- **WHEN** generator fills slots
- **THEN** each of `BASE_LAYER`, `MID_LAYER`, `OUTER_LAYER`, `FOOTWEAR`, `HEADWEAR`, `ACCESSORIES` receives at most one garment

#### Scenario: No duplicate garment in same outfit
- **WHEN** generator selects garments
- **THEN** same `Garment` ID is never assigned to two different slots

### Requirement: Style category coherence
The system SHALL set `Outfit.style_category` based on predominant occasion tags of selected garments.

#### Scenario: Style matches occasion
- **WHEN** majority of picked garments have `occasion:formal`
- **THEN** `outfit.data.style_category === 'FORMAL'`

### Requirement: Pure generator function for testability
The system SHALL expose a pure function `generateOutfit(candidatesBySlot, contextTags)` that returns an outfit data object, decoupled from Pinia stores.

#### Scenario: Unit test generates valid outfit
- **WHEN** calling `generateOutfit(mockCandidates, { gender: 'female', season: 'summer' })`
- **THEN** returns object with `name`, `style_category`, `garments: GarmentSlot[]` satisfying layering rules