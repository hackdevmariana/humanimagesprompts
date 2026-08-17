## Context

**Estado actual:**
- Frontend envía `lighting` como bloque de nivel superior en la composición (useCompile.ts → gatherComposition, CANONICAL_BLOCK_ORDER incluye `'lighting'`).
- `PromptCompiler::normalizeCanonical()` (línea 32) itera solo `['character', 'outfit', 'pose', 'scene', 'time']` — **`lighting` ausente**.
- `PromptCompiler::buildText()` (líneas 94-109) procesa solo esos 5 bloques — **no existe `lightingText()`**.
- `sceneText()` lee `$s['lighting']` (lighting anidado dentro de scene), pero el flujo actual del frontend envía lighting como bloque top-level, no anidado. `sceneText` nunca recibe datos de lighting del frontend.
- `CompileController::persistedToPayload()` no incluye `lighting` (solo character, outfit, pose, scene) — guardado de composiciones pierde lighting.
- `label()` map tiene entradas parciales de lighting: `GOLDEN_HOUR`, `STUDIO_SOFTBOX`, `DAYLIGHT`, `WARM_2700K`, `COOL_5600K`, `FRONT`, `SIDE_45`, `SOFT_DIFFUSED`, `HARD`. Faltan: `BLUE_HOUR`, `STUDIO_HARSHELL`, `WINDOW_LIGHT`, `NEON`, `CANDLELIGHT`, `WARM_3200K`, `NEUTRAL_4500K`, `COOL_7000K`, `SIDE_90`, `BACK_45`, `OVERHEAD`, `UNDER`, `SEMI_SOFT`, `HARD_SHADOW`, `CONTRAST`.
- Fallback `label()` (línea 391) hace `ucwords(strtolower(str_replace(['_', '.'], ' ', $token)))` que genera salida tolerable pero no siempre correcta (p. ej. `STUDIO_HARSHELL` → "Studio Harshell" en vez de "studio hard light").

## Goals / Non-Goals

**Goals:**
1. El bloque `lighting` pase por `normalizeCanonical` y esté disponible en `canonical['lighting']`.
2. `buildText` renderice el bloque `lighting` con un método `lightingText()` después de `time` (orden: character → pose → outfit → scene → time → lighting).
3. `compiled_text` refleje los valores de `setup_type`, `color_temperature`, `key_light_direction`, `hardness` y `modifiers` con labels EN legibles.
4. `label()` map complete para todos los enums que el LightingEditor expone.
5. Tests unitarios cubran el bloque lighting.

**Non-Goals:**
- Cambiar el frontend (ya envía lighting correctamente).
- Modificar `sceneText` (lighting anidado en scene es legacy/alternativo).
- Añadir `lighting` a `persistedToPayload` (fase distinta, aunque sería coherente; se deja como mejora futura).

## Decisions

### 1. Añadir `lighting` a `normalizeCanonical`
**Por qué:** Es la solución mínima y directa. El bloque ya llega en `$composition['lighting']`; solo hay que no descartarlo.
**Implementación:** Cambiar línea 32 de:
```php
foreach (['character', 'outfit', 'pose', 'scene', 'time'] as $key) {
```
a:
```php
foreach (['character', 'outfit', 'pose', 'scene', 'time', 'lighting'] as $key) {
```

### 2. Crear `lightingText(array $l): string`
**Por qué:** Encapsula la lógica de renderizado y permite testearla aisladamente.
**Diseño:**
```php
private function lightingText(array $l): string
{
    $setup = $this->label($l['setup_type'] ?? 'GOLDEN_HOUR');
    $temp = $this->label($l['color_temperature'] ?? 'DAYLIGHT');
    $dir = $this->label($l['key_light_direction'] ?? 'FRONT');
    $hard = $this->label($l['hardness'] ?? 'SOFT_DIFFUSED');
    $bits = ["{$setup} lighting", "{$temp} color temp", "{$dir} key", "{$hard}"];
    if (!empty($l['modifiers']) && is_array($l['modifiers'])) {
        $mods = [];
        foreach ($l['modifiers'] as $k => $v) {
            $mods[] = "{$k}: {$this->label((string)$v)}";
        }
        $bits[] = 'mods: ' . implode(', ', $mods);
    }
    return 'Lighting: ' . implode(', ', $bits) . '.';
}
```
**Ubicación en `buildText`:** insertar **después del bloque `time`** (línea 108 aprox) y antes del `modelTail`:
```php
if (isset($canonical['lighting'])) {
    $parts[] = $this->lightingText($canonical['lighting']);
}
```

### 3. Completar `label()` map con lighting
**Por qué:** Los labels EN hacen el prompt más natural para los motores de difusión (Flux, Midjourney, SDXL entienden mejor "blue hour" que "Blue Hour" o "STUDIO_HARSHELL").
**Valores a añadir (clave → label EN):**
- `BLUE_HOUR` → `blue hour`
- `STUDIO_HARSHELL` → `studio hard light`
- `WINDOW_LIGHT` → `window light`
- `NEON` → `neon`
- `CANDLELIGHT` → `candlelight`
- `WARM_3200K` → `warm 3200k`
- `NEUTRAL_4500K` → `neutral 4500k`
- `COOL_7000K` → `cool 7000k`
- `SIDE_90` → `side 90`
- `BACK_45` → `back 45`
- `OVERHEAD` → `overhead`
- `UNDER` → `under`
- `SEMI_SOFT` → `semi-soft`
- `HARD_SHADOW` → `hard shadow`
- `CONTRAST` → `high contrast`
**Nota:** Se mantienen mayúsculas como en el enum; el fallback cubre el resto.

### 4. Orden en `buildText`
**Por qué:** El README y `CANONICAL_BLOCK_ORDER` del dashboard ponen `lighting` al final. Mantener coherencia.
**Orden final:** character → outfit → pose → scene → time → lighting → modelTail.

### 5. Test en `PromptCompilerTest`
**Escenario:** composición con `character`, `outfit`, `pose`, `scene`, `time`, `lighting` → canonical contiene `lighting` y `compiled_text` incluye "Lighting: ...".
**Escenario:** composición sin `lighting` → canonical no tiene `lighting` y `compiled_text` no incluye "Lighting:".

### 6. (Futuro) `persistedToPayload`
No se toca en este change; si se guardan composiciones desde el dashboard, el lighting no se persistirá. Se hará en un change posterior si se necesita.