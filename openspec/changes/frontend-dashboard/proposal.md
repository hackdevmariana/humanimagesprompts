## Why

The prompt-engine MVP (`prompt-engine-mvp`, archived 2026-08-14) delivered a fully functional Symfony 8.1 backend: single-user auth, five normalized asset CRUD endpoints (Character, Pose, Outfit, Scene, Lighting), fuzzy asset search, and a prompt compiler service. However, the product is unusable without a UI.

Creators and community managers currently cannot interact with the system at all. They have no way to:
- Log in and reach a dashboard
- Edit Character/Pose/Outfit/Scene/Lighting values visually
- Toggle blocks on/off for compilation
- Save/load named assets
- Compile a prompt and copy it to clipboard

## What Changes

- Initialize a Nuxt 4 (Vue 3) frontend with TypeScript, TailwindCSS v4, Pinia 2, and Phosphor Icons.
- Implement a session-cookie auth flow (login page → dashboard) that proxies /api to the Symfony backend on port 8000.
- Build five toggleable block editors (Personaje, Pose, Outfit, Escenario, Iluminación) backed by one Pinia store per block.
- Integrate the asset library: debounced autocomplete search, pre-fill editor on selection, save/load/delete.
- Wire the prompt compiler: POST /api/compile with active blocks, display editable textarea, copy-to-clipboard with toast.
- Make the dashboard responsive (mobile drawer, dvh units, viewport-safe layout).

## Capabilities

- New Capabilities:
  - `frontend-shell` — project scaffolding, auth flow, layout
  - `prompt-builder` — five toggleable editors with live preview
  - `prompt-compiler` — compile + edit + copy workflow
- Modified Capabilities:
  - `asset-library` — frontend integration with search/save/load/delete

## Impact

- New `frontend/` directory with Nuxt 4 project structure (composables, stores, components, pages).
- No breaking changes to the backend API. The existing REST contract is consumed as-is.
- CORS already configured for `http://localhost:3000`.
- Specs `prompt-builder` and `prompt-compiler` (promoted from the archived MVP) get their Purpose sections updated.
- A new spec `frontend-shell` covers scaffolding/auth/layout.
