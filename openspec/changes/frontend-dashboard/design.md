# Design: Frontend Dashboard

## Design Read
Operate-mode dashboard for creator-tools users (image-generation prompt engineers), with a Linear-style minimalist language leaning toward Tailwind utilities + Phosphor icons + restrained motion.

## Dials
- `DESIGN_VARIANCE: 6`
- `MOTION_INTENSITY: 5`
- `VISUAL_DENSITY: 6`

## Visual Direction

### Color System
- Neutral base: Tailwind `stone` gray (warm, off-black backgrounds in dark mode, warm paper in light).
- Single accent color: `sky` (blue) for primary actions. No secondary accent to keep restraint.
- Theme: dual light/dark, respects `prefers-color-scheme`, toggle in topbar.

### Typography
- Display: **Inter** (default system sans, since this is a tool dashboard, not a brand landing — Inter is appropriate for data-dense UIs per the design skill override).
- Mono: **Fira Code** for technical token displays (hex codes, enum values).
- Scale: Body `text-sm`, labels `text-xs`, headings `text-lg` (sections) to `text-xl` (page title).

### Layout
- **Desktop (≥1024px):** Three-column layout.
  - **Left sidebar (w-72):** Block toggle list with status indicators.
  - **Main canvas (flex-1):** Active block editor(s) in accordion.
  - **Right panel (w-80):** Live preview (compiled text) + compile controls + asset library.
- **Tablet (768–1023px):** Sidebar collapses to icons, main canvas takes center.
- **Mobile (<768px):** Drawer for block selection, full-width editor, bottom sheet for compile.

### Motion
- Entry: `opacity` + `translate-y-1` fade-in per section (150ms ease-out).
- Hover: `scale-[1.02]` on buttons, `opacity-75` on secondary actions.
- State transitions: `transition-all duration-200` on inputs.
- Reduced motion: respect `prefers-reduced-motion`.

### Component Library (UI Primitives)

| Component | States | Notes |
|---|---|---|
| `UiButton` | default, primary, danger, ghost, icon | Rounded (`rounded-md`), consistent height (36px) |
| `UiInput` | default, error | Label above, helper text below, error text below |
| `UiSelect` | default, searchable | Native `<select>` styled, dropdown arrow via Phosphor |
| `UiToggle` | on/off | Switch-style, `bg-sky-600` when on |
| `UiAccordion` | open/closed | Chevron icon, smooth height transition |
| `UiTabGroup` | tabs | Character editor uses tabs |
| `UiToast` | success, error, info | Auto-dismiss 4s, manual close |
| `UiDropdown` | — | For enum selection with many options |

### Block Editor Layout

Each block editor follows the same structure:
1. **Header:** Block name + icon + toggle switch + save button.
2. **Body:** Collapsible form fields. Uses `UiTabGroup` for complex blocks (Character).
3. **Footer:** "Load asset" button (opens asset library).

### Character Editor Tabs
1. **Demographics** — gender, age, ethnicity
2. **Cranial** — cranial shape, facial structure, jawline, cheekbones, ear morphology
3. **Skin** — Fitzpatrick scale, undertone, finish, imperfections, freckle density
4. **Hair** — Andre Walker type, density, porosity, hairline
5. **Eyes** — primary/secondary color, heterochromia, eye shape, eyelash details
6. **Grooming** — hairstyle, length, colors, finish, facial hair
7. **Makeup** — style, lipstick, eyeshadow, eyeliner, blush, nails

### Asset Library Integration
- Search bar with 300ms debounced input (`useDebounceFn`).
- Results: type badge (character/pose/outfit/etc) + name/title + load button.
- Save button in each block header: POST to `/api/{collection}` with current form data.

### Prompt Compiler Panel
- "Compile Prompt" button → POST `/api/compile`.
- Result shown in editable `<textarea>` (monospace).
- Below: "Copy to clipboard" button → `navigator.clipboard.writeText` → toast "✓ Prompt copiado".
- Live preview above: truncated compiled text that updates reactively as blocks change.
