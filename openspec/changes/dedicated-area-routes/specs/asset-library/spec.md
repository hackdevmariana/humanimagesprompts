# asset-library Specification (Delta)

## Purpose
Extended to support asset pickers integrated in dedicated area route sidebars (not just modal in dashboard).

## MODIFIED Requirements

### Requirement: Search assets via autocomplete
The system SHALL provide an autocomplete search input that fuzzy-matches asset names (per domain) and pre-fills the corresponding editor when an asset is selected. **In dedicated area routes, the asset search SHALL be integrated persistently in the area sidebar (not modal), with domain pre-filtered to the area.**

#### Scenario: Persistent asset search in outfit route sidebar
- **WHEN** user visits `/outfit`
- **THEN** sidebar shows Garment picker grouped by slot with search/filter (not modal)
- **AND** selecting a garment populates the outfit slot immediately

#### Scenario: Persistent asset search in character route sidebar
- **WHEN** user visits `/character`
- **THEN** sidebar shows Character asset search with autocomplete
- **AND** selecting a character loads it into `characterStore`

### Requirement: Edit and delete saved assets
Saved assets SHALL be editable (overwrite existing asset; no versioning in MVP) and deletable (with confirmation). **Applies in dedicated area routes as well.**

#### Scenario: Delete asset from area route sidebar
- **WHEN** user clicks Delete on a garment in `/outfit` sidebar
- **THEN** the row is removed from the garment table
- **AND** it no longer appears in search results in sidebar

#### Scenario: Edit asset from area route sidebar
- **WHEN** user loads a garment from sidebar in `/outfit`
- **AND** modifies values in the main editor
- **AND** saves
- **THEN** the existing row in the garment table is updated in place