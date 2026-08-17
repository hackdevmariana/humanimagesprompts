# TODO — Frontend Time-Weather Block

> Change: `openspec/changes/frontend-time-weather-block/`
> Specs: `time-weather-block`, `prompt-builder` (delta), `asset-library` (delta)

Orden de trabajo. Marco la casilla cuando esté hecho. Commits: uno por fichero.

## 1. Backend — entidad y persistencia
- [x] 1.1 Crear entidad `TimeWeather` en `backend/src/Entity/` (season, time_of_day, weather + UuidIdentity)
- [x] 1.2 Migración `time_weather` (commit: migration)
- [x] 1.3 `TimeWeatherController` con `AssetCrudTrait` (`/api/time-weather`) (commit: controller)
- [x] 1.4 Fixture de ejemplo de `TimeWeather` (commit: fixtures)
- [x] 1.5 `PromptCompiler`: añadir `time` a `normalizeCanonical`/`buildText` + `timeText()` (commit: PromptCompiler)
- [x] 1.6 Mapeos EN en `PromptCompiler::label()` (estaciones, horas, condiciones del día)

## 2. Frontend — tipos, store y editor
- [x] 2.1 Interface `TimeWeather` en `types/api.ts` (commit: types)
- [x] 2.2 Store `stores/time.ts` (patrón lighting.ts, endpoint `/api/time-weather`) (commit: store)
- [x] 2.3 `editor/TimeWeatherEditor.vue` con los 3 selects (Estación, Hora del día, El día) (commit: editor)

## 3. Frontend — registro del bloque
- [x] 3.1 Registrar `time` en `stores/dashboard.ts`: `BlockKey`, orden canónico `character → pose → outfit → scene → time → lighting`, activeBlocks/uiOrder (commit: dashboard store)
- [x] 3.2 Entrada "Tiempo" + icono en `BlockSidebar.vue` (commit: sidebar)
- [x] 3.3 Casos `time` en `BlockEditor.vue` (getStore, label, component) (commit: BlockEditor)
- [x] 3.4 `time` en `useCompile.ts` (activeBlocksMap) (commit: useCompile)
- [x] 3.5 `time` en `useSectionPrompt.ts` (blockData/isEmpty) (commit: useSectionPrompt)
- [x] 3.6 Tablas de referencia + `randomTime()` en `useRandom.ts` (commit: useRandom)

## 4. Frontend — limpieza del clima en Escenario
- [x] 4.1 Eliminar acordeón "Clima y atmósfera" de `SceneEditor.vue` (commit: SceneEditor)
- [x] 4.2 Quitar `weather_and_atmosphere` de `EMPTY_SCENE` y de `randomScene()` (commit: scene cleanup)

## 5. Verificación
- [x] 5.1 Migración + fixtures (`doctrine:migrations:migrate` + `doctrine:fixtures:load`) sin errores
- [x] 5.2 `php bin/phpunit` en verde (CRUD TimeWeather + compilación `time`)
- [x] 5.3 `npx nuxi typecheck` sin errores
- [x] 5.4 Smoke test Playwright: login → activar Tiempo → "Carga aleatoria" rellena 3 campos → "Crear prompt" caja inline → copiar toastea → Guardar/Cargar asset → compile global incluye Tiempo tras Escenario y excluye clima de Escenario

## 6. Documentación
- [x] 6.1 Crear `README.md` bilingüe (ES/EN) en raíz: intro, stack, requisitos, setup dev, API, compilación, tests, despliegue prod, docs, OpenSpec, estructura
- [x] 6.2 Reemplazar `frontend/README.md` por guía breve apuntando a raíz