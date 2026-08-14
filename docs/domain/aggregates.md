# Definición de Raíces de Agregado y Límites de Consistencia (Aggregates)

En la arquitectura de **HumanImagesPrompts**, los Agregados garantizan la integridad de las reglas de negocio en cada transacción de la base de datos.

## Reglas de Arquitectura para Agregados:
1. **Límite Transaccional:** Los cambios dentro de un Agregado deben persistirse en una única transacción atómica.
2. **Referencia por ID:** Un Agregado NUNCA mantiene una instancia o relación directa ORM con la Raíz de otro Agregado. Solo guarda su `UUID` (ej: `Outfit` contiene `userId: UserId`, no el objeto `User`).
3. **Acceso Externo:** El código exterior (Servicios de Aplicación, Controladores) solo interactúa con la Raíz del Agregado (`Aggregate Root`).

---

## 1. Agregado: `CharacterAggregate` (Sujeto / Personaje)

Representa la identidad antropológica y la estética de un personaje. Es el responsable de mantener la coherencia genética y de estilismo.

* **Aggregate Root:** `Character`
* **Entidades Internas:**
  * `GroomingStyle`
  * `MakeupProfile`
* **Objetos de Valor Internos:**
  * `CranialMorphology`
  * `SkinProfile`
  * `HairProfile`
  * `EyeProfile`
* **Referencias Externas (Solo IDs):**
  * `userId`: `UserId`
* **Invariantes y Reglas de Consistencia:**
  * **Regla de Alopecia:** Si `hairProfile.andreWalkerType` se define como `BALD`, el agregado debe forzar automáticamente `currentGrooming.hairstyle` a `NONE` y eliminar cualquier mecha o degradado.
  * **Heterocromía Coherente:** Si `eyeProfile.heterochromiaType` pasa a `NONE`, el agregado debe limpiar automáticamente `eyeProfile.secondaryColor`.
  * **Consistencia de Pecas:** Si `skinProfile.imperfections` no incluye `FRECKLES`, `freckleDensity` debe ser `null`.
* **Eventos de Dominio Emitidos:**
  * `CharacterCreated`
  * `CharacterUpdated`
  * `CharacterGroomingMutated`
  * `CharacterMakeupUpdated`

---

## 2. Agregado: `OutfitAggregate` (Atuendo y Capas)

Maneja la combinación de ropa, asegurando que las capas de vestir (*layering*) no colisionen ni violen reglas físicas.

* **Aggregate Root:** `Outfit`
* **Entidades Internas:**
  * `GarmentSlot` (Entidad interna que vincula una `Garment` a un `LayerSlotEnum`)
  * `Garment` (Prenda)
* **Objetos de Valor Internos:**
  * `Fabric`
  * `ColorPalette`
* **Referencias Externas (Solo IDs):**
  * `userId`: `UserId`
* **Invariantes y Reglas de Consistencia:**
  * **Conflicto de Cuerpo Completo:** Si un `Outfit` contiene una prenda `FULL_BODY` (ej: un mono de carreras o vestido largo) en la capa base, no se puede añadir otra prenda de categoría `TOP` o `BOTTOM` en el mismo `LayerSlotEnum`.
  * **Prendas Duplicadas:** Un `Outfit` no puede contener la misma `GarmentId` en dos ranuras de capa diferentes.
  * **Límite de Capas:** Solo puede existir una prenda activa por cada ranura (`BASE_LAYER`, `MID_LAYER`, `OUTER_LAYER`, `FOOTWEAR`, `HEADWEAR`).
* **Eventos de Dominio Emitidos:**
  * `OutfitCreated`
  * `GarmentAddedToOutfit`
  * `GarmentRemovedFromOutfit`
  * `OutfitPublishedToCommunity`

---

## 3. Agregado: `PoseAggregate` (Postura y Expresión)

Garantiza la viabilidad corporal y los requisitos de encuadre fotográfico.

* **Aggregate Root:** `Pose`
* **Objetos de Valor Internos:**
  * `BodyLanguage`
  * `FacialExpression`
* **Referencias Externas (Solo IDs):**
  * `userId`: `UserId|null`
* **Invariantes y Reglas de Consistencia:**
  * **Encaje de Encuadre:** Poses clasificadas como `DYNAMIC_SPORT`, `YOGA_FITNESS` o `DANCE` exigen un encuadre predeterminado de `FULL_BODY`. No se permite guardarlas como `CLOSE_UP`.
* **Eventos de Dominio Emitidos:**
  * `PoseCreated`
  * `PoseUpdated`

---

## 4. Agregado: `SceneAggregate` (Entorno e Iluminación)

Encapsula la física de la luz, el lugar y los parámetros técnicos de la cámara fotográfica.

* **Aggregate Root:** `Scene`
* **Objetos de Valor Internos:**
  * `LightingSettings`
  * `CameraSettings`
  * `AtmosphereSettings`
* **Referencias Externas (Solo IDs):**
  * `userId`: `UserId|null`
* **Invariantes y Reglas de Consistencia:**
  * **Coherencia Óptica:** Si `cameraSettings.aperture` es `F_1_2` o `F_1_8`, el agregado fuerza `depthOfField` a `SHALLOW_BOKEH`.
  * **Temperatura de Estudio:** En entornos de categoría `STUDIO`, las opciones atmosféricas como `RAIN` o `FOG` quedan deshabilitadas salvo que el tipo de estudio sea `ABSTRACT_EFFECTS`.
* **Eventos de Dominio Emitidos:**
  * `SceneCreated`
  * `SceneModified`

---

## 5. Agregado Raíz del Trabajo: `PromptCompositionAggregate`

Es el Agregado Maestro del espacio de trabajo. Orquesta la combinación de los agregados anteriores mediante sus IDs y gestiona la reactividad en tiempo real.

* **Aggregate Root:** `PromptComposition`
* **Entidades Internas:**
  * `MutationOverride` (Lista de alteraciones en caliente)
* **Objetos de Valor Internos:**
  * `CanonicalPrompt` (El JSON compilado)
* **Referencias Externas (Solo IDs):**
  * `userId`: `UserId`
  * `characterId`: `CharacterId`
  * `outfitId`: `OutfitId|null`
  * `poseId`: `PoseId|null`
  * `sceneId`: `SceneId|null`
* **Invariantes y Reglas de Consistencia:**
  * **Personaje Obligatorio:** Una composición activa no puede compilar un `CanonicalPrompt` si `characterId` es nulo.
  * **Validación de Mutaciones:** Una `MutationOverride` no puede apuntar a un atributo inexistente en el agregador del personaje o ropa.
  * **Inmutabilidad del Asset Base:** Ninguna operación dentro de `PromptCompositionAggregate` puede alterar el registro original de `Character`, `Outfit` o `Scene` guardados en la base de datos; solo modifica su copia local/compilada mediante `MutationOverride`.
* **Eventos de Dominio Emitidos:**
  * `CompositionCreated`
  * `CharacterAttachedToComposition`
  * `OutfitAttachedToComposition`
  * `MutationAppliedToComposition`
  * `CanonicalPromptCompiled`

---

## 6. Agregado de Catálogo: `TaxonomyTermAggregate`

Modela los términos técnicos y sus reglas de incompatibilidad cruzada.

* **Aggregate Root:** `TaxonomyTerm`
* **Objetos de Valor Internos:**
  * `CompatibilityRule`
* **Referencias Externas (Solo IDs):**
  * `createdById`: `UserId|null`
* **Invariantes y Reglas de Consistencia:**
  * Un `TaxonomyTerm` del sistema (`isSystemStandard = true`) no puede ser eliminado ni modificado por usuarios convencionales.
* **Eventos de Dominio Emitidos:**
  * `TaxonomyTermCreated`
  * `CompatibilityConflictRegistered`
