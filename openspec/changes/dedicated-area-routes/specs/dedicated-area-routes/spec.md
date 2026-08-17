# dedicated-area-routes Specification

## Purpose
Provide dedicated full-page routes for each composition area (Character, Outfit, Pose, Scene, Time, Lighting) with full-screen editors, persistent advanced panels, and bidirectional synchronization with the central dashboard.

## Requirements

### Requirement: Dedicated routes for each area
The system SHALL provide 6 routes under Nuxt file-based routing: `/character`, `/outfit`, `/pose`, `/scene`, `/time`, `/lighting`.

#### Scenario: Navigate to character route
- **WHEN** user visits `/character`
- **THEN** page renders with `AreaLayout` showing Character editor full-width, AdvancedPanel visible, breadcrumb "← Composer"

#### Scenario: Navigate to outfit route
- **WHEN** user visits `/outfit`
- **THEN** page renders with Outfit editor + GarmentPicker integrated in sidebar, AdvancedPanel visible

#### Scenario: All 6 routes accessible
- **WHEN** visiting `/pose`, `/scene`, `/time`, `/lighting`
- **THEN** each renders corresponding editor in `AreaLayout` with breadcrumb

### Requirement: Shared AreaLayout component
The system SHALL provide a reusable `AreaLayout.vue` component that structures each area page.

#### Scenario: Layout structure
- **WHEN** any area page renders
- **THEN** DOM contains: header (breadcrumb "← Composer" + title + icon), sidebar (slot `sidebar`), main (slot `editor` with editor component + AdvancedPanel)

#### Scenario: Responsive sidebar
- **WHEN** viewport < 768px
- **THEN** sidebar collapses into slide-over drawer toggled by hamburger button in header

### Requirement: Navigation from dashboard to area routes
The system SHALL provide entry points from the dashboard to each area route.

#### Scenario: "Editar en profundidad" in BlockSidebar
- **WHEN** user hovers a block in `BlockSidebar`
- **THEN** an expand icon (⤢) appears next to the toggle
- **AND** clicking it navigates to `/${blockKey}`

#### Scenario: "Editar en profundidad" in BlockEditor header
- **WHEN** viewing a block in `BlockEditor`
- **THEN** header shows button "Editar en profundidad"
- **AND** clicking navigates to `/${blockKey}`

#### Scenario: Breadcrumb returns to composer
- **WHEN** on any area route
- **THEN** breadcrumb "← Composer" links to `/`
- **AND** pressing `Esc` key navigates to `/`

### Requirement: Synchronization with central stores
The system SHALL use existing Pinia stores as single source of truth; area routes read/write directly to stores.

#### Scenario: Change in area route reflects in dashboard
- **WHEN** user modifies `characterStore.data` in `/character`
- **THEN** dashboard (`/`) immediately shows updated values in `BlockEditor` for Character block

#### Scenario: Change in dashboard reflects in area route
- **WHEN** user modifies `outfitStore.data` in dashboard
- **THEN** `/outfit` immediately shows updated values

#### Scenario: AdvancedPanel modifiers sync
- **WHEN** user adds modifier in `AdvancedPanel` on `/outfit`
- **THEN** `dashboardStore.appliedOverrides` updated; dashboard compile reflects it
- **AND** vice versa: modifier added in dashboard appears in `/outfit` AdvancedPanel

### Requirement: Area-specific sidebar content
The system SHALL render area-appropriate content in the `AreaLayout` sidebar slot.

#### Scenario: Outfit sidebar shows GarmentPicker
- **WHEN** on `/outfit`
- **THEN** sidebar contains integrated `GarmentPicker` (not modal) grouped by slot, with tag filters

#### Scenario: Character sidebar shows asset search
- **WHEN** on `/character`
- **THEN** sidebar contains character asset search + saved characters list

#### Scenario: Other areas show relevant pickers
- **WHEN** on `/pose`, `/scene`, `/time`, `/lighting`
- **THEN** sidebar shows corresponding asset search/load UI