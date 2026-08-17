# garment-catalog Specification

## Purpose
Provide a complete CRUD catalog of garments (`/api/garments`) with namespaced tags for filtering, serializable garment slots in outfits, an exhaustive seeder from the Ropa document, and a frontend picker modal for reusing garments in outfits.

## Requirements

### Requirement: Garment CRUD API
The system SHALL expose a RESTful CRUD API at `/api/garments` for the Garment entity, reusing the `AssetCrudTrait` pattern.

#### Scenario: List all garments
- **WHEN** authenticated admin requests `GET /api/garments`
- **THEN** response returns `{ data: Garment[], count: number }` with all garments including `tags` array

#### Scenario: Get single garment
- **WHEN** authenticated admin requests `GET /api/garments/{id}`
- **THEN** response returns the garment with all fields including `tags`

#### Scenario: Create garment
- **WHEN** authenticated admin POSTs to `/api/garments` with `{ name, category, sub_category, fit, fabric, primary_color, secondary_color?, pattern?, tags? }`
- **THEN** response 201 with created garment including generated UUID

#### Scenario: Update garment
- **WHEN** authenticated admin PUTs to `/api/garments/{id}` with partial fields
- **THEN** response returns updated garment

#### Scenario: Delete garment
- **WHEN** authenticated admin DELETEs `/api/garments/{id}`
- **THEN** response 204; garment removed unless referenced by existing `GarmentSlot` (then 409 or cascade null)

### Requirement: Garment tags taxonomy
The system SHALL support namespaced tags in `Garment.tags` (JSON array) with the following namespaces and canonical values:
- `gender:female|male|unisex`
- `season:spring|summer|autumn|winter`
- `weather:cold|cool|mild|hot|rain|snow|wind`
- `occasion:casual|formal|business|street|sport|elegant|beach|evening|period`
- `environment:urban|nature|studio|indoor|outdoor`

#### Scenario: Filter garments by tags in frontend
- **WHEN** frontend queries `/api/garments` (or cached store) with tag filters `gender:female,occasion:beach`
- **THEN** only garments whose `tags` array includes ALL specified tags are returned

### Requirement: Outfit serializes and deserializes garments
The system SHALL persist and load garment slots in `Outfit` via `/api/outfits`.

#### Scenario: Create outfit with inline garments
- **WHEN** POST `/api/outfits` with `{ name, style_category, garments: [{ slot_type, garment: { ... } }] }`
- **THEN** response 201; outfit row created with `GarmentSlot` rows pointing to new `Garment` rows (cascade)

#### Scenario: Create outfit referencing catalog garments
- **WHEN** POST `/api/outfits` with `{ name, style_category, garments: [{ slot_type, garment_id }] }`
- **THEN** response 201; `GarmentSlot` rows point to existing `Garment` IDs

#### Scenario: Load outfit returns full garment data
- **WHEN** GET `/api/outfits/{id}`
- **THEN** response includes `garments: [{ slot_type, garment: Garment }]` with complete garment objects

#### Scenario: Update outfit replaces garment slots
- **WHEN** PUT `/api/outfits/{id}` with new `garments[]`
- **THEN** existing `GarmentSlot` rows replaced; new garments created or referenced accordingly

### Requirement: Enum alignment (categories, fit, style)
The system SHALL use backend enums as canonical; frontend UI options SHALL match exactly.

#### Scenario: Garment category options
- **WHEN** frontend renders `GarmentEditor` category select
- **THEN** options are `TOP`, `BOTTOM`, `FULL_BODY`, `FOOTWEAR`, `HEADWEAR`, `ACCESSORY` (no `DRESS`, `OUTERWEAR`, `SHOES`)

#### Scenario: Garment fit options
- **WHEN** frontend renders `GarmentEditor` fit select
- **THEN** options are `SKINNY`, `SLIM`, `REGULAR`, `OVERSIZED`, `TAILORED` (no `RELAXED`, `OVERSIZE`, `FORM_FITTING`)

#### Scenario: Outfit style category options
- **WHEN** frontend renders `OutfitEditor` style select
- **THEN** options are `CASUAL`, `FORMAL`, `ATHLETIC`, `HIGH_FASHION`, `TACTICAL`, `PERIOD_COSTUME` (no `BUSINESS`, `ATHLEISURE`, `EVENING`, `STREET`, `BOHEMIAN`)

### Requirement: Garment label (EN) for bilingual prompts
The system SHALL store an optional English label on `Garment.label` (nullable string) and use it in prompt compilation.

#### Scenario: Prompt uses label when present
- **WHEN** compiling outfit with garment having `label: "White Cotton Oversized T-Shirt"`
- **THEN** compiled text uses "White Cotton Oversized T-Shirt" instead of Spanish `name`

### Requirement: Exhaustive seeder from Ropa document
The system SHALL seed the database with all garment types from `docs/project_and_data.md` §Ropa, expanded by 2-3 colors/fabrics per base garment, with correct tags.

#### Scenario: Seeder creates representative catalog
- **WHEN** `php bin/console doctrine:fixtures:load` runs
- **THEN** `garment` table contains ≥ 500 rows covering all sections (pants, jackets, shirts, skirts, t-shirts, dresses, headwear, jewelry, lingerie, footwear, accessories) with `tags` populated per taxonomy

#### Scenario: Seeder creates example outfits
- **WHEN** fixtures load
- **THEN** `outfit` table contains ≥ 30 outfits combining catalog garments coherently by style/occasion/season

### Requirement: Frontend garment store and picker
The system SHALL provide `useGarmentStore` with fetch/filter and a `GarmentPicker` modal for selecting catalog garments into outfit slots.

#### Scenario: Fetch and filter garments
- **WHEN** `useGarmentStore().fetchAll()` completes
- **THEN** store holds all garments; `getBySlot('BASE_LAYER')` returns only BASE_LAYER-tagged garments; `filterByTags(['gender:female','occasion:formal'])` returns matching subset

#### Scenario: Pick garment from modal into outfit slot
- **WHEN** user opens picker for `OUTER_LAYER` slot, filters `gender:female`, selects garment
- **THEN** `OutfitEditor` calls `outfit.setGarment('OUTER_LAYER', selectedGarment)`; slot shows garment data

### Requirement: Migration adds Garment.label column
The system SHALL add nullable `label` column to `garment` table via Doctrine migration.

#### Scenario: Migration runs cleanly
- **WHEN** `php bin/console doctrine:migrations:migrate` executes
- **THEN** migration applied; `garment.label` column exists (nullable, string)