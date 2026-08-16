## 1. Project scaffolding
- [ ] 1.1 Initialize Nuxt 4 project in `frontend/` with TypeScript
- [ ] 1.2 Install TailwindCSS v4, Pinia 2, and Phosphor Icons
- [ ] 1.3 Configure nuxt.config (proxy /api → :8000, port 3000) and Tailwind
- [ ] 1.4 Create useApi composable with credentials + 401 interceptor
- [ ] 1.5 Build auth flow (login page, useAuthStore, middleware, /me check)
- [ ] 1.6 Build layout shell (sidebar + main + right panel) with responsive breakpoints

## 2. Types & stores
- [ ] 2.1 Define TypeScript DTOs (Character, Outfit, Pose, Scene, Lighting) + enums in `types/api.ts`
- [ ] 2.2 Implement useDashboardStore (active blocks, current tab)
- [ ] 2.3 Implement useCharacterStore with CRUD + save/load
- [ ] 2.4 Implement usePoseStore with CRUD + save/load
- [ ] 2.5 Implement useOutfitStore with CRUD + save/load
- [ ] 2.6 Implement useSceneStore with CRUD + save/load
- [ ] 2.7 Implement useLightingStore with CRUD + save/load
- [ ] 2.8 Implement useAssetLibraryStore (debounced search, load, delete)

## 3. UI primitives
- [ ] 3.1 UiButton, UiInput, UiSelect, UiToggle
- [ ] 3.2 UiAccordion, UiTabGroup, UiDropdown
- [ ] 3.3 UiToast + UiToastContainer + useToast composable

## 4. Block editors
- [ ] 4.1 CharacterEditor (tabs: demographics, cranial, skin, hair, eyes, grooming, makeup)
- [ ] 4.2 PoseEditor
- [ ] 4.3 OutfitEditor (garment slots)
- [ ] 4.4 SceneEditor
- [ ] 4.5 LightingEditor
- [ ] 4.6 BlockEditor wrapper (toggle header + collapsible + save button)

## 5. Asset library + prompt compiler
- [ ] 5.1 AssetLibrary component (debounced search, pre-fill editor, save/delete)
- [ ] 5.2 PromptCompiler component (compile, editable textarea, copy + toast)
- [ ] 5.3 LivePreview reactive component

## 6. Polish
- [ ] 6.1 Mobile-responsive layout (drawer, dvh units)
- [ ] 6.2 Dark/light theme toggle
- [ ] 6.3 End-to-end smoke test (login → edit character → save → compile → copy)
