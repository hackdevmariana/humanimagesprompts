# asset-library Delta Spec

## MODIFIED Requirements

### Requirement: Save a block as a named asset
The system SHALL allow saving any block state (Character, Pose, Outfit, Scene, Lighting, TimeWeather) as a named asset tied to the admin user. Assets SHALL be stored in normalized database tables (separate table per domain with scalar columns — no JSON blobs for domain data).

#### Scenario: Save a Character asset
- **WHEN** the user enters Character values
- **AND** the user submits the name "Elena Model" to Save Asset
- **THEN** a new row is inserted in the character table with the admin user_id and name "Elena Model"

#### Scenario: Save a TimeWeather asset
- **WHEN** the user enters season, time of day and day condition values
- **AND** the user submits a name to Save Asset
- **THEN** a new row is inserted in the `time_weather` table with the admin user_id and the submitted name