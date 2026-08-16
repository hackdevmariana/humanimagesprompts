## 1. Backend — entidad y persistencia

- [ ] 1.1 Crear entidad `App\Entity\TimeWeather` (columnas `season`, `time_of_day`, `weather` + trait `UuidIdentity`)
- [ ] 1.2 Crear migración `time_weather` (Doctrine `doctrine:migrations:diff` y revisar DDL; commit: migration)
- [ ] 1.3 Crear `TimeWeatherController` con `AssetCrudTrait` (endpoints `/api/time-weather`, requiredField `season`, `fill`/`toArray`; commit: controller)
- [ ] 1.4 Añadir fixture de ejemplo de `TimeWeather` en `AppFixtures` (commit: fixtures)
- [ ] 1.5 `TimeWeather` en `PromptCompiler` → `normalizeCanonical` y `buildText` con nueva sección `timeText()` (commit: PromptCompiler)
- [ ] 1.6 Mapeos EN en `PromptCompiler::label()` para estaciones, horas y condiciones del día

## 2. Frontend — store, tipos y editor

- [ ] 2.1 Añadir interface `TimeWeather` en `frontend/app/types/api.ts` (commit: types)
- [ ] 2.2 Crear `frontend/app/stores/time.ts` siguiendo el patrón de `stores/lighting.ts` (endpoint `/api/time-weather`) (commit: store)
- [ ] 2.3 Crear `frontend/app/components/editor/TimeWeatherEditor.vue` con los tres selects (Estación, Hora del día, El día) (commit: editor)

## 3. Frontend — registro del bloque

- [ ] 3.1 Registrar `time` en `stores/dashboard.ts`: `BlockKey`, `CANONICAL_BLOCK_ORDER` (`character → pose → outfit → scene → time → lighting`), `activeBlocks` y `uiOrder` por defecto (commit: dashboard store)
- [ ] 3.2 Añadir entrada "Tiempo" con icono en `BlockSidebar.vue` (commit: sidebar)
- [ ] 3.3 Añadir casos `time` en `BlockEditor.vue` (`getStore`, `blockLabel`, `editorComponent`) (commit: BlockEditor)
- [ ] 3.4 Añadir `time` a `activeBlocksMap` en `useCompile.ts` (commit: useCompile)
- [ ] 3.5 Añadir `time` a `blockData`/`isEmpty` en `useSectionPrompt.ts` (commit: useSectionPrompt)
- [ ] 3.6 Añadir tablas de referencia y `randomTime()` en `useRandom.ts` (commit: useRandom)

## 4. Frontend — limpieza del clima en Escenario

- [ ] 4.1 Eliminar el acordeón "Clima y atmósfera" de `SceneEditor.vue` (commit: SceneEditor)
- [ ] 4.2 Quitar `weather_and_atmosphere` de `EMPTY_SCENE` en `stores/scene.ts` y de `randomScene()` en `useRandom.ts` (commit: scene cleanup)

## 5. Verificación

- [ ] 5.1 Migración + fixtures aplicados (`php bin/console doctrine:migrations:migrate` y `doctrine:fixtures:load`) sin errores
- [ ] 5.2 Tests backend: `php bin/phpunit` en verde (nuevo CRUD + compilación de `time`)
- [ ] 5.3 `npx nuxi typecheck` sin errores
- [ ] 5.4 Smoke test Playwright: login → activar Tiempo → "Carga aleatoria" rellena los 3 campos → "Crear prompt" muestra caja inline → copiar toastea → Guardar/Cargar asset Tiempo → compile global incluye la sección de Tiempo tras Escenario y excluye clima de Escenario