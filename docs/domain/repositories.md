# Interfaces de Repositorios de Dominio (Repositories)

En la arquitectura de **HumanImagesPrompts**, los Repositorios actúan como colecciones en memoria de Agregados. 

## Reglas de Arquitectura para Repositorios:
1. **Contratos en Dominio:** Las interfaces residen en `Domain\*\Repositories\`, mientras que sus implementaciones concretas (utilizando Laravel Eloquent) pertenecen a la capa de `Infrastructure\Persistence\Repositories\`.
2. **Operación Exclusiva con Agregados:** Ningún repositorio gestiona directamente Entidades internas ni Objetos de Valor; únicamente procesa la Raíz del Agregado (`Aggregate Root`).
3. **Firmas Fuertemente Tipadas:** Todos los métodos de búsqueda utilizan Objetos de Valor como identificadores (`CharacterId`, `UserId`, etc.) o criterios de búsqueda explícitos (*Criteria Pattern*).

---

## 1. Contexto: Asset Context

### 1.1 `CharacterRepositoryInterface`
Contrato de persistencia para el Agregado `CharacterAggregate`.

* **Ubicación:** `Domain\Asset\Repositories\CharacterRepositoryInterface.php`
* **Métodos:**

```php
namespace Domain\Asset\Repositories;

use Domain\Asset\Entities\Character;
use Domain\Asset\ValueObjects\CharacterId;
use Domain\Shared\ValueObjects\UserId;

interface CharacterRepositoryInterface
{
    /**
     * Guarda o actualiza un Agregado Character de forma atómica.
     */
    public function save(Character $character): void;

    /**
     * Obtiene un personaje por su identificador único.
     */
    public function findById(CharacterId $id): ?Character;

    /**
     * Recupera todos los personajes creados por un usuario específico (Paginado).
     */
    public function findByUserId(UserId $userId, int $page = 1, int$perPage = 15): array;

    /**
     * Recupera personajes públicos compartidos con la comunidad.
     */
    public function findPublic(int $page = 1, int$perPage = 15): array;

    /**
     * Elimina un personaje del sistema.
     */
    public function delete(CharacterId $id): void;
}
```

1.2 OutfitRepositoryInterface

Contrato de persistencia para el Agregado OutfitAggregate.

    Ubicación: Domain\Asset\Repositories\OutfitRepositoryInterface.php

    Métodos:

```php
namespace Domain\Asset\Repositories;

use Domain\Asset\Entities\Outfit;
use Domain\Asset\ValueObjects\OutfitId;
use Domain\Shared\ValueObjects\UserId;

interface OutfitRepositoryInterface
{
    public function save(Outfit $outfit): void;

    public function findById(OutfitId $id): ?Outfit;

    public function findByUserId(UserId $userId, int $page = 1, int$perPage = 15): array;

    public function findByStyleCategory(string $styleCategory, int $page = 1, int$perPage = 15): array;

    public function delete(OutfitId $id): void;
}
```

1.3 PoseRepositoryInterface

Contrato de persistencia para el Agregado PoseAggregate.

    Ubicación: Domain\Asset\Repositories\PoseRepositoryInterface.php

    Métodos:

```php
namespace Domain\Asset\Repositories;

use Domain\Asset\Entities\Pose;
use Domain\Asset\ValueObjects\PoseId;
use Domain\Shared\ValueObjects\UserId;

interface PoseRepositoryInterface
{
    public function save(Pose $pose): void;

    public function findById(PoseId $id): ?Pose;

    public function findByCategory(string $category, int $page = 1, int$perPage = 15): array;

    public function findAvailableForUser(UserId $userId, int $page = 1, int$perPage = 15): array;

    public function delete(PoseId $id): void;
}
```

1.4 SceneRepositoryInterface

Contrato de persistencia para el Agregado SceneAggregate.

    Ubicación: Domain\Asset\Repositories\SceneRepositoryInterface.php

    Métodos:

```php
namespace Domain\Asset\Repositories;

use Domain\Asset\Entities\Scene;
use Domain\Asset\ValueObjects\SceneId;
use Domain\Shared\ValueObjects\UserId;

interface SceneRepositoryInterface
{
    public function save(Scene $scene): void;

    public function findById(SceneId $id): ?Scene;

    public function findByEnvironmentType(string $environmentType, int $page = 1, int$perPage = 15): array;

    public function findAvailableForUser(UserId $userId, int $page = 1, int$perPage = 15): array;

    public function delete(SceneId $id): void;
}
```

2. Contexto: Composer Context
2.1 PromptCompositionRepositoryInterface

Contrato de persistencia para el Agregado Raíz del espacio de trabajo PromptCompositionAggregate.

    Ubicación: Domain\Composer\Repositories\PromptCompositionRepositoryInterface.php

    Métodos:

```php
namespace Domain\Composer\Repositories;

use Domain\Composer\Entities\PromptComposition;
use Domain\Composer\ValueObjects\PromptCompositionId;
use Domain\Shared\ValueObjects\UserId;

interface PromptCompositionRepositoryInterface
{
    /**
     * Guarda la composición activa con todos sus overrides y estado compilado.
     */
    public function save(PromptComposition $composition): void;

    public function findById(PromptCompositionId $id): ?PromptComposition;

    /**
     * Recupera los borradores o composiciones guardadas de un usuario.
     */
    public function findByUserId(UserId $userId, int $page = 1, int$perPage = 15): array;

    /**
     * Obtiene la última composición activa (borrador en progreso) de un usuario.
     */
    public function findLatestActiveByUserId(UserId $userId): ?PromptComposition;

    public function delete(PromptCompositionId $id): void;
}
```

3. Contexto: Catalog Context
3.1 TaxonomyTermRepositoryInterface

Contrato para consultar y extender la taxonomía técnica y las matrices de incompatibilidad.

    Ubicación: Domain\Catalog\Repositories\TaxonomyTermRepositoryInterface.php

    Métodos:
```php

namespace Domain\Catalog\Repositories;

use Domain\Catalog\Entities\TaxonomyTerm;
use Domain\Catalog\ValueObjects\TaxonomyTermId;
use Domain\Shared\ValueObjects\UserId;

interface TaxonomyTermRepositoryInterface
{
    public function save(TaxonomyTerm $term): void;

    public function findById(TaxonomyTermId $id): ?TaxonomyTerm;

    public function findByKey(string $key): ?TaxonomyTerm;

    /**
     * Obtiene todos los términos pertenecientes a una categoría específica (ej: CRANIAL_SHAPE).
     */
    public function findByCategory(string $category): array;

    /**
     * Obtiene todo el catálogo disponible para un usuario (Términos oficiales del sistema + personalizados del usuario).
     */
    public function findAllAvailableForUser(UserId $userId): array;

    /**
     * Recupera las reglas de incompatibilidad cruzada entre términos del catálogo.
     */
    public function getCompatibilityMatrix(): array;
}
```
