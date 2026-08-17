## ADDED Requirements

### Requirement: Compiler translates color names ES→EN
The `PromptCompiler::colorText()` method SHALL translate Spanish color names to English using a static map of 63 unique colors from the catalog.

#### Scenario: Known color translated
- **WHEN** `colorText()` receives `['color_name' => 'Blanco', 'hex_code' => '#FFFFFF']`
- **THEN** returns `"White #FFFFFF"`

#### Scenario: Known color translated - Gris marengo
- **WHEN** `colorText()` receives `['color_name' => 'Gris marengo', 'hex_code' => '#4A4A4A']`
- **THEN** returns `"Dark gray #4A4A4A"`

#### Scenario: Known color translated - Azul marino
- **WHEN** `colorText()` receives `['color_name' => 'Azul marino', 'hex_code' => '#1A237E']`
- **THEN** returns `"Navy #1A237E"`

#### Scenario: Unknown color falls back to original name
- **WHEN** `colorText()` receives a color name not in the map (e.g., `'color_name' => 'ColorNuevo'`)
- **THEN** returns `"ColorNuevo #HEX"` (original name + hex)

#### Scenario: Null palette returns default
- **WHEN** `colorText()` receives `null`
- **THEN** returns `"natural color"`

#### Scenario: Missing hex returns color name only
- **WHEN** `colorText()` receives `['color_name' => 'Blanco']` without hex_code
- **THEN** returns `"White"` (translated name only)