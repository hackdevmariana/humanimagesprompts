## 1. Backend — PromptCompiler: normalizeCanonical + lightingText

- [ ] 1.1 Añadir `'lighting'` a la lista de claves en `normalizeCanonical()` (línea 32): `['character', 'outfit', 'pose', 'scene', 'time', 'lighting']`.
- [ ] 1.2 Crear método privado `lightingText(array $l): string` que renderice `setup_type`, `color_temperature`, `key_light_direction`, `hardness` y opcional `modifiers` con `label()` EN.
- [ ] 1.3 En `buildText()`, añadir `if (isset($canonical['lighting'])) { $parts[] = $this->lightingText($canonical['lighting']); }` **después del bloque `time`** (línea ~108) y antes de `modelTail()`.
- [ ] 1.4 Añadir a `label()` map los valores EN faltantes para enums de lighting: `BLUE_HOUR`, `STUDIO_HARSHELL`, `WINDOW_LIGHT`, `NEON`, `CANDLELIGHT`, `WARM_3200K`, `NEUTRAL_4500K`, `COOL_7000K`, `SIDE_90`, `BACK_45`, `OVERHEAD`, `UNDER`, `SEMI_SOFT`, `HARD_SHADOW`, `CONTRAST` (líneas 298-392).

## 2. Backend — Tests

- [ ] 2.1 Añadir test `testCompileWithLightingBlock()` en `PromptCompilerTest`: composición completa con `lighting` → canonical tiene `lighting`, `compiled_text` incluye "Lighting:".
- [ ] 2.2 Añadir test `testCompileOmitsLightingWhenAbsent()`: composición sin `lighting` → canonical no tiene `lighting`, compiled_text sin "Lighting:".
- [ ] 2.3 Verificar: `cd backend && php bin/phpunit` → 61+ tests en verde.

## 3. Verificación

- [ ] 3.1 `cd backend && php bin/phpunit` — todos los tests pasan.
- [ ] 3.2 Smoke test manual: login → dashboard → activar Iluminación → cambiar valores (p. ej. `BLUE_HOUR`, `NEUTRAL_4500K`, `SIDE_90`, `SEMI_SOFT`) → "Crear prompt" → el texto compilado incluye la descripción de iluminación en inglés.