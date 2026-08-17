## 1. Backend - PromptCompiler (colores + campos EN)

- [ ] 1.1 Añadir mapa estático `COLOR_ES_EN` (63 entradas) en `PromptCompiler.php`
- [ ] 1.2 Modificar `colorText()` para usar mapa con fallback
- [ ] 1.3 Modificar `poseText()`: usar `body_language_en ?? body_language`
- [ ] 1.4 Modificar `sceneText()`: usar `location_details_en ?? location_details`
- [ ] 1.5 Modificar `characterText()`: usar `style_name_en ?? style_name` en maquillaje

## 2. Backend - Catálogo (labels EN)

- [ ] 2.1 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/tops.php` (~35 prendas)
- [ ] 2.2 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/bottoms.php` (~25 prendas)
- [ ] 2.3 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/outerwear.php` (~20 prendas)
- [ ] 2.4 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/dresses.php` (~15 prendas)
- [ ] 2.5 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/footwear.php` (~25 prendas)
- [ ] 2.6 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/headwear.php` (~15 prendas)
- [ ] 2.7 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/accessories.php` (~25 prendas)
- [ ] 2.8 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/lingerie.php` (~15 prendas)
- [ ] 2.9 Añadir `label` EN a cada prenda en `backend/fixtures/catalog/swimwear.php` (~14 prendas)

## 3. Backend - Fixtures AppFixtures (textos libres EN)

- [ ] 3.1 Añadir `body_language_en` a poses en `AppFixtures.php`
- [ ] 3.2 Añadir `location_details_en` a scenes en `AppFixtures.php`
- [ ] 3.3 Añadir `style_name_en` a makeup en `AppFixtures.php`

## 4. Frontend - useRandom.ts (arrays EN + campos *_en)

- [ ] 4.1 Añadir `bodyLanguagesEn`, `locationDetailsEn`, `makeupStyleNamesEn` arrays
- [ ] 4.2 Modificar `randomPose()`: setear `body_language_en`
- [ ] 4.3 Modificar `randomScene()`: setear `location_details_en`
- [ ] 4.4 Modificar `randomCharacter()`: setear `current_makeup.style_name_en`

## 5. Frontend - types/api.ts (tipos *_en)

- [ ] 5.1 Añadir `body_language_en?: string` a interface `Pose`
- [ ] 5.2 Añadir `location_details_en?: string` a interface `Scene`
- [ ] 5.3 Añadir `style_name_en?: string` a interface `MakeupProfile`

## 6. Tests

- [ ] 6.1 Test `colorText()` con mapa: colores conocidos traducidos, desconocidos fallback
- [ ] 6.2 Test `poseText()` prefiere `body_language_en`
- [ ] 6.3 Test `sceneText()` prefiere `location_details_en`
- [ ] 6.4 Test `characterText()` prefiere `style_name_en` en maquillaje
- [ ] 6.5 Test integración: `compileWithOutfitBlock()` produce prompt EN (prendas + colores)

## 7. Verificación

- [ ] 7.1 `php bin/phpunit` — 63+ tests verdes
- [ ] 7.2 `npx nuxi typecheck` — solo WARN conocido `useGarmentStore`
- [ ] 7.3 Prueba manual: compilar prompt con outfit → inglés (prendas, colores, body_language si aleatorio)