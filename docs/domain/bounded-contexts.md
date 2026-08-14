# Bounded Contexts (Contextos Delimitados)

El sistema se divide en cuatro contextos delimitados con límites explícitos de responsabilidad y modelos de datos independientes:

```txt
+-------------------------------------------------------------------+
|                        1. CATALOG CONTEXT                         |
|   (Taxonomías, Vocabulario Técnico, Etiquetas y Restricciones)   |
+---------------------------------+---------------------------------+
|
v
+---------------------------------+---------------------------------+
|                        2. ASSET CONTEXT                         |
|   (Entidades Reutilizables: Personajes, Outfits, Poses, Escenas)  |
+---------------------------------+---------------------------------+
|
v
+---------------------------------+---------------------------------+
|                      3. COMPOSER CONTEXT                          |
|  (Composición, Mutaciones, Reglas de Compatibilidad, Reactividad) |
+---------------------------------+---------------------------------+
|
v
+---------------------------------+---------------------------------+
|                    4. TRANSLATION CONTEXT                         |
|  (Transformación a JSON Canónico y Conexión con LLM / Gems)       |
+-------------------------------------------------------------------+
```

## 2. Definición Detallada de Contextos Delimitados

### 2.1 Catalog Context (Contexto de Catálogo)

* **Propósito:** Actuar como la Fuente Única de Verdad (*Single Source of Truth*) para el vocabulario técnico, las clasificaciones antropométricas/textiles y las matrices de incompatibilidad.
* **Límite de Dominio:** No conoce conceptos de usuarios particulares, proyectos ni composiciones activas; solo administra el conocimiento taxonómico global y extendido por la comunidad.
* **Propietario de Datos:** Sistema (Términos Estándar) y Administradores / Comunidad (Propuestas de extensión).
* **Agregado Principal:** `TaxonomyTermAggregate`
* **Objetos de Valor / Entidades Internas:** `CompatibilityRule`, `TagMatrix`.
* **Eventos de Dominio Emitidos:**
  * `TaxonomyTermCreated`
  * `CompatibilityRuleRegistered`
  * `TaxonomyTermDeprecated`

---

### 2.2 Asset Context (Contexto de Activos)

* **Propósito:** Gestionar el ciclo de vida, persistencia y validación de consistencia interna de los bloques constructivos fundamentales reutilizables por los usuarios.
* **Límite de Dominio:** Garantiza que cada activo (Personaje, Atuendo, Pose, Escena) nazca y persista en un estado válido. No gestiona estados temporales ni borradores de composición.
* **Propietario de Datos:** Usuarios de la plataforma (Multi-Tenant).
* **Agregados Principales:**
  * `CharacterAggregate` (Sujeto / Anatomía / Visagismo)
  * `OutfitAggregate` (Vestuario por Capas)
  * `PoseAggregate` (Postura / Expresión / Encuadre)
  * `SceneAggregate` (Entorno / Iluminación / Óptica)
* **Eventos de Dominio Emitidos:**
  * `CharacterCreated`, `CharacterUpdated`
  * `OutfitCreated`, `GarmentAddedToOutfit`
  * `PoseCreated`, `SceneCreated`

---

### 2.3 Composer Context (Contexto de Composición)

* **Propósito:** Orquestar la mesa de trabajo (Canvas) reactiva. Combina activos por referencia (`UUID`), aplica alteraciones en caliente (*MutationOverrides*) sin tocar la base de datos de origen y compila el estado resuelto en un objeto inmutable.
* **Límite de Dominio:** No modifica la definición de los activos originales. Su responsabilidad principal es la reactividad del workspace, la resolución de especificaciones al vuelo y la emisión del contrato canónico.
* **Propietario de Datos:** Usuario activo en sesión.
* **Agregado Principal:** `PromptCompositionAggregate`
* **Entidades Internas / VOs:** `MutationOverride`, `CanonicalPrompt` (Compilado).
* **Eventos de Dominio Emitidos:**
  * `CompositionCreated`
  * `AssetAttachedToComposition`
  * `MutationAppliedToComposition`
  * `CanonicalPromptCompiled`

---

### 2.4 Translation Context (Contexto de Traducción)

* **Propósito:** Recibir el `CanonicalPrompt` compilado y traducirlo mediante adaptadores externos (Gems / LLM APIs) hacia las sintaxis específicas de motores de generación (Midjourney v6, Flux.1, SDXL).
* **Límite de Dominio:** Es totalmente agnóstico de la lógica de negocio de la aplicación, los usuarios o el catálogo. Solo procesa el DTO canónico y gestiona las llamadas asíncronas a los modelos de lenguaje.
* **Agregado / Servicios:** `TranslationJobAggregate`, `GemTranslationAdapter` (Service).
* **Eventos de Dominio Emitidos:**
  * `TranslationRequested`
  * `TranslationCompleted`
  * `TranslationFailed`

---

## 3. Mapa de Relaciones y Patrones de Integración (Context Mapping)

| Contexto Origen (Upstream) | Contexto Destino (Downstream) | Patrón de Integración DDD | Mecanismo de Comunicación |
| :--- | :--- | :--- | :--- |
| **Catalog Context** | **Asset Context** | **Published Language / Open Host Service** | Los agregados de `Asset` validan sus categorías consumiendo la taxonomía publicada por `Catalog`. |
| **Catalog Context** | **Composer Context** | **Shared Kernel (Read-Only)** | `Composer` consulta la Matriz de Compatividades para deshabilitar opciones en tiempo real en la UI. |
| **Asset Context** | **Composer Context** | **Customer-Supplier / ID Reference** | `Composer` guarda únicamente los `UUID`s (`CharacterId`, `OutfitId`) de los activos de `Asset Context`. |
| **Composer Context** | **Translation Context** | **Published Language + Anti-Corruption Layer (ACL)** | `Composer` emite el `CanonicalPrompt` (JSON v1.0.0). `Translation` usa una capa ACL para aislar sus adaptadores. |

## 4. Estrategia de Invariantes y Eventos Cruzados

1. **Aislamiento por Identificadores:** Ninguna tabla o modelo de base de datos del `Composer Context` tiene claves foráneas directas (*Foreign Keys*) nivel ORM con las entidades del `Asset Context`. Toda asociación se resuelve en la capa de aplicación mediante identificadores de Objetos de Valor (`UUID`).
2. **Propagación Asíncrona:** Cuando un personaje es modificado en el `Asset Context`, se emite un evento `CharacterUpdated`. El `Composer Context` escucha este evento de forma asíncrona para notificar al usuario en el Canvas que existe una versión actualizada del activo base disponible para sincronizar.
3. **Escudo Anti-Corrupción (ACL):** Si un proveedor de IA (ej. Midjourney) cambia radicalmente sus parámetros o sintaxis, **ningún código de los contextos `Catalog`, `Asset` o `Composer` requiere modificación**. Únicamente se actualiza el adaptador correspondiente dentro del `Translation Context`.
