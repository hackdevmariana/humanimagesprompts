## Why

El bloque `lighting` (Iluminación) que el usuario edita en el dashboard **no aparece en el prompt compilado**. `PromptCompiler::normalizeCanonical()` no incluye `'lighting'` en la lista de claves que procesa, y `buildText()` no tiene ningún método `lightingText()` que renderice el bloque. El resultado es que cualquier valor puesto en el apartado "Iluminación" se ignora silenciosamente, y el `compiled_text` solo muestra el `modelTail()` (p. ej. `--ar 16:9 --style raw` para FLUX).

## What Changes

- **`normalizeCanonical()`**: añadir `'lighting'` a la lista de claves iteradas (línea 32).
- **Nuevo método `lightingText(array $l): string`**: renderiza `setup_type`, `color_temperature`, `key_light_direction`, `hardness` y `modifiers` (opcional), usando `label()` para traducción EN.
- **`buildText()`**: añadir `if (isset($canonical['lighting'])) { $parts[] = $this->lightingText($canonical['lighting']); }` **después de `time`** (orden canónico: character → pose → outfit → scene → time → lighting).
- **`label()` map**: completar valores EN para enums de lighting que faltan (`BLUE_HOUR`, `STUDIO_HARSHELL`, `WINDOW_LIGHT`, `NEON`, `CANDLELIGHT`, `WARM_3200K`, `NEUTRAL_4500K`, `COOL_7000K`, `SIDE_90`, `BACK_45`, `OVERHEAD`, `UNDER`, `SEMI_SOFT`, `HARD_SHADOW`, `CONTRAST`).
- **Test**: nuevo test en `PromptCompilerTest` que verifica que el bloque `lighting` llega al canonical y aparece en `compiled_text`.

## Capabilities

### Modified Capabilities
- `prompt-compiler`: Añade soporte completo para el bloque `lighting` (canonical + texto compilado + labels EN).

## Impact

- **Backend**: `PromptCompiler.php` (normalizeCanonical, buildText, lightingText, label).
- **Tests**: `PromptCompilerTest.php` (nuevo test + posibles ajustes).
- **Frontend/API/DB**: Sin cambios. El frontend ya envía `lighting` en la composición (useCompile.ts, CANONICAL_BLOCK_ORDER).
- **Orden canónico**: lighting va al final, tras time, coincidiendo con `CANONICAL_BLOCK_ORDER` del dashboard y el README.