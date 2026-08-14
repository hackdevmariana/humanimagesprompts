# prompt-compiler Specification

## Purpose
TBD - created by archiving change prompt-engine-mvp. Update Purpose after archive.
## Requirements
### Requirement: Compile active blocks into a plain-text prompt
The system SHALL merge data from all active blocks into a single editable plain-text prompt string. Inactive blocks SHALL be excluded from the compiled output.

#### Scenario: Successful compilation
- **WHEN** the user clicks "Compile Prompt"
- **GIVEN** Character, Outfit, and Iluminacion blocks are active (Escenario is toggled off)
- **THEN** the output contains formatted descriptions of Character, Outfit, and Iluminacion
- **AND** the Escenario block does not appear in the output

### Requirement: Prompt is editable before copying
The compiled prompt SHALL be displayed in an editable textarea so the user can hand-edit the text before copying.

#### Scenario: Edit compiled prompt
- **WHEN** the user modifies text in the compiled prompt textarea
- **THEN** the edited text is reflected on the next clipboard copy

### Requirement: Copy prompt to clipboard
The system SHALL provide a "Copy" button that writes the current (possibly edited) compiled prompt text to the system clipboard.

#### Scenario: Copy to clipboard
- **WHEN** the user clicks "Copy"
- **THEN** the compiled prompt text is written to the system clipboard
- **AND** a confirmation toast/notification is shown

