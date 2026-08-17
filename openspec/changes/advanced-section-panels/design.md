## Context

**Estado actual:**
- `dashboardStore` tiene `appliedOverrides: Array<{target_path, overridden_value}>` usado para mutaciones puntuales (ej. cambiar color de ojos).
- `PromptCompiler.applyOverrides()` aplica overrides por path en el canonical antes de compilar.
- `BlockEditor.vue` renderiza el editor simple por bloque (CharacterEditor, OutfitEditor, etc.) sin controles avanzados.
- Canonical de bloques no tiene campo `prompt_modifiers`.
- Motor de prompts objetivo (Flux/Midjourney/SDXL) soporta pesos `(token:1.2)`, condicionales `[a|b]`, tags booru.

## Goals / Non-Goals

**Goals:**
1. Añadir `prompt_modifiers[]` opcional en canonical de cada bloque (Character, Outfit, Pose, Scene, Lighting, TimeWeather).
2. `PromptCompiler` renderiza modificadores: pesos envolviendo tokens, condicionales como alternativas, tags como sufijos.
3. UI: acordeón "Avanzado" colapsable en `BlockEditor` por bloque activo — chips de tags, lista de modificadores (tipo, target, value, weight), botón añadir/eliminar.
4. Persistencia vía `dashboard.appliedOverrides` con `target_path` = `block.prompt_modifiers` (array completo) o paths granulares.
5. Sincronización: panel avanzado y editor simple coexisten; overrides se aplican en compile.

**Non-Goals:**
- Rutas dedicadas por área (fase 2: `dedicated-area-routes`).
- Validación semántica de pesos/condicionales (solo sintaxis).
- Versionado de overrides.

## Decisions

### 1. Estructura `prompt_modifiers` en canonical
**Formato:**
```ts
type PromptModifier = 
  | { type: 'weight'; target: string; value: string; weight: number }      // (value:weight)
  | { type: 'conditional'; target: string; options: string[] }           // [opt1|opt2|opt3]
  | { type: 'tag'; target: string; value: string };                      // tag suelto
```
**Por qué:** Cubre los tres patrones principales (pesos, alternativas, tags booru). `target` indica qué campo del bloque afecta (ej. `outfit.style_category`, `character.hair_profile.andre_walker_type`). Array permite múltiples modificadores por bloque.

### 2. Persistencia vía `appliedOverrides` existente
**Diseño:** Un override con `target_path: 'outfit.prompt_modifiers'` y `overridden_value: PromptModifier[]`.
**Por qué:** Reutiliza infraestructura existente (`dashboardStore.appliedOverrides`, `PromptCompiler.applyOverrides`). No requiere nuevos endpoints ni cambios en BD. El override reemplaza el array completo (simplicidad). Alternativa granular (un override por modificador) añade complejidad de merge.

### 3. Renderizado en `PromptCompiler`
**Lógica por bloque en `buildText`:**
- Antes de renderizar sección, si `canonical[block].prompt_modifiers` existe:
  - Para cada modificador:
    - `weight`: envuelve el token renderizado de `target` en `(token:weight)`.
    - `conditional`: reemplaza token de `target` por `[opt1|opt2|...]`.
    - `tag`: añade `value` como sufijo separado por coma.
**Por qué:** Mínimo invasivo; el compiler ya itera bloques en orden canónico. Los modificadores se aplican sobre el token que se va a renderizar para ese campo.

### 4. UI: Acordeón "Avanzado" en `BlockEditor.vue`
**Componentes:**
- `AdvancedPanel.vue` (nuevo, genérico): recibe `blockKey`, `modifiers` (array reactivo), emite `update:modifiers`.
- Secciones: Tags (chips editables), Modificadores (lista con tipo/target/value/weight, botón +/–).
- Integración: `BlockEditor` importa y renderiza `<AdvancedPanel :blockKey="key" :modifiers="modifiers" @update:modifiers="saveModifiers" />` dentro de `<UiAccordion title="Avanzado" :default-open="false">`.
**Por qué:** Componente único reutilizable para los 6 bloques; `modifiers` viene de `dashboard.appliedOverrides` filtrado por bloque.

### 5. Sincronización editor simple ↔ avanzado
**Regla:** Editor simple escribe campos directos en store (ej. `outfit.data.style_category`). Panel avanzado escribe overrides en `appliedOverrides`. En compile, overrides ganan (se aplican sobre canonical). Si usuario borra override, vuelve a valor de store.
**Por qué:** Separación de concerns; editor simple = valores base; avanzado = ajustes de prompt.

## Risks / Trade-offs

| Riesgo | Mitigación |
|--------|------------|
| Overrides array completo reemplaza → perder cambios concurrentes | Un solo usuario (admin) en MVP; futuro: merge granular. |
| `target` string frágil (typos) | Documentar paths canónicos en `docs/domain/canonical-paths.md`; type-check en TypeScript via `PromptModifier` type. |
| Pesos/condicionales no soportados por todos los motores | `PromptCompiler.modelTail` ya distingue motor; renderizado condicional por motor (solo Flux/SDXL usan pesos; Midjourney usa `::weight`). |
| Acordeón "Avanzado" añade complejidad visual | Default cerrado; solo usuarios que lo necesitan lo abren. |

## Migration Plan

1. Backend: extender `PromptCompiler` + tipo `PromptModifier` en `types/api.ts` (frontend).
2. Frontend: `AdvancedPanel.vue`, integración en `BlockEditor`, helpers en `dashboardStore` para leer/escribir modifiers por bloque.
3. Verificación: `php bin/phpunit` (compiler tests), `npx nuxi typecheck`, smoke manual.

## Open Questions

1. ¿Sintaxis condicional: `[a|b]` (Midjourney) vs `{a|b}` (SDXL)? MVP: `[a|b]`, compiler adapta por motor.
2. ¿Tags como sufijo global o por campo? MVP: por campo (`target` + `value`).