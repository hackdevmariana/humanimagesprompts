# Reglas de Dominio y Motor de Especificaciones (Rules & Specifications)

En **HumanImagesPrompts**, la coherencia visual y anatómica es fundamental. Este documento define la arquitectura para evaluar reglas de compatibilidad e incompatibilidad entre componentes sin acoplar el código a condicionales duros.

---

## 1. Patrón Specification (Specification Pattern)

Todas las reglas de validación de dominio complejas implementan la interfaz `SpecificationInterface`.

### 1.1 Contrato Base

* **Ubicación:** `Domain\Shared\Specifications\SpecificationInterface.php`

```php
namespace Domain\Shared\Specifications;

interface SpecificationInterface
{
    /**
     * Evalúa si un candidato cumple con la regla de negocio.
     */
    public function isSatisfiedBy(mixed $candidate): bool;

    /**
     * Devuelve el mensaje de error legible si la especificación falla.
     */
    public function getFailureReason(): string;
}
```

1.2 Implementaciones de Especificaciones Core
A. BaldHairCompatibilitySpecification

Garantiza que un personaje calvo no tenga acabados, peinados o tintes contradictorios.

    Ubicación: Domain\Asset\Specifications\BaldHairCompatibilitySpecification.php

```php

namespace Domain\Asset\Specifications;

use Domain\Asset\Entities\Character;
use Domain\Asset\Enums\HairTypeEnum;
use Domain\Shared\Specifications\SpecificationInterface;

class BaldHairCompatibilitySpecification implements SpecificationInterface
{
    private string $failureReason = '';

    public function isSatisfiedBy(mixed $candidate): bool
    {
        if (!$candidate instanceof Character) {
            return false;
        }

        $hairProfile =$candidate->getHairProfile();
        $grooming    =$candidate->getCurrentGrooming();

        if ($hairProfile->getAndreWalkerType() === HairTypeEnum::BALD) {
            if ($grooming->getSecondaryColor() !== null) {$this->failureReason = 'Un personaje calvo no puede tener color secundario o mechas.';
                return false;
            }

            if ($grooming->getHairFinish() !== HairFinishEnum::NONE) {$this->failureReason = 'Un personaje calvo no puede aplicar acabados de peinado (gomina, peinado mojado, etc.).';
                return false;
            }
        }

        return true;
    }

    public function getFailureReason(): string
    {
        return $this->failureReason;
    }
}
```

B. LayeringCompatibilitySpecification

Asegura que un Outfit no contenga superposiciones de prendas imposibles.

    Ubicación: Domain\Asset\Specifications\LayeringCompatibilitySpecification.php

```php

namespace Domain\Asset\Specifications;

use Domain\Asset\Entities\Outfit;
use Domain\Asset\Enums\GarmentCategoryEnum;
use Domain\Shared\Specifications\SpecificationInterface;

class LayeringCompatibilitySpecification implements SpecificationInterface
{
    private string $failureReason = '';

    public function isSatisfiedBy(mixed $candidate): bool
    {
        if (!$candidate instanceof Outfit) {
            return false;
        }

        $garments = $candidate->getGarments();$hasFullBody = false;
        $hasSeparateTopOrBottom = false;

        foreach ($garments as$slot) {
            $garment =$slot->getGarment();
            
            if ($garment->getCategory() === GarmentCategoryEnum::FULL_BODY) {$hasFullBody = true;
            }

            if (in_array($garment->getCategory(), [GarmentCategoryEnum::TOP, GarmentCategoryEnum::BOTTOM], true)) {$hasSeparateTopOrBottom = true;
            }
        }

        if ($hasFullBody && $hasSeparateTopOrBottom) {$this->failureReason = 'No se puede combinar una prenda de cuerpo entero (FULL_BODY) con partes superiores o inferiores independientes en la misma capa base.';
            return false;
        }

        return true;
    }

    public function getFailureReason(): string
    {
        return $this->failureReason;
    }
}
```

2. Composición de Especificaciones (Composite Specifications)

Para combinar múltiples reglas de forma fluida, se utilizan especificadores lógicos (AndSpecification, OrSpecification, NotSpecification).

```php
namespace Domain\Shared\Specifications;

class AndSpecification implements SpecificationInterface
{
    /** @var array<SpecificationInterface> */
    private array $specifications;
    private string $failureReason = '';

    public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications =$specifications;
    }

    public function isSatisfiedBy(mixed $candidate): bool
    {
        foreach ($this->specifications as$spec) {
            if (!$spec->isSatisfiedBy($candidate)) {
                $this->failureReason =$spec->getFailureReason();
                return false;
            }
        }
        return true;
    }

    public function getFailureReason(): string
    {
        return $this->failureReason;
    }
}
```

3. Matriz Declarativa de Incompatibilidades (Declarative Conflict Matrix)

Para las reglas de catálogo que cambian dinámicamente o son añadidas por la comunidad, se utiliza una Estructura Declarativa de Etiquetas (Tag Matrix).

Cada término o asset del catálogo puede declarar:

    provides_tags: Etiquetas que activa cuando es seleccionado.

    requires_tags: Etiquetas que deben estar presentes para poder seleccionarlo.

    conflicts_with: Etiquetas que bloquean su selección.

3.1 Ejemplo de Declaración de Reglas en JSON / Array:

```json

{
  "term_key": "shaved_bald",
  "category": "HAIRSTYLE",
  "provides_tags": ["hairless"],
  "conflicts_with": ["highlights", "braids", "hair_finish_wet", "hair_ponytail"]
},
{
  "term_key": "neon_highlights",
  "category": "HAIR_COLOR",
  "requires_tags": ["has_hair"],
  "conflicts_with": ["hairless"]
}
```

4. Evaluador para el Frontend (Vue 3 / Reactividad)

El CatalogContext expone un Endpoint / DTO hacia la UI de Vue.js con la matriz de conflictos activa.

El estado de Vue.js utiliza esta matriz para deshabilitar automáticamente en tiempo real las opciones incompatibles en los selectores/dropdowns sin necesidad de llamadas HTTP adicionales:


```js

// Pseudocódigo del motor de reactividad en Frontend (Vue 3 Composable)
export function useCompatibilityEngine(selectedTags) {
  const isOptionDisabled = (option) => {
    // 1. Verificar si la opción entra en conflicto con las etiquetas seleccionadas
    const hasConflict = option.conflicts_with?.some(tag => selectedTags.value.includes(tag));
    
    // 2. Verificar si la opción requiere etiquetas que no están presentes
    const missingRequirement = option.requires_tags?.some(tag => !selectedTags.value.includes(tag));

    return hasConflict || missingRequirement;
  };

  return { isOptionDisabled };
}

```
