# time-weather-block Specification

## Purpose
Full-stack Tiempo block (season, time of day and day conditions) built as a Vue 3 editor backed by a Pinia store and a persisted `time_weather` asset domain. The block compiles into the canonical prompt in a new section placed after `scene`, supports section prompts and client-side random generation, and replaces the climate sub-section of the Escenario editor. Built as part of the `frontend-time-weather-block` change.

## Requirements

### Requirement: Tiempo block editor with three select fields
The system SHALL provide a Tiempo editor with three selects: Estación (primavera, verano, otoño, invierno), Hora del día (13 values: noche cerrada, madrugada, hora azul, amanecer, hora dorada, mañana, media mañana, mediodía, tarde, atardecer, anochecer, crepúsculo, noche) and El día (34 conditions: soleado, despejado, parcialmente nublado, nublado, cubierto, lluvioso, lloviznando, tormentoso, con chubascos, nevando, con aguanieve, con granizo, con niebla, con bruma, ventoso, con rachas de viento, polvoriento, con calima, húmedo, bochornoso, helado, frío, fresco, templado, caluroso, muy caluroso, con tormenta eléctrica, con arcoíris, con hielo, con rocío, con escarcha, variable, inestable, cambiante). The Tiempo block SHALL be toggleable independently, like the other blocks.

#### Scenario: Select values in the Tiempo block
- **WHEN** the user opens the Tiempo card
- **THEN** the three selects (Estación, Hora del día, El día) are shown with the documented option lists

#### Scenario: Toggle off the Tiempo block
- **WHEN** the user toggles off the Tiempo block
- **THEN** Tiempo data is excluded from the compiled prompt
- **AND** the Tiempo editor panel is hidden

### Requirement: Tiempo compiles into the canonical prompt after scene
The system SHALL include the active Tiempo block in the compiled plain-text prompt, rendered in canonical order immediately after the Escenario block (`character → pose → outfit → scene → time → lighting`). Inactive blocks SHALL remain excluded.

#### Scenario: Compile with Tiempo active
- **WHEN** the user compiles a prompt with the Tiempo block active and values "verano / hora dorada / soleado"
- **THEN** the output contains a section describing summer, golden hour and a sunny day
- **AND** that section appears after the Escenario section in the output

#### Scenario: Compile with Tiempo inactive
- **WHEN** the user compiles a prompt with the Tiempo block toggled off
- **THEN** the output contains no time/weather section

### Requirement: Persist Tiempo as a named asset
The system SHALL allow saving the Tiempo state as a named asset stored in a `time_weather` table with scalar columns, reusing the asset library CRUD (save, load via autocomplete, edit, delete).

#### Scenario: Save a Tiempo asset
- **WHEN** the user enters a season, time of day and day condition
- **AND** the user submits a name to Save Asset
- **THEN** a new row is inserted in the `time_weather` table

#### Scenario: Load a saved Tiempo asset
- **WHEN** the user searches for a saved Tiempo asset by name
- **AND** clicks the suggestion
- **THEN** the Tiempo editor is pre-filled with the saved values

### Requirement: Randomize the Tiempo block
The system SHALL provide a "Carga aleatoria" action on the Tiempo card that fills the three selects with a random, valid combination from the reference taxonomy, client-side and without persisting.

#### Scenario: Randomize Tiempo values
- **WHEN** the user clicks "Carga aleatoria" on the Tiempo card
- **THEN** season, time of day and day condition are populated with valid values present in the select options
- **AND** no asset is persisted

### Requirement: Section prompt for Tiempo
The system SHALL provide a "Crear prompt" action on the Tiempo card that compiles only the Tiempo block via `POST /api/compile` and shows the result in an inline copyable box.

#### Scenario: Generate a Tiempo section prompt
- **WHEN** the user clicks "Crear prompt" on the Tiempo card with values set
- **THEN** an inline box shows the compiled Tiempo section text with a copy button

### Requirement: Escenario editor no longer exposes climate fields
The Escenario editor SHALL NOT show the "Clima y atmósfera" section; season, time of day and day conditions are owned solely by the Tiempo block.

#### Scenario: Scene editor has no climate section
- **WHEN** the user opens the Escenario card
- **THEN** no climate/weather/time fields are rendered in it