# prompt-compiler Specification (Delta)

## Purpose
Extended to correctly compile Outfit blocks by reading `garments[]` (GarmentSlot array) instead of `layers[]`, rendering per-garment detail with English labels, and using `Garment.label` EN when present.

## MODIFIED Requirements

### Requirement: Compile active blocks into a plain-text prompt
The system SHALL merge data from all active blocks into a single editable plain-text prompt string. Inactive blocks SHALL be excluded from the compiled output. **Outfit block SHALL be compiled from its `garments[]` array (GarmentSlot objects), rendering each garment with material, weight, name, color, pattern, and fit using English labels.**

#### Scenario: Successful compilation includes detailed outfit
- **WHEN** the user clicks "Compile Prompt"
- **GIVEN** Character, Outfit (with 3 garments), and Lighting blocks are active
- **THEN** the output contains formatted descriptions of Character, Outfit (listing each garment: "cotton heavyweight White Cotton Oversized T-Shirt (white, solid, oversized); denim heavyweight Vintage Denim Jacket (washed indigo blue, solid, oversized); leather heavyweight Black Leather Boots (black, solid, regular)"), and Lighting
- **AND** the Outfit description includes per-garment detail, not just style category

#### Scenario: Outfit compilation uses Garment.label EN when available
- **WHEN** compiling an Outfit where a garment has `label: "Black Leather Ankle Boots"`
- **THEN** the compiled text uses "Black Leather Ankle Boots" instead of the Spanish `name`

#### Scenario: Outfit compilation falls back to name if no label
- **WHEN** compiling an Outfit where a garment has no `label` but `name: "Botas de cuero negro"`
- **THEN** the compiled text uses the `name` value (or `sub_category` if name empty)

### Requirement: Prompt is editable before copying
The compiled prompt SHALL be displayed in an editable textarea so the user can hand-edit the text before copying. (Unchanged)

### Requirement: Copy prompt to clipboard
The system SHALL provide a "Copy" button that writes the current (possibly edited) compiled prompt text to the system clipboard. (Unchanged)