# Definición de Objetos de Valor de Dominio (Value Objects)

En la arquitectura de **HumanImagesPrompts**, los Objetos de Valor (VO) representan conceptos descriptivos del dominio que **carecen de identidad conceptual** (`UUID`). 

Son **inmutables**; cualquier modificación en una propiedad requiere la creación de una nueva instancia del Value Object. Además, son **autovalidables**: no se puede instanciar un Value Object con datos inconsistentes.

---

## 1. Value Objects de Anatomo-Morfología (Character Domain)

### 1.1 `CranialMorphology`
Define las métricas y la estructura de la cabeza y el rostro según el visagismo técnico.

* **Propiedades:**
  * `cranialShape`: `CranialShapeEnum` (DOLICHOCEPHALIC, BRACHYCEPHALIC, MESOCEPHALIC)
  * `facialStructure`: `FacialStructureEnum` (OVAL, SQUARE, HEART, DIAMOND, ROUND, OBLONG)
  * `jawlineDefinition`: `JawlineEnum` (SHARP, SOFT, RECESSED, PROMINENT_SQUARE)
  * `cheekbones`: `CheekbonesEnum` (HIGH_PROMINENT, FLAT, SOFT)
  * `earMorphology`: `EarMorphologyEnum` (ATTACHED_LOBE, FREE_LOBE, POINTED, PROTRUDING)
* **Validaciones / Invariantes:**
  * No permite valores nulos en la forma craneal o estructura facial.

### 1.2 `SkinProfile`
Modela la textura, pigmentación y particularidades cutáneas.

* **Propiedades:**
  * `fitzpatrickScale`: `FitzpatrickScaleEnum` (TYPE_I, TYPE_II, TYPE_III, TYPE_IV, TYPE_V, TYPE_VI)
  * `undertone`: `UndertoneEnum` (WARM_GOLDEN, COOL_PINK, NEUTRAL, OLIVE, RED_COOL)
  * `skinFinish`: `SkinFinishEnum` (DEWY, MATTE, SATIN, OILY_SHINE, TEXTURED_NATURAL)
  * `imperfections`: `array<SkinFeatureEnum>` (FRECKLES, MOLES, ROSACEA, VITILIGO, SCARS, ACNE_NEUTRAL)
  * `freckleDensity`: `DensityEnum|null` (SPARSE, MODERATE, DENSE)
* **Validaciones / Invariantes:**
  * Si `imperfections` contiene `FRECKLES`, `freckleDensity` no puede ser nulo.

### 1.3 `HairProfile`
Modela las propiedades biológicas y la textura natural del cabello.

* **Propiedades:**
  * `andreWalkerType`: `AndreWalkerScaleEnum` (TYPE_1A, TYPE_1B, TYPE_1C, TYPE_2A, TYPE_2B, TYPE_2C, TYPE_3A, TYPE_3B, TYPE_3C, TYPE_4A, TYPE_4B, TYPE_4C)
  * `hairDensity`: `DensityEnum` (THIN, MEDIUM, THICK, VERY_DENSE)
  * `porosity`: `HairPorosityEnum` (LOW, MEDIUM, HIGH)
  * `hairline`: `HairlineEnum` (STRAIGHT, WIDOWS_PEAK, RECEDING, HIGH)
* **Validaciones / Invariantes:**
  * Define la base biológica del cabello antes de aplicarle un `GroomingStyle`.

### 1.4 `EyeProfile`
Modela la morfología y coloración ocular.

* **Propiedades:**
  * `primaryColor`: `EyeColorEnum` (AMBER, BLUE, BROWN, GREEN, HAZEL, GRAY)
  * `secondaryColor`: `EyeColorEnum|null` (En caso de heterocromía parcial o completa)
  * `heterochromiaType`: `HeterochromiaEnum|null` (NONE, COMPLETE, CENTRAL, SEGMENTAL)
  * `eyeShape`: `EyeShapeEnum` (ALMOND, ROUND, MONOLID, HOODED, DOWNTURNED, UPTURNED)
  * `eyelashDetails`: `EyelashEnum` (NATURAL, LONG_DENSE, EXTENSIONS, SPARSE)
* **Validaciones / Invariantes:**
  * Si `heterochromiaType` es distinto de `NONE`, `secondaryColor` no puede ser nulo y debe ser diferente de `primaryColor`.

---

## 2. Value Objects de Textil y Vestuario (Outfit Domain)

### 2.1 `Fabric`
Representa la materia física y textura de una prenda.

* **Propiedades:**
  * `material`: `FabricMaterialEnum` (COTTON, LINEN, LEATHER, DENIM, SILK, BOUCLE_WOOL, NYLON, LATEX)
  * `weave`: `WeaveTypeEnum` (KNITTED, WOVEN, SATIN_WEAVE, TWILL)
  * `weight`: `FabricWeightEnum` (LIGHTWEIGHT, MEDIUM_WEIGHT, HEAVYWEIGHT)
  * `sheerness`: `SheernessEnum` (OPAQUE, SEMI_TRANSPARENT, SHEER)
* **Validaciones / Invariantes:**
  * Materiales como `LEATHER` o `LATEX` se fuerzan como `OPAQUE`.

### 2.2 `ColorPalette`
Representa un color exacto para ropa, cabello, maquillaje u ojos.

* **Propiedades:**
  * `colorName`: `string` (Ej. "Midnight Blue", "Crimson Red")
  * `hexCode`: `string` (Formato `#RRGGBB`)
* **Validaciones / Invariantes:**
  * El `hexCode` debe cumplir estrictamente con la expresión regular `^#([A-Fa-f0-9]{6})$`.

---

## 3. Value Objects de Fotografía y Entorno (Scene Domain)

### 3.1 `LightingSettings`
Define el esquema y calidad de la iluminación fotográfica.

* **Propiedades:**
  * `setupType`: `LightingSetupEnum` (REMBRANDT, BUTTERFLY, SOFTBOX_STUDIO, NATURAL_SUNLIGHT, NEON_CYBERPUNK, GOLDEN_HOUR, DRAMATIC_SPLIT)
  * `colorTemperature`: `ColorTemperatureEnum` (WARM_2700K, NEUTRAL_5000K, COOL_6500K)
  * `keyLightDirection`: `LightDirectionEnum` (FRONTAL, SIDE_45, BACKLIGHT, TOP_DOWN)
  * `hardness`: `LightHardnessEnum` (HARD_SHADOWS, SOFT_DIFFUSED)

### 3.2 `CameraSettings`
Define el equipamiento de la cámara y los valores ópticos.

* **Propiedades:**
  * `focalLength`: `FocalLengthEnum` (LENS_24MM, LENS_35MM, LENS_50MM, LENS_85MM_PORTRAIT, LENS_200MM_TELEPHOTO)
  * `aperture`: `ApertureEnum` (F_1_2, F_1_8, F_2_8, F_8, F_16)
  * `depthOfField`: `DepthOfFieldEnum` (SHALLOW_BOKEH, MODERATE, DEEP_IN_FOCUS)
  * `filmGrain`: `FilmGrainEnum` (CLEAN_DIGITAL, SUBTLE_35MM, HEAVY_VINTAGE_GRAIN)
* **Validaciones / Invariantes:**
  * Aperturas ultra abiertas (`F_1_2`, `F_1_8`) obligan a un `depthOfField` de tipo `SHALLOW_BOKEH`.

---

## 4. Value Objects del Compilador (Composer Domain)

### 4.1 `MutationOverride`
Modela una alteración puntual a un atributo en tiempo de ejecución.

* **Propiedades:**
  * `targetPath`: `string` (Ruta del atributo. Ej: `character.grooming.hairColorPrimary`)
  * `overrideValue`: `mixed` (El nuevo valor que reemplaza al valor original del asset)
* **Validaciones / Invariantes:**
  * `targetPath` debe pertenecer a la lista de atributos marcados como mutables.

### 4.2 `CanonicalPrompt`
Es el DTO / Value Object inmutable final producido por el `Composer Context` listo para ser entregado a la Gem de traducción.

* **Propiedades:**
  * `schemaVersion`: `string` (Ej. "1.0.0")
  * `rawJSON`: `array` (Estructura jerárquica con todo el estado resuelto del personaje, ropa, escena y pose)
  * `generatedAt`: `DateTimeImmutable`
