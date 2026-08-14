# Definición de Entidades de Dominio (Entities)

En la arquitectura de **HumanImagesPrompts**, las Entidades son objetos que poseen una **identidad única continua a lo largo del tiempo**, un ciclo de vida definido y un estado mutable. 

Cada Entidad está identificada por un `UUIDv4` fuertemente tipado.

---

## 1. Contexto: Asset Context

### 1.1 `Character` (Sujeto / Personaje)
Es la representación de un ser humano con rasgos antropológicos y estéticos definidos. Representa la raíz del agregado de personaje.

* **Identificador:** `CharacterId` (UUIDv4)
* **Atributos de Estado:**
  * `userId`: `UserId` (Propietario del asset)
  * `name`: `string` (Ej. "Elena - Modelo Editorial", "Marcus - Atleta")
  * `isPublic`: `bool` (Indica si es accesible para la comunidad)
  * `gender`: `GenderEnum` (MALE, FEMALE, NON_BINARY, ANDROGYNOUS)
  * `age`: `int` (Rango de edad biológica percibida: 0 - 100)
  * `ethnicity`: `EthnicityEnum` (CAUCASIAN, EAST_ASIAN, AFRICAN, HISPANIC, SOUTH_ASIAN, MIDDLE_EASTERN, NATIVE_AMERICAN, MULTIRACIAL)
* **Value Objects Asociados:**
  * `cranialMorphology`: `CranialMorphology`
  * `skinProfile`: `SkinProfile`
  * `hairProfile`: `HairProfile`
  * `eyeProfile`: `EyeProfile`
  * `facialFeatures`: `FacialFeatures` (Grosor de labios, forma de nariz, orejas)
* **Entidades Hijas Contenidas:**
  * `currentGrooming`: `GroomingStyle` (Entidad mutable de peinado/vello facial)
  * `currentMakeup`: `MakeupProfile` (Entidad mutable de maquillaje)
* **Invariantes y Reglas:**
  * La edad no puede ser un valor negativo.
  * Si `hairProfile.hairType` es `BALD`, `currentGrooming.hairstyle` debe forzarse a `NONE` o `SHAVED`.

---

### 1.2 `GroomingStyle` (Estilo de Peinado y Vello Facial)
Representa la preparación y peinado del cabello/vello facial de un personaje en un momento dado. Puede mutar independientemente de la genética del personaje.

* **Identificador:** `GroomingStyleId` (UUIDv4)
* **Atributos de Estado:**
  * `hairstyleName`: `string` (Ej. "Corte Pixie", "Trenzas Afro", "Tupé Clásico")
  * `hairLength`: `HairLengthEnum` (SHAVED, SHORT, MEDIUM, LONG, EXTRA_LONG)
  * `hairColorPrimary`: `ColorPalette` (RGB / Hex / Nombre técnico)
  * `hairColorSecondary`: `ColorPalette|null` (Para mechas, balayage, degradados)
  * `hairFinish`: `HairFinishEnum` (MATTE, WET_LOOK, GLOSSY, MESSY, STYLED)
  * `facialHairStyle`: `FacialHairEnum|null` (CLEAN_SHAVEN, STUBBLE, FULL_BEARD, MUSTACHE, GOATEE)
  * `facialHairColor`: `ColorPalette|null`

---

### 1.3 `MakeupProfile` (Perfil de Maquillaje)
Representa la cosmética aplicada al rostro y manos del personaje.

* **Identificador:** `MakeupProfileId` (UUIDv4)
* **Atributos de Estado:**
  * `styleName`: `string` (Ej. "Editorial Glossy", "No-Makeup Makeup", "Gothic Dark")
  * `lipstick`: `LipstickSettings|null` (Color, acabado: MATTE, GLOSS, SATIN, OMBRE)
  * `eyeshadow`: `EyeshadowSettings|null` (Color, estilo: SMOKEY, CUT_CREASE, NATURAL)
  * `eyeliner`: `EyelinerSettings|null` (Estilo: CAT_EYE, GRAPHIC, SIMPLE)
  * `blushAndContour`: `ContourSettings|null` (Definición, intensidad)
  * `nails`: `NailArtSettings|null` (Largo, forma, color, patrón)

---

### 1.4 `Garment` (Prenda Individual)
Representa una pieza de vestir individual.

* **Identificador:** `GarmentId` (UUIDv4)
* **Atributos de Estado:**
  * `userId`: `UserId|null` (Null si es una prenda oficial del sistema)
  * `name`: `string` (Ej. "Camiseta Oficial Selección España", "Chaqueta Biker Cuero")
  * `category`: `GarmentCategoryEnum` (TOP, BOTTOM, FULL_BODY, FOOTWEAR, HEADWEAR, ACCESSORY)
  * `subCategory`: `string` (Ej. "Hoodie", "Cargo Pants", "Sneakers")
  * `fit`: `GarmentFitEnum` (SKINNY, SLIM, REGULAR, OVERSIZED, TAILORED)
  * `fabric`: `Fabric` (Value Object: Material, textura, acabado)
  * `primaryColor`: `ColorPalette`
  * `secondaryColor`: `ColorPalette|null`
  * `pattern`: `PatternEnum|null` (SOLID, STRIPED, PLAID, CAMO, GRAPHIC_PRINT)
  * `tags`: `array<string>` (Categorización dinámica para búsquedas)

---

### 1.5 `Outfit` (Atuendo / Vestuario Completo)
Representa un conjunto coordinado de prendas dispuestas en capas (*layering*).

* **Identificador:** `OutfitId` (UUIDv4)
* **Atributos de Estado:**
  * `userId`: `UserId`
  * `name`: `string` (Ej. "Streetwear Urbano 90s", "Traje de Etiqueta Formal")
  * `styleCategory`: `OutfitStyleEnum` (CASUAL, FORMAL, ATHLETIC, HIGH_FASHION, TACTICAL, PERIOD_COSTUME)
  * `isPublic`: `bool`
* **Entidades Hijas Contenidas:**
  * `garments`: `array<GarmentSlot>`
    * `slotType`: `LayerSlotEnum` (BASE_LAYER, MID_LAYER, OUTER_LAYER, FOOTWEAR, HEADWEAR, ACCESSORIES)
    * `garment`: `Garment`
* **Invariantes:**
  * No se pueden asignar dos prendas al mismo `LayerSlotEnum` si ambas son de categoría de cuerpo completo (`FULL_BODY`).

---

### 1.6 `Pose` (Postura y Expresión Corporal)
Representa la actitud física y espacial del sujeto.

* **Identificador:** `PoseId` (UUIDv4)
* **Atributos de Estado:**
  * `userId`: `UserId|null`
  * `title`: `string` (Ej. "Celebración Gol Cristiano Ronaldo", "Postura Yoga Guerrero")
  * `category`: `PoseCategoryEnum` (STANDING, SITTING, DYNAMIC_SPORT, DANCE, YOGA_FITNESS, HIGH_FASHION)
  * `bodyLanguage`: `string` (Descripción detallada de la posición de extremidades)
  * `facialExpression`: `FacialExpressionEnum` (NEUTRAL, INTENSE_SMILE, SMIRK, SERIOUS_LOOK, CRYING, SCREAMING)
  * `expressionIntensity`: `int` (Escala del 1 al 10)
  * `cameraAngleRequirement`: `CameraAngleEnum|null` (LOW_ANGLE, EYE_LEVEL, HIGH_ANGLE, BIRD_EYE)
  * `requiredFraming`: `FramingEnum|null` (CLOSE_UP, MEDIUM_SHOT, FULL_BODY)
* **Invariantes:**
  * Poses categorizadas como `YOGA_FITNESS` o `DANCE` suelen requerir un encuadre `FULL_BODY`.

---

### 1.7 `Scene` (Escena, Entorno y Fotografía)
Representa el entorno, la ambientación y los parámetros técnicos de la cámara.

* **Identificador:** `SceneId` (UUIDv4)
* **Atributos de Estado:**
  * `userId`: `UserId|null`
  * `title`: `string` (Ej. "Estudio Fotográfico Neón", "Campo Agrícola en Golden Hour")
  * `environmentType`: `EnvironmentEnum` (INDOR, OUTDOOR, STUDIO, URBAN, NATURE, ABSTRACT)
  * `locationDetails`: `string` (Ej. "Aula universitaria moderna con pizarra de cristal")
  * `lighting`: `LightingSettings` (Value Object: Tipo de luz, dirección, temperatura)
  * `cameraAndLens`: `CameraSettings` (Value Object: Distancia focal, apertura, ISO, tipo de grano)
  * `weatherAndAtmosphere`: `AtmosphereSettings` (Value Object: Niebla, lluvia, hora del día)

---

## 2. Contexto: Composer Context

### 2.1 `PromptComposition` (El Canvas / Trabajo Activo)
Es el Agregado Raíz que orquesta la unión de todos los assets para compilar un prompt final.

* **Identificador:** `PromptCompositionId` (UUIDv4)
* **Atributos de Estado:**
  * `userId`: `UserId`
  * `title`: `string` (Ej. "Campamento de Verano - Foto 01")
  * `characterId`: `CharacterId`
  * `outfitId`: `OutfitId|null`
  * `poseId`: `PoseId|null`
  * `sceneId`: `SceneId|null`
  * `status`: `CompositionStatusEnum` (DRAFT, COMPILED, ARCHIVED)
* **Entidades Hijas y Mutaciones (Overrides):**
  * `overrides`: `array<MutationOverride>` (Permite alterar atributos concretos sin modificar los assets base guardados. Ej: "Usar personaje Marcus pero cambiar el color de pelo a blanco").
* **Comportamientos (Métodos de Dominio):**
  * `attachCharacter(CharacterId $id): void`
  * `applyMutation(TargetAttribute $target, ValueObject $newValue): void`
  * `compileCanonicalJSON(): CanonicalPrompt` (Genera el DTO listo para el Translation Context)

---

## 3. Contexto: Catalog Context

### 3.1 `TaxonomyTerm` (Término del Catálogo)
Representa un concepto del vocabulario técnico (morfologías, colores, telas, visagismo) reutilizable en todo el sistema.

* **Identificador:** `TaxonomyTermId` (UUIDv4)
* **Atributos de Estado:**
  * `category`: `TaxonomyCategoryEnum` (CRANIAL_SHAPE, ANDRE_WALKER_TYPE, FABRIC_TYPE, LIGHTING_TYPE)
  * `key`: `string` (Slug técnico: `dolichocephalic`, `4c_coily`, `boucle_wool`)
  * `label`: `string` (Nombre legible: "Dolicocéfalo", "4C Afro Muy Encogido")
  * `description`: `text`
  * `iconUrl`: `string|null` (Ruta al icono vectorial para la UI)
  * `isSystemStandard`: `bool` (True para el núcleo técnico, False para extensiones de usuario/comunidad)
  * `createdById`: `UserId|null`
