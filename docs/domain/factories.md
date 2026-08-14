# Definición de Factorías de Dominio (Factories)

En **HumanImagesPrompts**, la instanciación de un Agregado como `Character` u `Outfit` implica componer múltiples Entidades secundarias y Objetos de Valor (morfología craneal, subtonos de piel, patrones de cabello, etc.). 

Las Factorías encapsulan esta complejidad de ensamblado y garantizan que los invariantes de dominio se cumplan desde el primer milisegundo de vida del objeto.

---

## 1. Principios de Arquitectura para Factorías:
1. **Garantía de Invariantes:** Ningún Agregado creado por una Factoría puede terminar en un estado incoherente (ej. no se puede crear un personaje calvo con mechas).
2. **Métodos Semánticos de Creación:** Además de instanciar desde DTOs/Arrays, las factorías ofrecen métodos para crear "Arquetipos Base" (ej: `createDefaultFemale()`, `createStudioScene()`).
3. **Ubicación:** Las Factorías de Dominio residen en `Domain\<Context>\Factories\`.

---

## 2. Factorías del Contexto: Asset Context

### 2.1 `CharacterFactory`
Responsable de la construcción del Agregado `Character`.

* **Ubicación:** `Domain\Asset\Factories\CharacterFactory.php`
* **Métodos Principales:**

```php
namespace Domain\Asset\Factories;

use Domain\Asset\Entities\Character;
use Domain\Asset\ValueObjects\CharacterId;
use Domain\Shared\ValueObjects\UserId;
use Domain\Asset\Enums\GenderEnum;

class CharacterFactory
{
    /**
     * Crea un Personaje completo a partir de un array de datos (p. ej. desde un formulario o DTO).
     */
    public function createFromArray(array $data, UserId$userId): Character
    {
        $characterId = CharacterId::generate();

        // 1. Reconstrucción/Instanciación de Value Objects
        $cranialMorphology = CranialMorphologyFactory::fromArray($data['cranial_morphology'] ?? []);
        $skinProfile       = SkinProfileFactory::fromArray($data['skin_profile'] ?? []);
        $hairProfile       = HairProfileFactory::fromArray($data['hair_profile'] ?? []);
        $eyeProfile        = EyeProfileFactory::fromArray($data['eye_profile'] ?? []);

        // 2. Instanciación de Entidades Internas Mutables
        $grooming = GroomingStyleFactory::fromArray($data['grooming'] ?? [],$hairProfile);
        $makeup   = MakeupProfileFactory::fromArray($data['makeup'] ?? []);

        // 3. Creación del Agregado Raíz
        return new Character(
            id: $characterId,
            userId: $userId,
            name: $data['name'],
            gender: GenderEnum::from($data['gender']),
            age: (int) $data['age'],
            ethnicity: EthnicityEnum::from($data['ethnicity']),
            cranialMorphology: $cranialMorphology,
            skinProfile: $skinProfile,
            hairProfile: $hairProfile,
            eyeProfile: $eyeProfile,
            currentGrooming: $grooming,
            currentMakeup: $makeup,
            isPublic: $data['is_public'] ?? false
        );
    }

    /**
     * Crea una plantilla de Personaje femenino por defecto con parámetros genéricos válidos.
     */
    public function createDefaultFemale(UserId $userId, string$name = 'Nuevo Personaje Femenino'): Character
    {

        return $this->createFromArray([
            'name' => $name,
            'gender' => GenderEnum::FEMALE->value,
            'age' => 25,
            'ethnicity' => EthnicityEnum::CAUCASIAN->value,
            'cranial_morphology' => ['cranial_shape' => 'MESOCEPHALIC', 'facial_structure' => 'OVAL'],
            'skin_profile' => ['fitzpatrick_scale' => 'TYPE_II', 'undertone' => 'NEUTRAL'],
            'hair_profile' => ['andre_walker_type' => 'TYPE_2A', 'hair_density' => 'MEDIUM'],
            'eye_profile' => ['primary_color' => 'BROWN', 'heterochromia_type' => 'NONE'],
        ], $userId);
    }
}
```

2.2 OutfitFactory

Responsable de la construcción del Agregado Outfit y la ordenación de prendas por capas.

    Ubicación: Domain\Asset\Factories\OutfitFactory.php

    Métodos Principales:

```php

namespace Domain\Asset\Factories;

use Domain\Asset\Entities\Outfit;
use Domain\Asset\Entities\Garment;
use Domain\Asset\ValueObjects\OutfitId;
use Domain\Shared\ValueObjects\UserId;

class OutfitFactory
{
    /**
     * Ensambla un Outfit asignando prendas a sus ranuras de capa específicas (LayerSlots).
     */
    public function createWithGarments(
        UserId $userId, 
        string $name, 
        string $styleCategory, 
        array $garmentsWithSlots
    ): Outfit {
        $outfit = new Outfit(
            id: OutfitId::generate(),
            userId: $userId,
            name: $name,
            styleCategory: OutfitStyleEnum::from($styleCategory)
        );

        foreach ($garmentsWithSlots as$item) {
            // Asigna cada prenda a su ranura validando que no haya colisión de capas
            $outfit->addGarmentToSlot(
                slot: LayerSlotEnum::from($item['slot']),
                garment: $item['garment_instance']
            );
        }

        return $outfit;
    }
}
```

2.3 SceneFactory

Responsable de inicializar esquemas de iluminación y cámara coherentes.

    Ubicación: Domain\Asset\Factories\SceneFactory.php

    Métodos Principales:

```php
namespace Domain\Asset\Factories;

use Domain\Asset\Entities\Scene;
use Domain\Asset\ValueObjects\SceneId;
use Domain\Shared\ValueObjects\UserId;
use Domain\Asset\ValueObjects\LightingSettings;
use Domain\Asset\ValueObjects\CameraSettings;

class SceneFactory
{
    /**
     * Crea un preset de Escena de Estudio Profesional con iluminación Rembrandt y lente de 85mm.
     */
    public function createProfessionalStudio(UserId $userId, string$title = 'Estudio Retrato 85mm'): Scene
    {
        return new Scene(
            id: SceneId::generate(),
            userId: $userId,
            title: $title,
            environmentType: EnvironmentEnum::STUDIO,
            locationDetails: 'Estudio fotográfico neutro con ciclorama gris',
            lighting: new LightingSettings(
                setupType: LightingSetupEnum::REMBRANDT,
                colorTemperature: ColorTemperatureEnum::NEUTRAL_5000K,
                keyLightDirection: LightDirectionEnum::SIDE_45,
                hardness: LightHardnessEnum::SOFT_DIFFUSED
            ),
            cameraAndLens: new CameraSettings(
                focalLength: FocalLengthEnum::LENS_85MM_PORTRAIT,
                aperture: ApertureEnum::F_1_8,
                depthOfField: DepthOfFieldEnum::SHALLOW_BOKEH,
                filmGrain: FilmGrainEnum::CLEAN_DIGITAL
            )
        );
    }
}
```

3. Factorías del Contexto: Composer Context
3.1 PromptCompositionFactory

Responsable de inicializar una mesa de trabajo (Canvas) activa para el usuario.

    Ubicación: Domain\Composer\Factories\PromptCompositionFactory.php

    Métodos Principales:

```php
namespace Domain\Composer\Factories;

use Domain\Composer\Entities\PromptComposition;
use Domain\Composer\ValueObjects\PromptCompositionId;
use Domain\Asset\ValueObjects\CharacterId;
use Domain\Shared\ValueObjects\UserId;

class PromptCompositionFactory
{
    /**
     * Inicializa una nueva composición vinculando un personaje base inicial.
     */
    public function createForCharacter(
        UserId $userId, 
        CharacterId $characterId, 
        string $title = 'Borrador sin título'
    ): PromptComposition {
        return new PromptComposition(
            id: PromptCompositionId::generate(),
            userId: $userId,
            title: $title,
            characterId: $characterId,
            outfitId: null,
            poseId: null,
            sceneId: null,
            status: CompositionStatusEnum::DRAFT
        );
    }
}

```


D
D
```php
