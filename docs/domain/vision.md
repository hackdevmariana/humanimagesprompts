# Visión de Producto: HumanImagesPrompts Engine

> **"De la ingeniería de prompts caótica a la gestión determinista de activos digitales para Inteligencia Artificial."**

---

## 1. Declaración de Misión y Filosofía

**HumanImagesPrompts Engine** es una infraestructura de software desacoplada, modular y reactiva (*Prompt-Driven Digital Asset Management*) diseñada para transformar la generación de imágenes fotorrealistas con IA.

Actualmente, la creación de imágenes mediante modelos de difusión (Midjourney, Flux, Stable Diffusion) padece del **"caos de la cadena de texto"**: prompts kilométricos, inconsistencia en la identidad de los personajes, imposibilidad de reutilizar vestuarios y dependencia del ensayo y error.

**HumanImagesPrompts** resuelve esta problemática tratando la morfología humana, el vestuario por capas, la física de la luz y la óptica cinematográfica no como texto plano, sino como **componentes de dominio fuertemente tipados, inmutables, mutables en caliente y completamente reutilizables**.

---

## 2. Los Cuatro Pilares Arquitectónicos (Bounded Contexts)

La plataforma se articula sobre cuatro Contextos Delimitados (*Bounded Contexts*) bajo los principios de *Domain-Driven Design (DDD)*:



```txt
+-------------------------------------------------------------------+
|                        1. CATALOG CONTEXT                         |
|   (Taxonomías Técnicas, Matriz de Incompatibilidades y Reglas)    |
+-------------------------------------------------------------------+
|
v
+-------------------------------------------------------------------+
|                         2. ASSET CONTEXT                          |
|   (Personajes, Vestuario por Capas, Poses, Iluminación y Óptica)  |
+-------------------------------------------------------------------+
|
v
+-------------------------------------------------------------------+
|                        3. COMPOSER CONTEXT                        |
|   (Mesa de Trabajo Reactiva, Mutaciones en Caliente y JSON JSON)  |
+-------------------------------------------------------------------+
|
v
+-------------------------------------------------------------------+
|                      4. TRANSLATION CONTEXT                       |
|   (Adaptadores LLM / Gems -> Midjourney, Flux.1, Stable Diffusion)|
+-------------------------------------------------------------------+
``` 

1. **Catalog Context:** Define el lenguaje técnico universal (visagismo, escala Andre Walker, fototipos Fitzpatrick, reglas de óptica) y sostiene la matriz de compatibilidades declarativas.
2. **Asset Context:** Encapsula las entidades y agregados reutilizables (Personajes con rigor antropológico, Prendas con propiedades textiles reales, Escenas con parámetros físicos de cámara).
3. **Composer Context:** Ofrece un lienzo reactivo (Vue.js/Inertia) que permite ensamblar activos y aplicar modificaciones puntuales (*MutationOverrides*) sin alterar los activos originales en la base de datos.
4. **Translation Context:** Traduce el JSON canónico compilado hacia la sintaxis y comandos específicos de cualquier motor de IA objetivo mediante agentes adaptadores (Gems).

---

## 3. Capacidades Clave del Dominio

### 3.1 Precisión Antropológica y Visagismo
* **Morfología Craneofacial:** Estructuración del rostro mediante categorías técnicas de visagismo (dolicocéfalo, braquicéfalo, estructura en diamante, mandibulares marcadas, etc.).
* **Perfil Cutáneo Biológico:** Clasificación de pieles mediante la escala Fitzpatrick (Tipos I-VI), subtonos (cálidos, fríos, oliva) y microdetalles cutáneos (pecas, nevos, textura natural).
* **Cabello y Vello Facial:** Uso estricto de la escala Andre Walker (1A a 4C), densidades, porosidades y acabados de peluquería profesional.

### 3.2 Vestuario Físico por Capas (*Layering Engine*)
* **Física Textil:** Definición de materiales (lino, seda, cuero, denier de tela, gramaje, opacidad).
* **Arquitectura de Capas:** Sistema estricto de ranuras (*Base Layer, Mid Layer, Outer Layer, Accessories*) que impide colisiones físicas entre prendas (ej: imposibilidad de vestir un overol de cuerpo entero junto a un pantalón en la misma capa base).

### 3.3 Cinematografía y Física de la Luz
* **Óptica Profesional:** Parámetros reales de fotografía (distancias focales de 24mm a 200mm, apertura $f$-stop, profundidad de campo con bokeh real, grano de película de 35mm).
* **Esquemas de Iluminación:** Configuraciones fotográficas estándar (Rembrandt, Butterfly, Hora Dorada, Neón Cyberpunk) con control estricto de temperatura de color en Kelvin (2700K - 6500K) y dureza de sombras.

### 3.4 Motor de Compatibilidad No Intrusivo
* **Reglas Declarativas:** Reemplazo de bloques `if/else` por una **Matriz Tag-Driven** y el **Patrón Especificación**. El dominio autoevalúa la coherencia entre elementos (ej: bloquear gomina o mechas en personajes calvos) tanto en el servidor como en tiempo real en la UI.

---

## 4. Ecosistema Multi-Tenant y Comunitario

El sistema está concebido para fomentar una comunidad de creadores de activos visuales:

* **Aislamiento Multi-Inquilino:** Cada usuario gestiona su biblioteca privada de personajes, ropa y escenas.
* **Catálogo Público y Curaduría:** Los usuarios pueden publicar sus activos en el catálogo global de la comunidad.
* **Extensibilidad Taxonómica:** Los usuarios expertos pueden proponer nuevos términos técnicos, prendas regionales o accesorios históricos al catálogo central.

---

## 5. Salida Objetivo: El Pipeline de Traducción

El motor **no genera código de imagen directamente en la capa de composición**, sino que compila un objeto intermedio inmutable: el **`CanonicalPrompt`** (JSON Schema v1.0.0).

Este JSON es interpretado por el **Translation Context**, permitiendo que una misma composición de personaje se traduzca de forma transparente a:

* **Midjourney v6:** Prompts descriptivos en inglés con flags tácticos (`--ar 16:9 --style raw --v 6.0`).
* **Flux.1 (Dev/Schnell):** Texto narrativo denso optimizado para la comprensión semántica de Flux.
* **Stable Diffusion XL / Pony:** Estructuras jerárquicas con etiquetas/boorus y prompts negativos.

---

## 6. Métricas de Éxito de la Arquitectura

1. **Reutilización del 100%:** Un personaje o atuendo creado una sola vez puede reutilizarse en infinitas composiciones.
2. **Cero Prompts Rotos:** Los invariantes y la matriz de compatibilidad garantizan que no existan combinaciones contradictorias enviadas al LLM.
3. **Inmutabilidad Garantizada:** Las mutaciones en un borrador jamás dañan la definición original del activo en la biblioteca.
4. **Resistencia al Futuro:** Si aparece un nuevo motor de generación de IA en el mercado, solo se requiere programar un nuevo adaptador en el *Translation Context*; los activos y composiciones existentes permanecen 100% válidos.
