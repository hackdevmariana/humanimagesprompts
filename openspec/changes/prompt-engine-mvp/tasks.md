## 1. Project scaffolding
- [ ] 1.1 Initialize Symfony project with security + api packs
- [ ] 1.2 Scaffold Nuxt 4 frontend with TailwindCSS + Pinia
- [ ] 1.3 Configure SQLite database
- [ ] 1.4 Create single-user login (admin@example.com / password)
- [ ] 1.5 Expose API base path and verify CORS/session cookie

## 2. Domains & persistence (tablas normalizadas)
- [ ] 2.1 Model Character entity + VO fields + migration
- [ ] 2.2 Model Pose entity + migration
- [ ] 2.3 Model Outfit entity (with garment_slot rows) + migration
- [ ] 2.4 Model Scene entity + migration
- [ ] 2.5 Model Lighting entity + migration
- [ ] 2.6 Seed admin user fixture

## 3. API layer
- [ ] 3.1 Auth controller (POST /login)
- [ ] 3.2 Character CRUD (GET/POST/PUT/DELETE /api/characters)
- [ ] 3.3 Pose CRUD
- [ ] 3.4 Outfit CRUD
- [ ] 3.5 Scene CRUD
- [ ] 3.6 Lighting CRUD
- [ ] 3.7 Asset search/autocomplete endpoint (GET /api/assets/search)

## 4. Prompt builder UI
- [ ] 4.1 PromptBuilder Pinia store module (per-block slices + active flags)
- [ ] 4.2 CharacterForm component + live preview
- [ ] 4.3 PoseForm component
- [ ] 4.4 OutfitForm component
- [ ] 4.5 SceneForm component
- [ ] 4.6 LightingForm component
- [ ] 4.7 Block toggle + accordion layout

## 5. Asset library
- [ ] 5.1 Asset CRUD integration in each form (Save / Load / Delete)
- [ ] 5.2 Autocomplete search component (debounced 300 ms)
- [ ] 5.3 Pre-fill editor on selection

## 6. Prompt compiler
- [ ] 6.1 PromptCompiler PHP service
- [ ] 6.2 Compile endpoint (POST /api/compile)
- [ ] 6.3 Editable textarea + Copy button (clipboard API)
- [ ] 6.4 Toast notification on copy

## 7. Polish
- [ ] 7.1 Dashboard layout (responsive accordion/modals)
- [ ] 7.2 Mobile-responsive Tailwind
- [ ] 7.3 Run OpenSpec validate spec for all 4 specs
- [ ] 7.4 Archive change: openspec archive prompt-engine-mvp
