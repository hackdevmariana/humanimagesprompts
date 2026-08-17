# asset-library Specification (Delta)

## Purpose
Extended to include Garments as a searchable, pickable asset type alongside Characters, Poses, Outfits, Scenes, and Lightings.

## MODIFIED Requirements

### Requirement: Save a block as a named asset
The system SHALL allow saving any block state (Character, Pose, Outfit, Scene, Lighting, **Garment**) as a named asset tied to the admin user. Assets SHALL be stored in normalized database tables (separate table per domain with scalar columns — no JSON blobs for domain data).

#### Scenario: Save a Garment asset
- **WHEN** the user enters Garment values in the Garment editor
- **AND** the user submits the name "White Cotton Oversized T-Shirt" to Save Asset
- **THEN** a new row is inserted in the garment table with the admin user_id and name "White Cotton Oversized T-Shirt"

### Requirement: Search assets via autocomplete
The system SHALL provide an autocomplete search input that fuzzy-matches asset names (per domain) and pre-fills the corresponding editor when an asset is selected. **Garments SHALL be included in the unified `/api/assets/search` endpoint and filterable by domain.**

#### Scenario: Find and load a Garment asset via search
- **WHEN** the user types "white cotton" in the asset search bar
- **AND** selects domain filter "Garment"
- **THEN** the autocomplete lists "White Cotton Oversized T-Shirt" as a match
- **AND** when the user clicks the suggestion
- **THEN** the Garment editor is pre-filled with the saved values

### Requirement: Edit and delete saved assets
Saved assets SHALL be editable (overwrite existing asset; no versioning in MVP) and deletable (with confirmation). **Applies to Garments as well.**

#### Scenario: Delete a Garment asset
- **WHEN** the user clicks Delete on the "White Cotton Oversized T-Shirt" asset
- **THEN** the row is removed from the garment table
- **AND** it no longer appears in search results
- **AND** if referenced by existing `GarmentSlot`, deletion is blocked with 409 (or cascade null per design)

#### Scenario: Edit a Garment asset and re-save
- **WHEN** the user loads "White Cotton Oversized T-Shirt"
- **AND** modifies values
- **AND** saves
- **THEN** the existing row in the garment table is updated in place