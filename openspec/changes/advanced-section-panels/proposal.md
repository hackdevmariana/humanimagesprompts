## Why

La pantalla general (dashboard) permite construir composiciones con bloques, pero no ofrece control fino sobre cómo cada sección contribuye al prompt final: no hay pesos (`(word:1.2)`), condicionales (`[a|b]`), ni tags por sección. Los usuarios necesitan un nivel intermedio entre la UI simple y rutas dedicadas: paneles "Avanzado" expandibles por bloque que persisten modificadores estructurados vía `appliedOverrides` (mecanismo ya existente), manteniendo sincronización con la vista principal.

## What Changes

- **Nuevo** campo opcional `prompt_modifiers` en el canonical de cada bloque: array de `{ type: 'weight'|'conditional'|'tag', target: string, value: string, weight?: number }`.
- **Extensión `PromptCompiler`**: renderiza `prompt_modifiers` al compilar cada sección (pesos envolviendo tokens, condicionales como alternativas, tags como sufijos estilo booru).
- **UI**: acordeón "Avanzado" en `BlockEditor` por cada bloque activo — chips de tags, lista de modificadores (tipo/peso/condicional), persistencia en `dashboard.appliedOverrides` apuntando a `block.prompt_modifiers`.
- **Sincronización**: cambios en panel avanzado actualizan prompt compilado en tiempo real; cambios en editor simple no borran modificadores.

## Capabilities

### New Capabilities
- `advanced-section-panels`: Paneles "Avanzado" por bloque con edición de pesos/condicionales/tags, persistidos en `appliedOverrides`, renderizados por `PromptCompiler`.

### Modified Capabilities
- `prompt-builder`: El mecanismo de `appliedOverrides` y `useCompile` ahora soporta modificadores estructurados por sección (delta spec).
- `prompt-compiler`: Compilación interpreta `prompt_modifiers` en cada bloque (delta spec).

## Impact

- **Backend**: `PromptCompiler` extendido para leer `prompt_modifiers` en canonical y renderizar pesos/condicionales/tags.
- **Frontend**: `types/api.ts` (nuevo tipo `PromptModifier`), `stores/dashboard.ts` (helpers para overrides estructurados), `components/BlockEditor.vue` (acordeón Avanzado), `composables/useCompile.ts`/`useSectionPrompt.ts` (sin cambios, usan overrides).
- **Schema**: canonical de cada bloque acepta `prompt_modifiers?` (documentado en spec `prompt-compiler` delta).