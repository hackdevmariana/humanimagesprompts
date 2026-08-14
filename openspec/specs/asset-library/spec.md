# asset-library Specification

## Purpose
TBD - created by archiving change prompt-engine-mvp. Update Purpose after archive.
## Requirements
### Requirement: Save a block as a named asset
The system SHALL allow saving any block state (Character, Pose, Outfit, Scene, Lighting) as a named asset tied to the admin user. Assets SHALL be stored in normalized database tables (separate table per domain with scalar columns — no JSON blobs for domain data).

#### Scenario: Save a Character asset
- **WHEN** the user enters Character values
- **AND** the user submits the name "Elena Model" to Save Asset
- **THEN** a new row is inserted in the character table with the admin user_id and name "Elena Model"

### Requirement: Search assets via autocomplete
The system SHALL provide an autocomplete search input that fuzzy-matches asset names (per domain) and pre-fills the corresponding editor when an asset is selected.

#### Scenario: Find and load an asset
- **WHEN** the user types "elena" in the asset search bar
- **THEN** the autocomplete lists "Elena Model" as a match
- **AND** when the user clicks the suggestion
- **THEN** the Character editor is pre-filled with the saved values

### Requirement: Edit and delete saved assets
Saved assets SHALL be editable (overwrite existing asset; no versioning in MVP) and deletable (with confirmation).

#### Scenario: Delete an asset
- **WHEN** the user clicks Delete on the "Elena Model" asset
- **THEN** the row is removed from the character table
- **AND** it no longer appears in search results

#### Scenario: Edit an asset and re-save
- **WHEN** the user loads "Elena Model"
- **AND** modifies values
- **AND** saves
- **THEN** the existing row in the character table is updated in place

