## Why
Creators and Community Managers waste minutes per image hunting the right prompt structure ("character + pose + outfit + scene + lighting"). They currently start from a blank page and cobble inconsistent, non-reusable prompts. HumanImagesPrompts shall give them composable, editable, named prompt blocks so a single character asset (or outfit, pose, scene, lighting) can be reused across unlimited compositions. Why now: AI image generation (Midjourney, Flux, SDXL) is mainstream, but prompt authoring is still chaotic and error-prone.

## What Changes
- Add a single-user (admin) login flow with email + password.
- Add five independent, toggleable prompt-block editors: Character, Pose, Outfit, Scene, Lighting.
- Persist each block as a named asset using normalized (tabler) database tables — no JSON columns for domain data.
- Compile selected/ active blocks into one editable plain-text prompt with a single "Copy to clipboard" button.
- Add a searchable asset library with debounced autocomplete that pre-fills the editor on selection.
- Out of scope for this MVP: multi-user accounts, canonical JSON export, and direct AI model execution.

## Capabilities
- New Capabilities:
  - `auth-single-user`
  - `prompt-builder`
  - `asset-library`
  - `prompt-compiler`
- Modified Capabilities: (none — greenfield project)

## Impact
- New Symfony API endpoints grouped by domain under src/<Domain>/Api/.
- New Nuxt 4 (Vue 3) frontend consuming the API, with a Pinia store per prompt block.
- New database tables: user, character, pose, outfit, garment_slot, scene, lighting.
- No breaking changes to existing repository (this is a greenfield init).
