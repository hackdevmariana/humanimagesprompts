# Límites del Dominio y Fuera de Alcance (Non-Goals)

> **"Un buen diseño de software se define tanto por las responsabilidades que asume como por las que delega explícitamente."**

Para mantener una arquitectura limpia, desacoplada y enfocada exclusivamente en la **ingeniería determinista de activos de prompt**, **HumanImagesPrompts Engine** establece los siguientes límites de dominio:

---

## 1. Declaración de Non-Goals

### 1.1 Generación o Renderizado Directo de Imágenes
* **Fuera de Alcance:** El sistema **no** actúa como un clúster de inferencia, no aloja GPUs (como CUDA/TensorRT) ni ejecuta modelos de difusión (Stable Diffusion, ComfyUI, FLUX) en sus propios servidores.
* **Justificación Arquitectónica:** La responsabilidad del motor termina en la compilación del `CanonicalPrompt` y su traducción/exportación mediante el `Translation Context`. La generación de la imagen final es responsabilidad de APIs externas (Midjourney, Replicate, Fal.ai) o entornos locales del usuario.
* **Lo que SÍ hace el sistema:** Ofrecer integración por Webhooks o APIs para recibir la URL del resultado generado externamente y vincularla como vista previa del activo.

---

### 1.2 Procesamiento Inverso por Visión / OCR (Image-to-Prompt)
* **Fuera de Alcance:** La plataforma no realiza *reverse engineering* de imágenes subidas por los usuarios utilizando modelos de visión por computador (VLM/BLIP) para adivinar sus parámetros o descomponerlas automáticamente en componentes de dominio.
* **Justificación Arquitectónica:** El objetivo central es la **creación estructurada y determinista** basada en la taxonomía de dominio. El análisis de imágenes por IA generaría datos ruidosos o ambiguos que violarían los invariantes del catálogo.
* **Lo que SÍ hace el sistema:** Permitir al usuario construir manualmente el activo usando el catálogo o importar presets en formato JSON estructurado.

---

### 1.3 Canvas de Manipulación Espacial o Rigging 3D
* **Fuera de Alcance:** El frontend en Vue.js **no** incorporará un motor gráfico 3D (WebGL/Three.js) para posicionamiento de huesos, *rigging* de personajes o manipulación de mallas (estilo Daz3D, Poser o Blender).
* **Justificación Arquitectónica:** La selección de poses, gestos y encuadres se realiza mediante **taxonomías y combinatoria paramétrica** (Objetos de Valor y Agregados). Añadir manipuladores 3D introduciría una complejidad monumental en la UI sin aportar valor al ensamblado del prompt canónico.
* **Lo que SÍ hace el sistema:** Proporcionar un catálogo semántico de poses categorizadas (*High Fashion, Sport, Natural*) con vistas previas conceptuales de encuadre.

---

### 1.4 Hardcoding de Sintaxis Específicas de IA en el Dominio Core
* **Fuera de Alcance:** El backend de la aplicación no mantendrá listas de expresiones regulares ni condicionales rígidos para formatear parámetros según las constantes variaciones de Midjourney (v5, v6, v7), Flux o SDXL.
* **Justificación Arquitectónica:** La sintaxis de los modelos de difusión cambia constantemente. Acoplar el motor a estas sintaxis destruiría la estabilidad del dominio. 
* **Lo que SÍ hace el sistema:** El motor solo emite el `CanonicalPrompt` (JSON v1.0.0). La traducción a sintaxis concretas es delegada al **Translation Context**, que utiliza agentes LLM (Gems) cuyo prompt del sistema es fácilmente actualizable sin modificar código de backend.

---

### 1.5 Almacenamiento Masivo y CDN de Renders de Alta Resolución
* **Fuera de Alcance:** El sistema no funciona como un almacén ilimitado de archivos binarios pesados (TIFF, PNGs de 8K o archivos RAW de render).
* **Justificación Arquitectónica:** HumanImagesPrompts es un *Prompt-Driven Digital Asset Management* (DAM de metadatos y composiciones), no un CDN de almacenamiento de medios pesados.
* **Lo que SÍ hace el sistema:** Almacenar miniaturas (*thumbnails*) optimizadas de las vistas previas y referencias a las URLs externas donde residen los renders originales.

---

### 1.6 Ejecución Directa de LLMs en el Dominio Core
* **Fuera de Alcance:** Los servicios del dominio (`Asset`, `Composer`, `Catalog`) no invocan directamente llamadas a APIs de LLMs para resolver la lógica de negocio.
* **Justificación Arquitectónica:** Las reglas de compatibilidad, validaciones de anatomía y composiciones son 100% deterministas y se evalúan mediante código PHP puro (Especificaciones y Matriz Tag-Driven).
* **Lo que SÍ hace el sistema:** Conectar con LLMs únicamente en el límite exterior de la arquitectura (**Translation Context**) como una tarea asíncrona / adaptador de infraestructura.

---

## 2. Matriz de Mapeo: Qué SÍ Hacemos vs. Qué NO Hacemos

| Dimensión | En el Alcance (In-Scope) | Fuera de Alcance (Non-Goal) |
| :--- | :--- | :--- |
| **Modelado de Personajes** | Parámetros antropológicos, visagismo, escala Andre Walker, subtonos. | Esculpir mallas 3D o manipular vértices faciales. |
| **Generación** | Producción de un JSON Canónico y comandos de prompt traducidos. | Inferencia en GPU, servidor de Stable Diffusion o ComfyUI. |
| **Validación** | Motor de especificaciones y matriz declarativa de compatibilidad. | Parsing de texto libre o validación mediante expresiones regulares de Midjourney. |
| **Traducción** | Invocación de Gems/LLMs como adaptadores externos de sintaxis. | Lógica de negocio del dominio dependiente de respuestas de LLM. |
| **Almacenamiento** | Definiciones de agregados, esquemas JSON y thumbnails ligeros. | Hosting de imágenes renderizadas de alta resolución (8K/RAW). |
