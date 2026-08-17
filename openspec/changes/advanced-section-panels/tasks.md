## 1. Backend — PromptCompiler extiende para prompt_modifiers

- [ ] 1.1 Añadir tipo `PromptModifier` en `backend/src/Service/PromptCompiler.php` (docblock o clase interna)
- [ ] 1.2 Modificar `PromptCompiler::buildText()`: detectar `canonical[block].prompt_modifiers[]` y aplicar antes de renderizar sección
- [ ] 1.3 Implementar `applyWeightModifier(token, weight, targetMotor)` → `(token:weight)` para Flux/SDXL, `token::weight` para Midjourney
- [ ] 1.4 Implementar `applyConditionalModifier(token, options)` → `[opt1|opt2|...]`
- [ ] 1.5 Implementar `applyTagModifier(sectionText, tagValue)` → append `, {tagValue}`
- [ ] 1.6 Test: `PromptCompilerTest` cubre pesos, condicionales, tags por motor (Flux, Midjourney, SDXL)

## 2. Frontend — Tipos y helpers

- [ ] 2.1 Añadir `PromptModifier` type en `frontend/app/types/api.ts` (union discriminada weight|conditional|tag)
- [ ] 2.2 Añadir helpers en `dashboardStore`: `getModifiers(blockKey)`, `setModifiers(blockKey, modifiers[])` que leen/escriben `appliedOverrides` con `target_path: '{blockKey}.prompt_modifiers'`
- [ ] 2.3 Test: `npx nuxi typecheck` pasa

## 3. Frontend — AdvancedPanel component

- [ ] 3.1 Crear `frontend/app/components/editor/AdvancedPanel.vue`: props `blockKey`, `modifiers` (array), emits `update:modifiers`
- [ ] 3.2 UI: sección "Tags" (chips editables, añadir/eliminar), sección "Modificadores" (lista con selector tipo, inputs target/value/weight, botón eliminar)
- [ ] 3.3 Accesibilidad: focus trap en acordeón, ESC cierra, ARIA en botones
- [ ] 3.4 Responsive: en móvil, panel como bottom-sheet slide-up

## 4. Frontend — Integración en BlockEditor

- [ ] 4.1 Importar `AdvancedPanel` en `BlockEditor.vue`
- [ ] 4.2 Renderizar `<UiAccordion title="Avanzado" :default-open="false"><AdvancedPanel :blockKey="block.key" :modifiers="modifiers" @update:modifiers="saveModifiers" /></UiAccordion>` al final del editor de cada bloque
- [ ] 4.3 `modifiers` computado desde `dashboardStore.getModifiers(block.key)`
- [ ] 4.4 `saveModifiers` llama `dashboardStore.setModifiers(block.key, newModifiers)`

## 5. Verificación

- [ ] 5.1 `php bin/phpunit` — tests compiler nuevos pasan
- [ ] 5.2 `npx nuxi typecheck` — sin errores
- [ ] 5.3 Smoke manual: login → dashboard → activar Character → abrir "Avanzado" → añadir peso en `hair_profile.andre_walker_type` → compilar → peso aparece en prompt → añadir condicional en `ethnicity` → compilar → condicional aparece → añadir tag en `scene` → compilar → tag aparece → cerrar/reabrir panel → modificadores persisten