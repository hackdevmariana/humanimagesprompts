# Lenguaje Ubicuo de Dominio (Ubiquitous Language)

En **Domain-Driven Design (DDD)**, el Lenguaje Ubicuo es el vocabulario riguroso y sin ambigüedades compartido entre ingenieros de software, antropólogos, estetas visuales, fotógrafos e ingenieros de prompts. 

Ningún término en el código (clases, variables, métodos, tablas de BD) o en la interfaz de usuario debe desviarse de las definiciones contenidas en este documento.

---

## 1. Conceptos del Contexto de Activos (Asset Context)

### 1.1 Anatomo-Morfología y Visagismo
* **Character (Sujeto / Personaje):** Agregado principal que modela la identidad antropológica, genética, biológica y estilística de una persona.
* **Visagismo:** Disciplina de análisis estético que estudia las proporciones y formas de la estructura craneofacial (dolicocéfalo, braquicéfalo, rostro oval, cuadrado, etc.).
* **Fitzpatrick Scale (Escala Fitzpatrick):** Clasificación numérica de seis tipos (I a VI) para la pigmentación de la piel humana y su respuesta a la radiación ultravioleta/luz.
* **Undertone (Subtono):** Matriz cromática subyacente de la piel (cálido/dorado, frío/rosado, neutro, oliva) independiente de la claridad de la tez.
* **Andre Walker Scale (Escala Andre Walker):** Clasificación estandarizada del tipo de cabello basada en el patrón de rizo y textura (desde `1A` liso fino hasta `4C` afro muy denso/kinky).
* **Grooming (Estilismo Capilar y Facial):** Atributos mutables del personaje referentes a peinado, acabados (gomina, mate, mojado), longitud, corte y diseño de vello facial/barba.

### 1.2 Vestuario y Textil
* **Garment (Prenda):** Unidad física individual de vestir (ej. camiseta, chaqueta, pantalón, calzado) provista de atributos de material, tejido y patrón.
* **Fabric (Materia Textil):** Objeto de valor que describe las propiedades físicas del material (ej. algodón, cuero, seda, denier de la tela, gramaje y opacidad).
* **Layer Slot (Ranura de Capa):** Posición física de superposición en el cuerpo (`BASE_LAYER`, `MID_LAYER`, `OUTER_LAYER`, `FOOTWEAR`, `HEADWEAR`).
* **Outfit (Atuendo):** Agregado que combina múltiples prendas distribuidas ordenadamente en sus correspondientes *Layer Slots*.
* **Layering Engine (Motor de Capas):** Lógica del sistema que valida que la combinación de prendas respete la física del vestir sin solapamientos imposibles.

### 1.3 Fotografía y Cinemática
* **Lighting Setup (Esquema de Iluminación):** Configuración física de las fuentes de luz principales y secundarias en una toma (ej. Rembrandt, Butterfly, Hora Dorada, Neón Cyberpunk).
* **Key Light (Luz Principal):** Fuente primaria de iluminación que define las sombras clave sobre el sujeto.
* **Depth of Field (Profundidad de Campo):** Zona de la imagen que se aprecia nítida. Una apertura grande ($f/1.2$) produce un *bokeh* acentuado (*Shallow Bokeh*).
* **Framing (Encuadre):** Tipo de plano fotográfico aplicado a la pose o escena (`CLOSE_UP`, `MEDIUM_SHOT`, `FULL_BODY`).

---

## 2. Conceptos del Contexto de Catálogo (Catalog Context)

* **Taxonomy Term (Término Taxonómico):** Elemento del catálogo clasificado en una categoría técnica estandarizada (ej. `DOLICHOCEPHALIC` en la categoría `CRANIAL_SHAPE`).
* **Declarative Tag Matrix (Matriz Declarativa de Etiquetas):** Grafo de relaciones entre términos donde cada elemento declara qué etiquetas provee (`provides_tags`), requiere (`requires_tags`) o bloquea (`conflicts_with`).
* **Conflict Rule / Compatibility Rule (Regla de Incompatibilidad):** Restricción de dominio que prohíbe la coexistencia de dos o más términos incompatibles (ej. la etiqueta `hairless` bloquea cualquier peinado con trenzas o acabados).
* **Specification (Especificación):** Clase del dominio que implementa el *Specification Pattern* para evaluar la coherencia de un Agregado frente a las reglas de negocio.

---

## 3. Conceptos del Contexto de Composición (Composer Context)

* **Prompt Composition (Composición):** Agregado Maestro del espacio de trabajo que ensambla las referencias (`UUIDs`) de un Personaje, Vestuario, Pose y Escena.
* **Canvas (Lienzo / Mesa de Trabajo):** Interfaz reactiva e inercial donde el usuario combina assets y aplica modificaciones en tiempo real.
* **Mutation Override (Alteración en Caliente):** Modificación puntual a un atributo específico de un asset aplicada únicamente dentro del alcance de una composición activa, dejando el asset original intacto en la base de datos.
* **Draft (Borrador):** Estado intermedio e inestable de una composición en proceso de edición.

---

## 4. Conceptos del Contexto de Traducción (Translation Context)

* **Canonical Prompt (Prompt Canónico):** Objeto JSON estandarizado (v1.0.0) e inmutable emitido por el `Composer Context` que consolida todo el estado resuelto y mutado de la composición.
* **Translation Adapter / Gem (Adaptador de Traducción / Gem):** Componente de software o agente LLM encargado de traducir el *Canonical Prompt* a la sintaxis y comandos específicos de un motor de IA destino.
* **Target Model (Modelo Destino):** Motor de difusión de IA al que se dirige el prompt exportado (ej. Midjourney v6, Flux.1 Dev, Stable Diffusion XL).
* **Engine Flags (Parámetros del Motor):** Modificadores de sintaxis específicos del modelo destino (ej. `--ar 16:9 --style raw --v 6.0`).

---

## 5. Tabla Resumen de Mapeo Técnico

| Término Negocio | Clase / Concepto en Código | Contexto Delimitado (Bounded Context) |
| :--- | :--- | :--- |
| **Sujeto / Personaje** | `Character` (Aggregate Root) | `Asset Context` |
| **Atuendo** | `Outfit` (Aggregate Root) | `Asset Context` |
| **Escena** | `Scene` (Aggregate Root) | `Asset Context` |
| **Término del Catálogo** | `TaxonomyTerm` (Aggregate Root) | `Catalog Context` |
| **Composición Activa** | `PromptComposition` (Aggregate Root) | `Composer Context` |
| **Alteración Puntual** | `MutationOverride` (Value Object / Entity) | `Composer Context` |
| **Prompt Canónico** | `CanonicalPrompt` (Value Object / DTO) | `Composer / Translation Context` |
| **Adaptador LLM** | `GemTranslationAdapter` (Service) | `Translation Context` |
