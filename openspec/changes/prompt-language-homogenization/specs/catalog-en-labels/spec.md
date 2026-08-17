## ADDED Requirements

### Requirement: Garment catalog items have English labels
Each garment base definition in the 9 catalog files SHALL include a `label` field with the English name.

#### Scenario: Label used in outfit prompt
- **WHEN** catalog item has `base: { name: 'Camiseta básica algodón', label: 'Basic cotton t-shirt', ... }`
- **THEN** `outfitText()` outputs `"cotton MEDIUM Basic cotton t-shirt (White #FFFFFF, SOLID, REGULAR)"`

#### Scenario: Falls back to name when label absent
- **WHEN** catalog item has no `label` (legacy)
- **THEN** `outfitText()` uses `name` (Spanish) as before

#### Scenario: Falls back to sub_category when both absent
- **WHEN** catalog item has no `label` and no `name`
- **THEN** `outfitText()` uses `sub_category` via `label()` map

### Requirement: Seeder persists label field
The `GarmentCatalogFixtures` SHALL read `$base['label'] ?? null` and persist it to the `Garment::setLabel()` field.

#### Scenario: Label saved to database
- **WHEN** fixtures load catalog with `label` fields
- **THEN** `Garment` entities have `label` populated and retrievable via `getLabel()`

### Requirement: All 209 catalog garments have labels
All 209 garment base definitions across the 9 catalog files SHALL have a non-empty `label` in English.

#### Scenario: Catalog completeness
- **WHEN** loading all catalog files
- **THEN** every base item has `label` key with non-empty string