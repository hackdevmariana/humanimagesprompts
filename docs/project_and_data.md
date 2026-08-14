# HumanImagesPrompts

> HumanImagesPrompts es un sistema modular para construir, almacenar, combinar y generar aleatoriamente personajes, poses, outfits, escenas y estilos visuales, transformando posteriormente esas composiciones en prompts para modelos de generación de imágenes.

Un interfaz web en el que se muestran diversos bloques con valores, inputs o textarea para rellenar o que se generan aleatoriamente valores. 

## Personaje

### Sexo

- Hombre
- Mujer

### Edad

Un slider de rango de 0 a 120.

### Apariencia

```txt
Skin
├── Tone
├── Undertone
└── Texture
```

## Cabeza

### 1. Tipos de Cabeza según la Estructura Craneal (Índice Cefálico)

Esta clasificación proviene de la antropología física y la morfología médica, midiendo la relación entre el ancho y el largo del cráneo. Es fundamental en peluquería para compensar volúmenes en la nuca y la coronilla.

* **Dolicocéfala (Cráneo alargado):**
  * **Características:** Predomina la longitud sobre la anchura. Vista de perfil, es una cabeza estrecha y alargada con la zona occipital (nuca) a menudo prominente.
  * **Efecto visual:** Tiende a aplanar lateralmente la cabeza.

* **Braquicéfala (Cráneo ancho o redondo):**
  * **Características:** El ancho y el largo del cráneo son casi iguales o la anchura es superior a la media. Vista de perfil, suele tener la zona posterior (occipital) bastante plana.
  * **Efecto visual:** Cabeza de aspecto compacto y plano por detrás.

* **Mesocéfala / Normocéfala (Cráneo armónico/promedio):**
  * **Características:** Proporciones intermedias y equilibradas entre la longitud y el ancho. Es la forma considerada genéticamente "estándar" o proporcionada.

### 2. Tipos de Rostro según la Forma Facial (Visagismo)

Esta es la clasificación morfológica del rostro (frente, pómulos, mandíbula y barbilla), determinante para diseñar cortes, flequillos y contornos (*contouring*).

* **Ovalado:**
  * **Características:** Rostro ligeramente más largo que ancho, con pómulos suaves y mandíbula redondeada. Es el rostro considerado con proporciones ideales y más simétrico.

* **Redondo:**
  * **Características:** Anchura y longitud similares. Ángulos suaves, pómulos marcados y mentón redondeado sin líneas duras.

* **Cuadrado:**
  * **Características:** Frente, pómulos y mandíbula tienen un ancho similar. La línea de la mandíbula es muy angulada y marcada.

* **Rectangular / Alargado:**
  * **Características:** Similar al cuadrado pero más largo que ancho. Líneas rectas en frente y mandíbula, con aspecto vertical prominente.

* **Triangular (Triángulo Primitivo / Forma de A):**
  * **Características:** Frente estrecha y mandíbula ancha o prominente.

* **Triángulo Invertido / Corazón (Forma de V):**
  * **Características:** Frente ancha y prominente que se estrecha drásticamente hacia una mandíbula fina y un mentón punzante. (El estilo "Corazón" suele presentar nacimientos del pelo con pico de viuda).

* **Diamante / Rombo:**
  * **Características:** Pómulos prominentes y anchos, con frente y mentón estrechos. Ángulos marcados en la zona media de la cara.

* **Hexagonal / Trapezoide:**
  * **Características:** Combinación de ángulos rectos con variaciones en el ancho de frente o mandíbula, muy estructurado.

### 3. Particularidades Craneales Mente Adaptables (Irregularidades)

Anomalías o variaciones anatómicas comunes que se corrigen mediante el volumen del cabello:

* **Plagiocefalia:** Asimetría o aplanamiento lateral/posterior del cráneo.
* **Cráneo Prominente o Occipital Alto:** Nuca muy sobresaliente.
* **Frente Prominente / Abombada:** Hueso frontal proyectado hacia adelante.

### Orejas

#### 1. Según la Proyección u Orientación (Proporción respecto al Cráneo)

* **Prominentes / En Asa / "Separadas":**
  * **Características:** El ángulo entre la cabeza y el pabellón auricular es superior a los 30 grados (o la distancia de la oreja al cráneo supera los 2 cm).
  * **Causa anatómica:** Ausencia o falta de desarrollo del pliegue del antehélicis o por una concha auricular hipertrófica (muy profunda).

* **Adheridas / Adosadas / "Pegadas":**
  * **Características:** Orejas pegadas al cráneo con una proyección mínima. Prácticamente no sobresalen en la vista frontal.

* **Asimétricas:**
  * **Características:** Orejas que presentan diferencias significativas en tamaño, ángulo de proyección o altura entre el lado izquierdo y el derecho.

#### 2. Según la Forma General del Pabellón Auricular

* **Ovaladas / Armónicas:**
  * **Características:** Siguen una curvatura uniforme en el hélicis. Guardan una proporción estándar respecto a las facciones del rostro (la parte superior coincide con la ceja y la inferior con la base de la nariz).

* **Redondeadas:**
  * **Características:** Ancho y alto proporcionales. El cartílago superior no presenta vértices marcados.

* **Alargadas / Estrechas:**
  * **Características:** Predomina la dimensión vertical sobre la horizontal. Suelen tener el antehélicis muy estirado.

* **Triangulares / En Punta ("Orejas de Fauno" o Nódulo de Darwin prominente):**
  * **Características:** Presentan un vértice pronunciado en la parte superior del hélicis. En ocasiones presentan el tuberculillo de Darwin (un engrosamiento cartilaginoso en el borde superior).

* **Orejas Cuadradas / Angulosas:**
  * **Características:** Los bordes superior e inferior no forman una curva continua, sino que presentan cambios de dirección rectos o marcados.

#### 3. Según la Morfología del Lóbulo

* **Lóbulo Libre / Despegado:**
  * **Características:** La parte inferior de la oreja cuelga libremente, separada de la mejilla o el cuello.
* **Lóbulo Adherido / Pegado:**
  * **Características:** El lóbulo se une directamente a la piel del rostro/cuello sin existir una caída continua o pliegue.
* **Lóbulo Pendular / Voluminoso:**
  * **Características:** Lóbulo de gran tamaño, carnosidad prominente y caído.
* **Sin Lóbulo:**
  * **Características:** El cartílago desciende de forma casi directa hasta el punto de inserción con la cara, eliminando prácticamente la zona carnosa.

#### 4. Variaciones y Modificaciones Anatómicas Notables

* **Microtia / Macrotia:**
  * **Microtia:** Orejas significativamente más pequeñas de lo normal por un subdesarrollo congénito.
  * **Macrotia:** Pabellones auriculares desproporcionadamente grandes respecto al resto de la cabeza.

* **Oreja en Copa / Constreñida (Cup Ear):**
  * **Características:** El borde superior del hélicis está plegado hacia abajo como una "capucha" o copa.

* **Cryptotia (Oreja Oculta):**
  * **Características:** La parte superior del cartílago está enterrada bajo la piel del cuero cabelludo.

### Pelo

#### 1. Colores de Cabello

* **Tonos Naturales (Escala de Alturas de Tono):**
  * Negro (1)
  * Moreno / Castaño muy oscuro (2 - 3)
  * Castaño medio / claro (4 - 5)
  * Rubio oscuro / medio / claro / muy claro / extra claro (6 - 10)
  * Pelirrojo / Cobrizo (Matices cálidos)
  * Caoba / Borgoña / Violín (Matices rojizos/violáceos)
  * Blanco / Cano / Gris / Platino (Decoloraciones extremas y canas)

* **Tonos Fantasía y Tendencia:**
  * **Pastel:** Rosa cuarzo, lavanda, azul bebé, verde menta.
  * **Neón / Vibrantes:** Fucsia, naranja ácido, verde lima, amarillo eléctrico.
  * **Metalizados:** Plata, oro rosa (Rose Gold), titanio, bronce.


#### 2. Tipos de Coloraciones y Técnicas

* **Técnicas Globales y Cobertura:**
  * **Tinte permanente:** Cobertura total y cambio duradero de tono.
  * **Demipermanente / Tono sobre tono:** Sin amoníaco, ideal para aportar brillo y matizar.
  * **Semipermanente / Baño de color:** Pigmento directo que se deslava con los lavados.

* **Técnicas de Aclarado, Mechas y Iluminación:**
  * **Mechas Tradicionales (con papel de aluminio):** Definidas desde la raíz.
  * **Babylights:** Mechas ultra finas para recrear reflejos naturales de sol.
  * **Balayage:** Barredura a mano alzada para un degradado progresivo y orgánico.
  * **Ombré / Sombré:** Degradado de oscuro a claro (marcado en Ombré, sutil en Sombré).
  * **Money Piece:** Aclarado concentrado únicamente en los dos mechones del rostro.
  * **Contouring:** Distribución de mechas según la morfología del rostro para esculpir facciones.
  * **Dip Dye / Puntas Teñidas:** Contraste de color drástico exclusivamente en las puntas.
  * **Chunky Highlights:** Mechas anchas y marcadas estilo años 90.
  * **Color Melt:** Fusión imperceptible de dos o tres tonos para eliminar cortes visuales.
  * **Gloss / Glaze / Matiz:** Baño de brillo neutralizador para corregir subtonos indeseados.

  * **Ninguno:** sin colorización extra.

```python
if coloring != none
    select secondary_color
```


#### 3. Longitudes de Cabello

* **Muy Corto:** Rapado, Buzz o estilo Garçón (de 0 a 5 cm).
* **Corto:** Por encima de las orejas o hasta la línea de la mandíbula.
* **Media Melena (Midi / Lob):** Desde la mandíbula hasta la altura de las clavículas.
* **Largo:** Desde la clavícula hasta la mitad de la espalda.
* **Muy Largo:** Por debajo de la cintura o cadera.

#### 4. Tipos y Texturas de Cabello

* **Por su Patrón de Forma (Escala Andre Walker):**
  * **Tipo 1 - Liso:** 1A (fino y lacio), 1B (con cuerpo), 1C (grueso y rígido).
  * **Tipo 2 - Ondulado:** 2A (onda suave en 'S'), 2B (onda definida), 2C (onda gruesa/encrespada).
  * **Tipo 3 - Rizado:** 3A (rizo abierto y elástico), 3B (tirabuzón apretado), 3C (rizo en espiral denso).
  * **Tipo 4 - Muy Rizado / Afro / Kinky:** 4A (patrón en 'S' muy denso), 4B (patrón en 'Z'), 4C (sin patrón definido, muy frágil y apretado).

* **Por su Grosor y Estructura:**
  * Fino, Medio, Grueso.

* **Por su Porosidad:**
  * Baja (cuesta absorber producto/agua), Media (equilibrada), Alta (absorbe y pierde humedad rápidamente).

#### 5. Estilos de Corte de Pelo

##### A. Hombre
* **Buzz Cut:** Rapado uniforme y muy corto.
* **Crew Cut:** Corto en laterales y nuca, ligeramente más largo arriba.
* **Fade / Degradado:** Transición progresiva desde la piel hacia arriba (Low, Mid, High Fade).
* **Undercut:** Contraste marcado entre laterales muy cortos o rapados y zona superior larga.
* **Pompadour:** Volumen elevado peinado hacia atrás en el tupé.
* **Quiff:** Similar al pompadour pero con textura desenfadada peinada hacia adelante y arriba.
* **French Crop:** Corto con flequillo recto o despuntado peinado hacia el frente.
* **Mullet:** Corto en frontal y laterales, largo en la nuca.
* **Taper Fade:** Degradado pulido enfocado solo en patillas y nuca.
* **Corte Ejecutivo / Clásico:** Peinado tradicional con raya al lado.
* **Man Bun / Melena Masculina:** Cabello largo recogido o suelto con corte estructurado.

##### B. Mujer
* **Bob y sus variantes:**
  * *Classic Bob:* Recto a la altura de la mandíbula.
  * *Lob (Long Bob):* Ligeramente más largo, descansando sobre las clavículas.
  * *French Bob:* Corto, a la altura de los pómulos y con flequillo.
  * *Blunt Bob:* Recto, despuntado y sin capas.
* **Pixie:** Corto en laterales y nuca con volumen y versatilidad en la zona superior.
* **Garçón:** Estilo corto clásico, suave y estilizado.
* **Shag / Shaggy:** Corte en capas desfiladas con aire desenfadado y volumen en la coronilla.
* **Wolf Cut:** Fusión entre el Shag y el Mullet, con capas muy texturizadas.
* **Butterfly Cut (Corte Mariposa):** Capas enmarcadas que dan la sensación de melena corta delante y larga detrás.
* **Corte en Capas (Layers):** Estructura para aportar volumen, movimiento o descargar peso.
* **Clavicut:** Corte simétrico justo a la altura de las clavículas.
* **Corte Desfilado / Pluma:** Puntas perfiladas que enmarcan el rostro.
* **Buzz Cut Femenino:** Rapado total o con diseños (undercut oculto).
* **Flequillos (Estilos):** Cortina (Curtain bangs), Recto pulido, Desfilado, Baby bangs, Ladeado.

### Ojos


#### 1. Colores de Ojos

El color del iris viene determinado por la cantidad, densidad y distribución del pigmento **melanina** y la dispersión de la luz (efecto Tyndall).

* **Pigmentación Oscura / Media:**
  * **Castaño Oscuro / Negro:** Máxima concentración de melanina. El tipo de ojo más común en el mundo.
  * **Castaño Medio / Avellana (Hazel):** Pigmentación intermedia con destellos dorados, verdes o cobrizos.

* **Pigmentación Clara / Pobre en Melanina:**
  * **Verde:** Concentración moderada de melanina combinada con estroma claro. 
  * **Azul / Celeste:** Escasa melanina; la coloración se debe a la dispersión de la luz en la capa estromal.
  * **Gris / Plata:** Variante del azul con mayor densidad de colágeno en el estroma.
  * **Ámbar / Miel:** Pigmentación amarillenta o dorada producida por una alta presencia de lipocromo.

* **Condiciones Singulares:**
  * **Rojo / Violeta:** Típico del albinismo ocular severo, producido por la falta casi total de melanina que deja ver los vasos sanguíneos de la retina.

---

#### 2. Formas de los Ojos (Según el Eje Facil y el Párpado)

Esta es la categorización clave en visagismo y maquillaje para corregir profundidad y proporciones respecto al rostro.

* **Alendrados (Ovalados):**
  * **Características:** Considerados la forma "armónica" estándar. Los bordes exteriores e interiores están alineados en un eje horizontal suave.

* **Redondos:**
  * **Características:** La apertura palpebral es prominente y circular. Se suele apreciar la esclerótica (la parte blanca) por debajo o por encima del iris.

* **Rasgados / Asiáticos (Epicanthic Fold):**
  * **Características:** Presentan un pliegue cutáneo (pliegue epicántico) que cubre el lagrimal interior. Tienen una forma estrecha y horizontal.

* **Almendrados Ascendentes (Ojos de Gato):**
  * **Características:** La comisura exterior (esquina externa) se sitúa por encima del nivel del lagrimal interior.

* **Caídos / Descendentes:**
  * **Características:** La comisura exterior se sitúa por debajo del nivel del lagrimal, creando un efecto de inclinación hacia abajo.

* **Hundidos:**
  * **Características:** El hueso de la ceja (arco superciliar) sobresale, haciendo que los ojos parezcan encajados más hacia adentro de la cavidad orbitaria.

* **Prominentes / Saltones:**
  * **Características:** El globo ocular proyecta hacia afuera con respecto a la cavidad orbitaria.

* **Con Párpado Encapotado / Encendido (Hooded Eyes):**
  * **Características:** El exceso de piel del párpado fijo cae sobre el párpado móvil, ocultándolo parcial o totalmente cuando la mirada está al frente.

#### 3. Otras Características y Parámetros Anatómicos

Al analizar la mirada en un estudio de morfología, también se miden estos tres factores:

* **Distancia Interpupilar (Separación):**
  * *Normoseparados:* La distancia entre ambos ojos equivale a la longitud de un ojo.
  * *Juntos / Estrechos:* Distancia menor al tamaño de un ojo.
  * *Separados / Anchos:* Distancia mayor al tamaño de un ojo.

* **Inclinación del Eje Palpebral:** Ángulo positivo (hacia arriba), neutro o negativo (hacia abajo).

* **Profundidad de la Cavidad Orbitaria:** Determina la proyección de la sombra natural del rostro sobre la mirada.

#### 4. Heterocromía

La **heterocromía iridium** (diferencia de color entre los iris) es una anomalía pigmentaria extremadamente rara en seres humanos:

> **Respuesta:** Se estima que la heterocromía afecta a **menos del 1% de la población mundial** (aproximadamente entre el **0.2% y el 0.8%**).

* **Tipos de heterocromía:**
  1. **Completa:** Cada ojo es de un color totalmente diferente (ej. un ojo azul y uno castaño).
  2. **Parcial / Sectorial:** Un solo iris presenta dos colores claramente delimitados en distintos sectores.
  3. **Central:** El anillo interior del iris (alrededor de la pupila) tiene un color distinto al borde exterior del iris (es la más común de las tres).

#### Posibilidad de heterocromía

Sólo uno de cada 500.

Por ejemplo, si sale 1 en un rango de 1 a 500:

	- Volver a extraer un color de ojos

### Vello facial

#### 1. Tipos de vello facial según su naturaleza y textura

* **Por su Textura y Grosor:**
  * **Fino / Lanuginoso (Vello flojo):** Poco pigmentado, suave y escaso.
  * **Grueso / Cerdoso:** Vello duro, de folículo ancho y resistente al maquinado o navaja.
  * **Rizado / Encrespado:** Crece en espiral o tirabuzón. Tiende a encarnarse fácilmente (pseudofoliculitis).
  * **Liso / Rígido:** Crece recto y en dirección perpendicular a la piel (estilo "puercoespín").

* **Por la Cobertura y Densidad:**
  * **Tupida / Denso:** Cobertura uniforme en mejillas, mentón, bigote y cuello.
  * **Poblada por Zonas (Irregular):** Alta densidad en zonas específicas (ej. solo en mentón y bigote) y escasa en mejillas.
  * **Parchada / Con Claras:** Presencia de huecos naturales o falta de folículos en áreas visibles.

#### 2. Estilos de Barba (Corte y Sombra)

* **Barba Completa (Full Beard):**
  * **Corta / De 3 días (Stubble):** Longitud de 1 a 3 mm. Sombra definida y aspecto desenfadado.
  * **Media (Corporate Beard):** Longitud de 1 a 3 cm. Delimitada, pulida e ideal para un perfil profesional.
  * **Larga / Garibaldi:** Barba amplia y voluminosa, redondeada en la base (hasta 20 cm).
  * **Verdi:** Inspirada en el compositor; barba inferior redondeada con bigote independiente y peinado hacia las puntas.
  * **Leñador / Bando:** Barba larga y densa con forma cuadrada en la base.

* **Barbas Parciales y Perfiles:**
  * **Perilla / Ancla (Anchor Beard):** Vello en el mentón que sube rodeando la boca o forma una 'T' separada del bigote.
  * **Barba de Candado (Goatee):** Bigote y perilla unidos rodeando la boca por completo.
  * **Perilla Simple (Chinstrap / Barbiquejo):** Línea fina de vello que sigue toda la línea del hueso de la mandíbula de patilla a patilla.
  * **Patillas Conectadas (Friendly Mutton Chops):** Patillas anchas y voluminosas que se conectan con el bigote, dejando la barbilla rapada.
  * **Balbo:** Barba separada en tres partes: bigote, vello debajo del labio inferior y perilla ancha sin conectar al bigote.

#### 3. Estilos de bigote (Mustache)

* **Chevron:** Ancho, denso y cubre ligeramente el labio superior. Estilo clásico de los 80.
* **Manillar (Handlebar):** Extremos alargados y curvados hacia arriba usando cera de fijación.
* **Lápiz (Pencil):** Línea extremadamente fina de vello justo por encima del labio superior.
* **Inglés:** Delgado, peinado horizontalmente con los extremos rectos y extendidos hacia afuera.
* **Herradura (Horseshoe):** Bigote denso que cae verticalmente por las comisuras del labio hasta la línea de la mandíbula.
* **Walrus (Morsa):** Bigote frondoso y largo que cuelga cubriendo completamente la boca.

#### 4. Tipos de Patillas

* **Cortas / Clásicas:** Terminan a la altura de la mitad de la oreja.
* **Largas / Punteadas:** Descienden hasta el lóbulo o la mandíbula, perfiladas en punta.
* **Anchas / Mutton Chops:** Se ensanchan a medida que bajan por las mejillas.
* **Degradadas (Sideburn Fade):** La patilla se difumina progresivamente hasta desaparecer antes de conectar con la barba.

### Labios (anatomía y expresión)

#### 1. Volumen y forma general
- Full lips
- Very full lips
- Medium lips
- Thin lips
- Very thin lips
- Wide lips
- Narrow lips
- Heart-shaped lips
- Bow-shaped lips
- Straight upper lip
- Asymmetrical lips
- Rounded lips
- Angular lips

#### 2. Proporción
- Balanced upper and lower lip
- Fuller lower lip
- Fuller upper lip
- Evenly full lips
- Thin upper lip with fuller lower lip

#### 3. Expresión y tensión
- Relaxed closed lips
- Softly parted lips
- Slightly open mouth
- Tightly closed lips
- Lips gently pressed together
- One side of the mouth slightly lifted (subtle smirk)
- Lips slightly bitten
- Pursed lips
- Relaxed open mouth as if breathing
- Sensual parted lips

#### 4. Notas por género (orientativas)
(Mujer: full lips, pronounced cupid’s bow, heart/bow shape…)
(Hombre: medium-thin lips, straighter upper lip, more angular…)

### Pintura de labios (maquillaje)

#### 1. Color y tonalidad
- Natural pink lips
- Soft rose lips
- Warm nude lips
- Cool nude lips
- Peachy lips
- Coral lips
- Deep rose lips
- Berry-toned lips
- Red lips
- Burgundy lips
- Brownish nude lips
- Mauve lips
- Pale lips
- Dark lips
- Ombre / gradient lips

#### 2. Acabado / Finish
- Matte lips
- Satin lips
- Glossy lips
- Sheer lips
- Creamy lips
- Metallic or shimmer lips
- Natural no-makeup lips
- Bold pigmented lips
- Stained lips

#### 3. Definición y estilo de contorno
- Well-defined lip border
- Soft / natural lip border
- Blurred lips (difuminados)
- Overlined lips
- Visible lip liner
- No lip liner (natural edge)

#### 4. Textura
- Smooth lips
- Soft matte texture
- Dewy lips
- Velvety lips
- Plump and hydrated lips

## Maquillaje

### 1. Estilos globales de maquillaje (Look general)

- **Natural / No-makeup makeup**: fresh, clean, barely-there makeup that enhances natural features
- **Soft glam**: polished and radiant but still wearable, subtle contour and glow
- **Full glam**: highly refined, luminous skin, defined eyes and lips, red-carpet finish
- **Editorial / High fashion**: artistic, unconventional, strong shapes or unexpected colors
- **Beauty close-up**: flawless skin focus, perfect texture, often used in beauty campaigns
- **Dewy / Glass skin**: ultra-hydrated, reflective, luminous skin finish
- **Matte complexion**: velvet, shine-free skin
- **Sunglow / Bronzed**: warm, sun-kissed, healthy bronzed effect
- **Romantic / Soft**: delicate colors, soft focus, feminine atmosphere
- **Bold / Graphic**: strong colors, sharp lines, high contrast
- **Grunge / Smoky**: lived-in, slightly messy, dark and atmospheric
- **Retro / Vintage**: inspired by specific decades (50s, 60s, 70s, 90s…)
- **Minimalist**: very little product, emphasis on skin and one featured element
- **Dramatic evening**: intense eyes or lips, high contrast, sophisticated
- **Fresh commercial**: clean, bright, approachable, typical of lifestyle advertising
- **Androgynous / Genderless**: makeup that avoids classic feminine or masculine codes

### 2. Piel y complexión (Base y acabado)

- **Flawless skin**: perfect, even-toned, smooth complexion
- **Natural skin texture**: visible but refined pores and realistic skin
- **Dewy skin**: luminous, hydrated, glowing finish
- **Glass skin**: extremely reflective, almost wet-looking radiance
- **Matte skin**: soft velvet, no shine
- **Satin skin**: balanced finish between matte and dewy
- **Airbrushed skin**: ultra-smooth, poreless effect
- **Freckled skin**: natural or enhanced freckles
- **Sun-kissed skin**: light, natural tan with warmth
- **Porcelain skin**: very fair, smooth and refined
- **Olive skin with makeup**: enhanced warm undertone
- **Deep skin with radiant finish**: rich, glowing dark skin tones
- **Sheer base**: light coverage, skin still visible
- **Full coverage base**: opaque, perfected complexion
- **Contoured face**: subtle or strong sculpting of cheekbones, jaw and nose
- **Soft contour**: natural shadowing, barely noticeable
- **Strong contour**: clearly defined bone structure
- **Highlighted face**: strategic glow on high points (cheekbones, brow bone, cupid’s bow)

### 3. Cejas (Brows)

- **Natural brows**: soft, realistic brow hair
- **Feathered brows**: light, hair-like strokes, fluffy look
- **Defined brows**: clean shape with clear arches
- **Bold brows**: strong, full and prominent
- **Laminated brows**: sleek, brushed-up, modern look
- **Soft arched brows**: classic elegant curve
- **Straight brows**: flatter, contemporary shape
- **Thin brows**: delicate and refined (or retro)
- **Bushy brows**: full, natural density
- **Ombré brows**: softer front, more defined tail
- **Bleached brows**: very light or colorless brows (editorial)
- **No brows / invisible brows**: brows minimized or matching skin (high fashion)

### 4. Ojos (Eyes)

#### 1. Estilo general del ojo

- **Natural eyes**: very soft definition, almost undetectable makeup, clean and fresh
- **Soft everyday eyes**: light wash of neutral color, subtle mascara, polished but natural
- **Soft glam eyes**: refined neutral or warm tones, gentle blend, elegant and wearable
- **Full glam eyes**: highly blended, dimensional, often with shimmer or deeper outer corners
- **Classic smoky eyes**: diffused dark eyeshadow from lash line upward, sultry and intense
- **Soft smoky eyes**: lighter, more wearable version of smoky with softer edges
- **Cut crease**: sharply defined crease line that separates the lid from the brow bone
- **Soft cut crease**: diffused version of the cut crease, less graphic
- **Halo eye**: lighter or shimmery center of the lid with deeper tones on inner and outer corners
- **Reverse halo / gradient eye**: darker center with lighter outer edges
- **Monochromatic eyes**: single color family used across the entire eye area
- **Colorful eyeshadow**: visible use of bright, pastel or unexpected colors
- **Metallic eyes**: highly reflective metallic finish on the lid (gold, silver, bronze, copper…)
- **Foil eyes**: intense, almost wet metallic payoff
- **Matte eyes**: completely flat, non-reflective eyeshadow
- **Satin eyes**: soft low-level sheen
- **Shimmer eyes**: fine reflective particles, luminous but not glittery
- **Glitter eyes**: visible glitter particles (used with intention)
- **Graphic eyes**: bold geometric or artistic shapes with liner or shadow
- **Floating crease**: eyeshadow or liner placed above the natural crease
- **Doe eye**: rounded, open, innocent eye shape created with makeup
- **Elongated / cat eye shape**: makeup that stretches the eye outward
- **Fox eye**: lifted outer corner, elongated and slightly upward
- **Hooded eye makeup**: technique adapted to hooded lids (more visible when eyes are open)
- **Deep-set eye makeup**: techniques that bring the eyes forward
- **Close-set eye makeup**: emphasis on outer corners to create width
- **Wide-set eye makeup**: emphasis on inner corners to bring eyes closer
- **Editorial eye**: artistic, unconventional, runway-inspired eye makeup
- **Grunge eyes**: messy, smudged, lived-in dark eye makeup
- **Retro eyes**: inspired by specific eras (60s graphic liner, 70s soft, 80s bold…)
- **Clean girl eyes**: minimal product, glossy lid or simple mascara, very fresh
- **No-makeup eye**: extremely subtle enhancement, almost invisible

#### 2. Sombra de ojos – Colocación y técnica

- **All-over lid color**: single shade applied across the entire mobile lid
- **Transition shade in the crease**: soft blended color in the crease for depth
- **Deep outer corner**: darker shade concentrated on the outer third of the eye
- **Inner corner highlight**: brightening shade in the inner corner
- **Brow bone highlight**: light shade under the eyebrow arch
- **Lower lash line shadow**: eyeshadow smoked along the lower lash line
- **Tightline only**: color applied between the lashes, no visible liner
- **Smudged shadow liner**: eyeshadow used as a soft eyeliner
- **Diffused edges**: very blended, no hard lines
- **Sharp edges**: clean, precise lines (especially in cut crease or graphic looks)
- **Ombré lid**: gradual color transition across the lid
- **Two-tone eyes**: clear separation of two distinct colors
- **Color blocked eyes**: strong, unblended blocks of color (editorial)

#### 3. Delineador (Eyeliner)

- **No eyeliner**: clean lash line without liner
- **Tightlined**: liner applied only between the upper lashes
- **Thin eyeliner**: delicate line close to the lashes
- **Medium eyeliner**: classic visible line
- **Thick eyeliner**: bold, heavy line
- **Winged liner / cat eye**: classic flicked wing at the outer corner
- **Long dramatic wing**: extended, sharp wing
- **Soft wing**: slightly diffused or less precise wing
- **Floating liner**: liner placed above the lash line, not touching the roots
- **Double wing**: two parallel wings or creative double flick
- **Graphic liner**: geometric, abstract or artistic liner shapes
- **Smudged liner**: soft, smoked-out eyeliner
- **Lower lash line liner**: liner applied under the eye
- **Waterline liner**: color on the wet waterline (upper or lower)
- **White or light waterline**: brightening the waterline to make eyes appear larger
- **Colored eyeliner**: non-black liner (brown, navy, burgundy, green, etc.)
- **Metallic eyeliner**: reflective liner
- **Invisible liner / nude liner**: flesh-toned liner on the waterline

#### 4. Pestañas (Lashes)

- **Natural lashes**: clean, lightly defined lashes
- **Defined lashes**: separated and lengthened with mascara
- **Lengthened lashes**: emphasis on length
- **Voluminous lashes**: thick, dense, full lashes
- **Lifted lashes**: strong upward curl
- **Bottom lashes emphasized**: lower lashes clearly mascaraed or defined
- **Spider lashes**: slightly clumpy, textured mascara effect
- **Wet-look lashes**: lashes that appear slightly wet or glossy
- **Individual false lashes**: subtle added clusters
- **Full strip false lashes**: visible dramatic lash strip
- **Dramatic false lashes**: long, dense, stylized lashes
- **Natural-looking false lashes**: undetectable added lashes
- **No mascara**: bare lashes
- **Lower lash only**: mascara or definition only on the bottom lashes
- **Clumpy editorial lashes**: intentionally heavy and textured

#### 5. Acabados y efectos especiales en el ojo

- **Glossy lid**: shiny, reflective product on the mobile lid
- **Wet look eyes**: strong reflective, almost liquid finish
- **Powdered matte lid**: completely flat finish
- **Metallic foil finish**: intense mirror-like reflection
- **Duochrome / multichrome eyes**: color-shifting eyeshadow
- **Matte + shimmer combination**: matte crease with shimmer lid
- **Soft focus eye**: hazy, diffused, romantic eye makeup
- **High contrast eye**: strong difference between lid and crease
- **Low contrast eye**: very soft, close tonal values
- **Smudged and lived-in**: intentionally imperfect, slightly messy finish
- **Crisp and precise**: sharp lines and clean blending
- **Negative space eye**: areas of bare skin intentionally left clean

#### 6. Combinaciones frecuentes en publicidad y moda

- **Brown soft smoky with satin lid**
- **Neutral cut crease with inner corner highlight**
- **Black classic winged liner with voluminous lashes**
- **Bronze metallic lid with diffused brown crease**
- **Soft pink wash with glossy lid (clean girl)**
- **Deep burgundy smoky with matte finish**
- **Graphic black liner with bare lid**
- **Golden halo eye with defined lower lash line**
- **Monochromatic terracotta eye**
- **Cool-toned grey smoky with sharp wing**
- **Peachy shimmer lid with soft brown transition**
- **Editorial floating crease in unexpected color**
- **Minimal tightline + long natural lashes**
- **Full glam cut crease with false lashes and highlight**

### 5. Pómulos y mejillas (Blush, bronzer, highlighter)

- **Soft blush**: light wash of color on the cheeks
- **Pigmented blush**: clearly visible cheek color
- **Draped blush**: blush applied high and toward the temples
- **Sunburnt blush**: strong, flushed, almost feverish cheek color
- **Cream blush**: skin-like, blended flush
- **Powder blush**: classic soft finish
- **Bronzed cheeks**: warm contour and warmth on the perimeter
- **Peachy blush**
- **Pink blush**
- **Coral blush**
- **Berry blush**
- **Neutral blush**
- **Highlighter on cheekbones**: precise glow on the upper cheekbones
- **Inner corner highlight**: brightening at the inner eye corner
- **No blush**: clean cheeks without added color

### 6. Labios (resumen)

- Natural lips
- Nude lips
- Pink lips
- Red lips
- Berry lips
- Dark lips
- Ombré lips
- Matte lips
- Glossy lips
- Overlined lips
- Blurred lips
- Stained lips

### 7. Acabados y técnicas especiales

- **Wet look / glossy lids**
- **Powdered finish**
- **Cream-to-powder finish**
- **Baking / intense under-eye setting**
- **Strobing**: emphasis on highlight rather than contour
- **Stripping**: very minimal product, almost bare
- **Color blocking**: strong areas of pure color
- **Negative space makeup**: intentional bare skin areas
- **Graphic shapes**: geometric applications of color or liner

### Maquillaje

#### 1. Estilos globales de maquillaje (Look general)

- **Natural / No-makeup makeup**: fresh, clean, barely-there makeup that enhances natural features
- **Soft glam**: polished and radiant but still wearable, subtle contour and glow
- **Full glam**: highly refined, luminous skin, defined eyes and lips, red-carpet finish
- **Editorial / High fashion**: artistic, unconventional, strong shapes or unexpected colors
- **Beauty close-up**: flawless skin focus, perfect texture, often used in beauty campaigns
- **Dewy / Glass skin**: ultra-hydrated, reflective, luminous skin finish
- **Matte complexion**: velvet, shine-free skin
- **Sunglow / Bronzed**: warm, sun-kissed, healthy bronzed effect
- **Romantic / Soft**: delicate colors, soft focus, feminine atmosphere
- **Bold / Graphic**: strong colors, sharp lines, high contrast
- **Grunge / Smoky**: lived-in, slightly messy, dark and atmospheric
- **Retro / Vintage**: inspired by specific decades (50s, 60s, 70s, 90s…)
- **Minimalist**: very little product, emphasis on skin and one featured element
- **Dramatic evening**: intense eyes or lips, high contrast, sophisticated
- **Fresh commercial**: clean, bright, approachable, typical of lifestyle advertising
- **Androgynous / Genderless**: makeup that avoids classic feminine or masculine codes

#### 2. Piel y complexión (Base y acabado)

- **Flawless skin**: perfect, even-toned, smooth complexion
- **Natural skin texture**: visible but refined pores and realistic skin
- **Dewy skin**: luminous, hydrated, glowing finish
- **Glass skin**: extremely reflective, almost wet-looking radiance
- **Matte skin**: soft velvet, no shine
- **Satin skin**: balanced finish between matte and dewy
- **Airbrushed skin**: ultra-smooth, poreless effect
- **Freckled skin**: natural or enhanced freckles
- **Sun-kissed skin**: light, natural tan with warmth
- **Porcelain skin**: very fair, smooth and refined
- **Olive skin with makeup**: enhanced warm undertone
- **Deep skin with radiant finish**: rich, glowing dark skin tones
- **Sheer base**: light coverage, skin still visible
- **Full coverage base**: opaque, perfected complexion
- **Contoured face**: subtle or strong sculpting of cheekbones, jaw and nose
- **Soft contour**: natural shadowing, barely noticeable
- **Strong contour**: clearly defined bone structure
- **Highlighted face**: strategic glow on high points (cheekbones, brow bone, cupid’s bow)

#### 3. Cejas (Brows)

- **Natural brows**: soft, realistic brow hair
- **Feathered brows**: light, hair-like strokes, fluffy look
- **Defined brows**: clean shape with clear arches
- **Bold brows**: strong, full and prominent
- **Laminated brows**: sleek, brushed-up, modern look
- **Soft arched brows**: classic elegant curve
- **Straight brows**: flatter, contemporary shape
- **Thin brows**: delicate and refined (or retro)
- **Bushy brows**: full, natural density
- **Ombré brows**: softer front, more defined tail
- **Bleached brows**: very light or colorless brows (editorial)
- **No brows / invisible brows**: brows minimized or matching skin (high fashion)

#### 4. Ojos (Eyes)

##### 1. Estilo general del ojo

- **Natural eyes**: very soft definition, almost undetectable makeup, clean and fresh
- **Soft everyday eyes**: light wash of neutral color, subtle mascara, polished but natural
- **Soft glam eyes**: refined neutral or warm tones, gentle blend, elegant and wearable
- **Full glam eyes**: highly blended, dimensional, often with shimmer or deeper outer corners
- **Classic smoky eyes**: diffused dark eyeshadow from lash line upward, sultry and intense
- **Soft smoky eyes**: lighter, more wearable version of smoky with softer edges
- **Cut crease**: sharply defined crease line that separates the lid from the brow bone
- **Soft cut crease**: diffused version of the cut crease, less graphic
- **Halo eye**: lighter or shimmery center of the lid with deeper tones on inner and outer corners
- **Reverse halo / gradient eye**: darker center with lighter outer edges
- **Monochromatic eyes**: single color family used across the entire eye area
- **Colorful eyeshadow**: visible use of bright, pastel or unexpected colors
- **Metallic eyes**: highly reflective metallic finish on the lid (gold, silver, bronze, copper…)
- **Foil eyes**: intense, almost wet metallic payoff
- **Matte eyes**: completely flat, non-reflective eyeshadow
- **Satin eyes**: soft low-level sheen
- **Shimmer eyes**: fine reflective particles, luminous but not glittery
- **Glitter eyes**: visible glitter particles (used with intention)
- **Graphic eyes**: bold geometric or artistic shapes with liner or shadow
- **Floating crease**: eyeshadow or liner placed above the natural crease
- **Doe eye**: rounded, open, innocent eye shape created with makeup
- **Elongated / cat eye shape**: makeup that stretches the eye outward
- **Fox eye**: lifted outer corner, elongated and slightly upward
- **Hooded eye makeup**: technique adapted to hooded lids (more visible when eyes are open)
- **Deep-set eye makeup**: techniques that bring the eyes forward
- **Close-set eye makeup**: emphasis on outer corners to create width
- **Wide-set eye makeup**: emphasis on inner corners to bring eyes closer
- **Editorial eye**: artistic, unconventional, runway-inspired eye makeup
- **Grunge eyes**: messy, smudged, lived-in dark eye makeup
- **Retro eyes**: inspired by specific eras (60s graphic liner, 70s soft, 80s bold…)
- **Clean girl eyes**: minimal product, glossy lid or simple mascara, very fresh
- **No-makeup eye**: extremely subtle enhancement, almost invisible

##### 2. Sombra de ojos – Colocación y técnica

- **All-over lid color**: single shade applied across the entire mobile lid
- **Transition shade in the crease**: soft blended color in the crease for depth
- **Deep outer corner**: darker shade concentrated on the outer third of the eye
- **Inner corner highlight**: brightening shade in the inner corner
- **Brow bone highlight**: light shade under the eyebrow arch
- **Lower lash line shadow**: eyeshadow smoked along the lower lash line
- **Tightline only**: color applied between the lashes, no visible liner
- **Smudged shadow liner**: eyeshadow used as a soft eyeliner
- **Diffused edges**: very blended, no hard lines
- **Sharp edges**: clean, precise lines (especially in cut crease or graphic looks)
- **Ombré lid**: gradual color transition across the lid
- **Two-tone eyes**: clear separation of two distinct colors
- **Color blocked eyes**: strong, unblended blocks of color (editorial)

##### 3. Delineador (Eyeliner)

- **No eyeliner**: clean lash line without liner
- **Tightlined**: liner applied only between the upper lashes
- **Thin eyeliner**: delicate line close to the lashes
- **Medium eyeliner**: classic visible line
- **Thick eyeliner**: bold, heavy line
- **Winged liner / cat eye**: classic flicked wing at the outer corner
- **Long dramatic wing**: extended, sharp wing
- **Soft wing**: slightly diffused or less precise wing
- **Floating liner**: liner placed above the lash line, not touching the roots
- **Double wing**: two parallel wings or creative double flick
- **Graphic liner**: geometric, abstract or artistic liner shapes
- **Smudged liner**: soft, smoked-out eyeliner
- **Lower lash line liner**: liner applied under the eye
- **Waterline liner**: color on the wet waterline (upper or lower)
- **White or light waterline**: brightening the waterline to make eyes appear larger
- **Colored eyeliner**: non-black liner (brown, navy, burgundy, green, etc.)
- **Metallic eyeliner**: reflective liner
- **Invisible liner / nude liner**: flesh-toned liner on the waterline

##### 4. Pestañas (Lashes)

- **Natural lashes**: clean, lightly defined lashes
- **Defined lashes**: separated and lengthened with mascara
- **Lengthened lashes**: emphasis on length
- **Voluminous lashes**: thick, dense, full lashes
- **Lifted lashes**: strong upward curl
- **Bottom lashes emphasized**: lower lashes clearly mascaraed or defined
- **Spider lashes**: slightly clumpy, textured mascara effect
- **Wet-look lashes**: lashes that appear slightly wet or glossy
- **Individual false lashes**: subtle added clusters
- **Full strip false lashes**: visible dramatic lash strip
- **Dramatic false lashes**: long, dense, stylized lashes
- **Natural-looking false lashes**: undetectable added lashes
- **No mascara**: bare lashes
- **Lower lash only**: mascara or definition only on the bottom lashes
- **Clumpy editorial lashes**: intentionally heavy and textured

##### 5. Acabados y efectos especiales en el ojo

- **Glossy lid**: shiny, reflective product on the mobile lid
- **Wet look eyes**: strong reflective, almost liquid finish
- **Powdered matte lid**: completely flat finish
- **Metallic foil finish**: intense mirror-like reflection
- **Duochrome / multichrome eyes**: color-shifting eyeshadow
- **Matte + shimmer combination**: matte crease with shimmer lid
- **Soft focus eye**: hazy, diffused, romantic eye makeup
- **High contrast eye**: strong difference between lid and crease
- **Low contrast eye**: very soft, close tonal values
- **Smudged and lived-in**: intentionally imperfect, slightly messy finish
- **Crisp and precise**: sharp lines and clean blending
- **Negative space eye**: areas of bare skin intentionally left clean

##### 6. Combinaciones frecuentes en publicidad y moda

- **Brown soft smoky with satin lid**
- **Neutral cut crease with inner corner highlight**
- **Black classic winged liner with voluminous lashes**
- **Bronze metallic lid with diffused brown crease**
- **Soft pink wash with glossy lid (clean girl)**
- **Deep burgundy smoky with matte finish**
- **Graphic black liner with bare lid**
- **Golden halo eye with defined lower lash line**
- **Monochromatic terracotta eye**
- **Cool-toned grey smoky with sharp wing**
- **Peachy shimmer lid with soft brown transition**
- **Editorial floating crease in unexpected color**
- **Minimal tightline + long natural lashes**
- **Full glam cut crease with false lashes and highlight**

#### 5. Pómulos y mejillas (Blush, bronzer, highlighter)

- **Soft blush**: light wash of color on the cheeks
- **Pigmented blush**: clearly visible cheek color
- **Draped blush**: blush applied high and toward the temples
- **Sunburnt blush**: strong, flushed, almost feverish cheek color
- **Cream blush**: skin-like, blended flush
- **Powder blush**: classic soft finish
- **Bronzed cheeks**: warm contour and warmth on the perimeter
- **Peachy blush**
- **Pink blush**
- **Coral blush**
- **Berry blush**
- **Neutral blush**
- **Highlighter on cheekbones**: precise glow on the upper cheekbones
- **Inner corner highlight**: brightening at the inner eye corner
- **No blush**: clean cheeks without added color

#### 6. Labios (resumen)

- Natural lips
- Nude lips
- Pink lips
- Red lips
- Berry lips
- Dark lips
- Ombré lips
- Matte lips
- Glossy lips
- Overlined lips
- Blurred lips
- Stained lips

#### 7. Acabados y técnicas especiales

- **Wet look / glossy lids**
- **Powdered finish**
- **Cream-to-powder finish**
- **Baking / intense under-eye setting**
- **Strobing**: emphasis on highlight rather than contour
- **Stripping**: very minimal product, almost bare
- **Color blocking**: strong areas of pure color
- **Negative space makeup**: intentional bare skin areas
- **Graphic shapes**: geometric applications of color or liner

### Uñas

#### 1. Longitud (Length)

- **Very short nails**: extremely short, barely past the fingertip
- **Short nails**: short and practical, just past the fingertip
- **Medium nails**: classic moderate length
- **Long nails**: clearly extended length
- **Very long nails**: dramatically long, high-fashion length
- **Extra-long nails**: extreme length, often editorial or stylized
- **Natural length**: realistic, everyday nail length
- **Stiletto length**: long and sharply tapered
- **Ballerina / coffin length**: long with a squared-off tapered tip

#### 2. Forma / Corte (Shape)

- **Round nails**: softly rounded tip, natural and classic
- **Oval nails**: elongated oval shape, elegant and flattering
- **Squoval nails**: mix between square and oval, soft square edges
- **Square nails**: straight free edge with sharp or slightly softened corners
- **Soft square nails**: square shape with gently rounded corners
- **Almond nails**: tapered sides with a rounded tip, elegant and elongating
- **Stiletto nails**: sharply pointed, dramatic tapered shape
- **Coffin / Ballerina nails**: tapered sides with a flat, squared tip
- **Lipstick nails**: angled tip that resembles a lipstick bullet
- **Mountain peak nails**: exaggerated sharp point (editorial)
- **Edge nails**: modern geometric, often with a sharp angle
- **Natural irregular shape**: slightly imperfect, realistic nail shape

#### 3. Estado y acabado de la uña (Base condition)

- **Natural nails**: clean, healthy natural nails without extensions
- **Manicured nails**: perfectly filed and cared-for nails
- **Gel nails**: smooth, glossy gel coating
- **Acrylic nails**: structured acrylic extensions
- **Builder gel nails**: natural-looking strength and length
- **Polygel nails**: hybrid acrylic-gel appearance
- **Matte natural nails**: unpolished, soft matte keratin surface
- **Glossy natural nails**: healthy, slightly shiny natural nails
- **Slightly imperfect nails**: realistic texture, minor ridges or asymmetry
- **Perfectly smooth nails**: flawless, even surface

#### 4. Color de esmalte (Nail color)

- **Nude nails**: natural beige, pink or beige-pink tones
- **Soft pink nails**
- **Milky white nails** / **milky nails**
- **Classic red nails**
- **Deep red / burgundy nails**
- **Berry nails**
- **Coral nails**
- **Peachy nails**
- **Orange nails**
- **Yellow nails**
- **Green nails** (olive, emerald, lime…)
- **Blue nails** (navy, sky, electric…)
- **Purple / violet nails**
- **Lavender nails**
- **Brown / chocolate nails**
- **Black nails**
- **White nails**
- **Grey nails**
- **Metallic gold nails**
- **Metallic silver nails**
- **Chrome nails**
- **Holographic nails**
- **Pastel nails**
- **Neon nails**
- **Sheer nails**: translucent wash of color
- **Opaque nails**: full coverage solid color
- **Neutral nails**: muted, sophisticated tones
- **Bold colored nails**: strong, saturated color

#### 5. Acabado del esmalte (Finish)

- **Glossy nails**: classic high-shine finish
- **Matte nails**: flat, velvet, non-reflective finish
- **Satin nails**: soft low sheen
- **Shimmer nails**: fine light-reflecting particles
- **Glitter nails**: visible glitter particles
- **Metallic nails**: reflective metal-like finish
- **Chrome nails**: mirror-like chrome powder effect
- **Holographic nails**: rainbow-shifting holographic effect
- **Pearlescent nails**: soft pearl-like glow
- **Jelly nails**: translucent, jelly-like color
- **Cream nails**: opaque creamy finish
- **Frosted nails**: slightly opaque, icy finish
- **Magnetic nails**: cat-eye or magnetic effect with moving line
- **Thermal nails**: color-changing with temperature (described as dual-tone)

#### 6. Estilos y nail art (Design)

- **Solid color nails**: single uniform color
- **French manicure**: classic white tips with natural or pink base
- **Modern French**: colored tips or reverse French
- **Reverse French**: color on the cuticle area instead of the tip
- **Half-moon nails**: contrasting color in the half-moon area
- **Ombré nails**: gradual color transition from base to tip
- **Baby boomer nails**: soft nude-to-white ombré
- **Gradient nails**: blended color transition
- **Negative space nails**: areas of bare nail intentionally left visible
- **Geometric nail art**: clean lines, shapes, blocks of color
- **Minimalist nail art**: tiny details, thin lines, small dots or symbols
- **Floral nail art**: painted flowers or botanical motifs
- **Abstract nail art**: free-form artistic designs
- **Animal print nails**: leopard, zebra, snake motifs
- **Marble nails**: realistic or stylized marble effect
- **Swirl nails**: fluid swirling patterns
- **Chrome French**: French tips with chrome finish
- **Cat-eye nails**: magnetic line effect
- **Aura nails**: soft airbrushed glowing color in the center
- **Velvet nails**: velvety textured appearance
- **3D nail art**: raised elements, charms, pearls or sculpture
- **Rhinestone / crystal nails**: decorated with stones
- **Pearl nails**: small pearls or pearl-like details
- **Hand-painted nails**: detailed artistic painting
- **Two-tone nails**: different colors on different nails or split designs
- **Accent nail**: one or two nails with different design
- **Matched set**: all nails with the same design
- **Asymmetrical nail art**: different designs on each hand or nail

#### 7. Estilos completos frecuentes en moda y publicidad

- **Clean nude short oval nails**
- **Classic red almond nails with glossy finish**
- **Long coffin milky white nails**
- **Short square neutral matte nails**
- **Long stiletto black glossy nails**
- **Medium almond soft pink French manicure**
- **Long ballerina chrome nails**
- **Short round natural nude nails**
- **Editorial extra-long geometric nail art**
- **Soft ombré baby boomer long nails**
- **Dark burgundy matte long coffin nails**
- **Minimalist negative space medium nails**
- **Glossy classic red square nails**
- **Sheer milky short oval nails**
- **Bold colored long stiletto nails with rhinestones**

### Tatuajes


#### 1. Zonas del Cuerpo Más Demandadas (Placement)

Las zonas se categorizan según su visibilidad, tolerancia al dolor y la anatomía para adaptar el diseño.

* **Extremidades Superiores (Las más populares):**
  * **Antebrazo (Cara interna y externa):** Excelente visibilidad, curación rápida y dolor bajo-medio.
  * **Brazo Completo / Manga (Sleeve):** Conjunto fluido que cubre desde el hombro hasta la muñeca.
  * **Bíceps y Deltoides (Hombro):** Zona clásica, buena superficie plana para diseños de tamaño medio.
  * **Muñeca y Manos / Dedos:** Muy demandadas para diseños pequeños (*fine line*), aunque sufren mayor desgaste por el lavado continuo.

* **Tronco y Torso:**
  * **Pecho / Esternón:** Muy popular tanto en hombres (pecho completo) como en mujeres (diseños *underboob* en el esternón).
  * **Costillas / Costado:** Gran atractivo visual, pero de las zonas más dolorosas por la proximidad ósea.
  * **Espalda (Alta, Baja o Completa):** El "lienzo rey" para piezas de gran formato y composiciones complejas.
  * **Clavícula:** Ideal para frases, letras o motivos botánicos finos.

* **Extremidades Inferiores:**
  * **Muslo (Cara anterior y lateral):** Zona amplia, de dolor bajo, ideal para composiciones detalladas.
  * **Gemelo / Pantorrilla:** Clásica para piezas individuales o medias mangas de pierna.
  * **Tobillo y Pie:** Diseños delicados y pequeños, zona sensible al dolor.

#### 2. Motivos y Dibujos Más Habituales (Elementos Temáticos)

* **Botánica y Naturaleza:** Flores (rosas, peonías, flores de loto), ramas, hojas, paisajes y árboles.
* **Fauna y Animales:**
  * *Depredadores / Fuerza:* Leones, tigres, lobos, panteras, serpientes, águilas.
  * *Míticos / Simbólicos:* Dragones, aves fénix, mariposas, carpas koi.
* **Geometría y Simbología:** Mandalas, patrones sagrados, brújulas, relojes (de arena o de bolsillo), mapas.
* **Espiritualidad y Mitología:** Calaveras (memento mori), deidades griegas/romanas, iconografía egipcia, símbolos nórdicos o celtas.
* **Afectivos y Personalizados:** Retratos de seres queridos o mascotas, fechas en números romanos, firmas, frases o coordenadas.

#### 3. Estilos de Tatuaje Principales

* **Tradicional / Old School:**
  * **Características:** Líneas negras gruesas y sólidas, paleta reducida de colores primarios (rojo, amarillo, verde, azul) y sombras sencillas.
  * *Ejemplos:* Anclas, golondrinas, dagas, corazones con pancartas.

* **Neotradicional (Neo-Trad):**
  * **Características:** Evolución del Old School. Conserva las líneas marcadas pero añade grosores variables, degradados complejos y una paleta de color más amplia (tonos pastel, ocres, púrpuras).

* **Realismo / Black and Grey (Grisalla):**
  * **Características:** Imita fotografías o la realidad sin usar líneas de contorno visibles. Se basa en el contraste de sombras y luces con tintas negras y diluciones (sumi).

* **Línea Fina / Fine Line & Microrealismo:**
  * **Características:** Agujas de calibre muy fino ( RL1 o RL3) para crear trazados delicados, pequeños detalles, letras elegantes y piezas minimalistas.

* **Irezumi / Tradicional Japonés:**
  * **Características:** Arquetipo milenario que respeta la anatomía del cuerpo. Fondos de olas, nubes o viento integrados con figuras mitológicas y fauna.

* **Blackwork:**
  * **Características:** Uso exclusivo de tinta negra en bloque, creando grandes zonas de relleno sólido, alto contraste y siluetas dramáticas.

* **Tribal / Polinesio / Maorí:**
  * **Características:** Patrones abstractos y simétricos compuestos por líneas gruesas y bloques negros. Tradicionalmente cuentan la historia y estatus de la persona.

* **Acuarela / Watercolor:**
  * **Características:** Imita pinceladas de pintura sobre lienzo, con manchas de color salpicadas, bordes difuminados y ausencia de líneas de contorno duras.

* **Puntillismo / Dotwork:**
  * **Características:** El diseño se construye mediante la acumulación de puntos individuales para generar volumen, gradación y textura.

* **Geométrico y Mandala:**
  * **Características:** Basado en líneas precisas, simetría perfecta, formas matemáticas y patrones que se repiten en armonía con el cuerpo.

* **Trash Polka:**
  * **Características:** Estilo de origen alemán que combina realismo, tipografía y manchas abstractas. Usa exclusivamente tinta negra y roja en alto contraste.

* **Lettering / Caligrafía:**
  * **Características:** Diseños centrados únicamente en la tipografía (chicana, gótica, cursiva fina, grafiti).










### Expresiones y miradas

#### 1. Expresiones faciales principales

- **Neutral expression**: calm, relaxed face with no strong emotion, clean and versatile
- **Soft smile**: gentle, closed-mouth smile, warm and approachable
- **Wide smile**: broad open smile showing teeth, joyful and energetic
- **Subtle half-smile**: slight lift of one or both corners of the mouth, mysterious or knowing
- **Confident smile**: controlled, self-assured smile with steady eyes
- **Seductive smile**: soft, inviting smile with slightly narrowed eyes
- **Laughing**: genuine open-mouthed laugh, eyes slightly closed or crinkled
- **Serious expression**: composed, focused face with closed mouth and steady gaze
- **Intense expression**: strong, concentrated face with sharpened features
- **Thoughtful expression**: slightly furrowed brow, distant or introspective look
- **Dreamy expression**: soft eyes, slightly parted lips, lost-in-thought atmosphere
- **Mysterious expression**: closed mouth, subtle tension in the eyes, enigmatic feeling
- **Playful expression**: light, mischievous face, often with a slight smirk
- **Seducing / alluring expression**: lowered chin, soft eyes, parted lips
- **Powerful expression**: strong jaw, direct eyes, commanding presence
- **Vulnerable expression**: soft eyes, slightly open mouth, emotional openness
- **Cold expression**: detached, emotionless face with distant eyes
- **Angry expression**: furrowed brows, tight mouth, intense eyes
- **Surprised expression**: raised eyebrows, widened eyes, slightly open mouth
- **Sad expression**: downturned mouth, soft or watery eyes, melancholic feeling
- **Confident blank stare**: neutral mouth with strong, self-assured eyes
- **Flirty expression**: slight head tilt, soft smile, playful eyes
- **Reserved expression**: closed-off face, minimal emotion, elegant restraint
- **Radiant expression**: bright eyes and lifted face, glowing and positive energy

#### 2. Miradas y dirección de los ojos (Gaze)

- **Looking directly at the camera**: strong eye contact, engaging and powerful
- **Looking slightly off-camera**: gaze directed just beside the lens, natural and cinematic
- **Looking over the shoulder**: head turned, eyes connecting with the camera from behind
- **Looking upward**: eyes directed up, hopeful, spiritual or dramatic feeling
- **Looking downward**: gaze lowered, introspective, shy or elegant
- **Looking to the side**: profile or three-quarter gaze, distant or contemplative
- **Looking into the distance**: eyes focused far away, thoughtful or epic mood
- **Eyes closed**: peaceful, sensual, or introspective closed eyes
- **Side-eye glance**: eyes shifted to the side while the face remains forward, playful or suspicious
- **Upward glance through lashes**: eyes looking up while the head is slightly down, classic seductive look
- **Downward glance through lashes**: soft, demure or mysterious lowered gaze
- **Intense direct stare**: very strong, almost confrontational eye contact
- **Soft unfocused gaze**: eyes slightly unfocused, dreamy and ethereal
- **Sharp focused gaze**: highly attentive and precise eyes
- **Looking through the frame**: eyes appearing to look past the viewer into another space

#### 3. Intensidad y calidad de la mirada

- **Piercing gaze**: extremely sharp and penetrating eyes
- **Warm gaze**: soft, kind and inviting eyes
- **Cold gaze**: detached, cool and distant eyes
- **Smoldering gaze**: intense, sensual and charged eyes
- **Innocent gaze**: wide, open and pure-looking eyes
- **Knowing gaze**: subtle intelligence and awareness in the eyes
- **Vulnerable gaze**: open, emotional and unguarded eyes
- **Dominant gaze**: strong, controlling and confident eyes
- **Melancholic gaze**: soft sadness or nostalgia in the eyes
- **Playful gaze**: light, teasing and lively eyes
- **Empty gaze**: vacant or emotionally distant eyes
- **Magnetic gaze**: highly attractive and hard-to-look-away eyes

#### 4. Combinaciones expresión + mirada (muy útiles en prompts)

- **Confident direct gaze with subtle smile**
- **Seductive look with slightly parted lips and lowered chin**
- **Serious intense stare with neutral mouth**
- **Soft smile with warm eye contact**
- **Mysterious expression looking over the shoulder**
- **Dreamy expression with upward gaze**
- **Powerful expression with piercing direct eye contact**
- **Playful smirk with side-eye glance**
- **Vulnerable expression with soft downward gaze**
- **Cold beauty stare with perfect neutral face**
- **Joyful laughing expression with crinkled eyes**
- **Thoughtful expression looking into the distance**
- **Flirty expression with head tilt and soft eye contact**
- **Editorial blank stare with strong bone structure emphasis**
- **Sensual closed eyes with slightly open mouth**
- **Rebellious expression with sharp side glance**
- **Elegant reserved expression with soft off-camera gaze**
- **High-fashion disdainful look with raised chin**
- **Approachable commercial smile with direct friendly eyes**
- **Cinematic intense gaze with subtle tension in the brows**

#### 5. Detalles específicos de ojos y cejas (para mayor control)

- **Slightly raised eyebrows**
- **Relaxed eyebrows**
- **Furrowed brows**
- **One eyebrow slightly raised**
- **Soft half-lidded eyes**
- **Wide open eyes**
- **Narrowed eyes**
- **Eyes crinkled from smiling**
- **Heavy-lidded sensual eyes**
- **Bright and alert eyes**
- **Soft and dewy eyes**
- **Sharp and defined eyes**

#### 6. Detalles de boca y labios

- **Closed relaxed mouth**
- **Slightly parted lips**
- **Softly smiling closed lips**
- **Full smile showing teeth**
- **Tense closed mouth**
- **Lips gently biting the lower lip**
- **Mouth slightly open as if about to speak**
- **Perfectly neutral mouth**
- **Seductive open mouth**
- **Tight-lipped expression**

## Pose


### 1. Pose corporal general (Body Pose)

- **Standing straight**: standing upright, straight posture, feet together or slightly apart, balanced and confident
- **Contrapposto**: standing with weight shifted onto one leg, the other leg relaxed, hip slightly pushed out, natural S-curve in the body
- **Weight on one leg**: standing with most of the weight on one leg, the free leg bent or slightly forward
- **Walking pose**: mid-stride walking pose, one foot forward, natural arm swing, dynamic but controlled
- **Striding confidently**: long confident stride, strong posture, fashion runway energy
- **Leaning against a wall**: leaning casually against a wall with one shoulder or back, relaxed attitude
- **Leaning forward**: upper body leaning slightly forward, engaged and intentional
- **Leaning backward**: torso leaning slightly back, open and relaxed posture
- **Sitting on a chair**: sitting upright on a chair, legs together or elegantly crossed
- **Sitting casually**: sitting in a relaxed way, one leg bent, informal posture
- **Sitting on the floor**: sitting on the floor with legs crossed, extended, or one knee up
- **Kneeling**: kneeling on one or both knees, upright torso
- **Crouching**: low crouching pose, weight on the balls of the feet, compact and dynamic
- **Squatting**: deep squat, fashion editorial style, strong and grounded
- **Lying down**: lying on the back, side, or stomach, relaxed or sensual
- **Reclining**: reclining on a surface, supported by one arm, elegant and elongated
- **Sitting on the edge**: sitting on the edge of a surface (bed, table, ledge), legs dangling or one leg bent
- **Jumping**: captured mid-jump, energetic and dynamic
- **Twisting torso**: standing or sitting with the torso twisted relative to the hips, creating tension and shape
- **Hands on hips**: classic power pose, hands resting on the hips, elbows out
- **Arms crossed**: arms crossed over the chest, confident or defensive attitude
- **One hand in pocket**: one hand casually placed in a pocket, relaxed and cool
- **Looking back over the shoulder**: body facing away or three-quarter, head turned back looking over the shoulder

### 2. Orientación de la cabeza (Head Position)

- **Facing camera**: head facing directly toward the camera, eye contact
- **Three-quarter view**: head turned slightly to one side, classic flattering angle
- **Profile**: full side profile, elegant and graphic
- **Looking over the shoulder**: head turned back over one shoulder, mysterious or seductive
- **Chin slightly down**: chin tilted slightly downward, eyes looking up (flattering and intense)
- **Chin slightly up**: chin lifted, confident and proud expression
- **Head tilted to the side**: head softly tilted to one side, playful or gentle
- **Looking down**: gaze directed downward, introspective or demure
- **Looking up**: gaze directed upward, hopeful or dramatic
- **Looking away**: looking off-camera to the side, candid feeling

### 3. Torso y hombros (Torso & Shoulders)

- **Square to camera**: shoulders and torso facing the camera directly
- **Three-quarter torso**: torso turned to a three-quarter angle
- **Side torso**: torso in profile
- **Twisted torso**: shoulders turned in a different direction from the hips
- **Shoulders relaxed**: soft, natural shoulder position
- **Shoulders back**: shoulders pulled back, open chest, strong posture
- **One shoulder forward**: one shoulder slightly advanced, creating depth
- **Shoulders dropped**: relaxed, slightly slouched fashionable posture (editorial)
- **Open chest**: chest open and lifted, confident presence

### 4. Brazos (Arms)

#### Poses conjuntas
- **Arms down by the sides**: both arms relaxed hanging naturally by the sides
- **Arms crossed**: arms crossed over the chest or at the waist
- **Hands on hips**: both hands placed on the hips
- **Arms raised**: both arms raised above the head or behind the head
- **One arm up, one arm down**: asymmetrical arm position, dynamic
- **Arms behind the back**: both hands clasped or resting behind the back
- **Arms in front of the body**: hands gently clasped or touching in front of the body
- **Framing the face**: both hands lightly framing or touching the face
- **Holding an object**: both hands holding a bag, cup, or prop

#### Poses individuales (brazo izquierdo / derecho)
- **Arm hanging relaxed**: arm hanging loosely by the side
- **Hand on hip**: hand resting on the hip with elbow out
- **Hand in pocket**: hand casually slipped into a pocket
- **Arm bent with hand on opposite shoulder**: classic elegant arm cross
- **Hand touching the face**: fingers lightly touching chin, cheek, or lips
- **Arm raised above the head**: arm stretched upward
- **Hand on the back of the neck**: hand resting on the nape or running through hair
- **Arm extended forward**: arm reaching toward the camera or to the side
- **Hand resting on a surface**: hand placed on a wall, chair, or table for support
- **Sleeve partially covering the hand**: hand slightly hidden by the sleeve, soft gesture

```txt
Brazos
├── Conjuntos
│   ├── Ambos abajo
│   ├── Ambos arriba
│   ├── Brazos cruzados
│   └── ...
│
└── Individual
    ├── Izquierdo
    │   ├── Abajo
    │   ├── En cintura
    │   ├── Sobre cabeza
    │   └── ...
    │
    └── Derecho
        ├── Abajo
        ├── En cintura
        ├── Sobre cabeza
        └── ...
```

### 5. Piernas (Legs)

#### Poses conjuntas
- **Feet together**: both feet close together, formal and clean
- **Feet slightly apart**: natural standing stance, shoulder-width or narrower
- **One leg bent**: weight on one leg, the other knee softly bent
- **Legs crossed while standing**: one leg crossed over the other while standing (fashion classic)
- **Legs crossed while sitting**: elegant leg cross when seated
- **Wide stance**: strong, grounded stance with feet apart
- **Walking mid-stride**: one leg forward, the other pushing off
- **Knees together**: knees close, modest or refined posture
- **One knee up**: one knee raised (sitting on the floor or crouching)

#### Poses individuales
- **Straight leg**: leg extended straight
- **Bent knee**: knee softly or sharply bent
- **Pointed toe**: foot pointed, elongated line (especially in heels)
- **Flexed foot**: foot flexed, more casual or grounded
- **Leg extended forward**: one leg stretched toward the camera
- **Leg kicked back**: one leg bent behind the body
- **Ankle crossed**: one ankle crossed over the other while standing or sitting

### 6. Manos y gestos (Hands & Gestures) – muy importantes en moda

- **Relaxed open hands**: soft, natural open hands
- **Fingers slightly apart**: elegant, elongated fingers
- **Light fist**: soft closed hand, controlled energy
- **Touching the clothing**: adjusting a sleeve, collar, or lapel
- **Running hand through hair**: natural hair interaction
- **Hand near the face without touching**: delicate framing gesture
- **Holding the strap of a bag**: classic fashion accessory interaction
- **Hands in pockets with thumbs out**: casual cool gesture
- **Delicate finger placement on the neck or collarbone**

### 7. Poses de moda icónicas / editoriales

- **Fashion stoop**: slightly hunched, editorial anti-pose, high fashion attitude
- **Over-the-shoulder glance**: body angled away, looking back with intensity
- **Hand on the wall**: one hand placed on a wall, body leaning or stretched
- **Sitting with knees up**: intimate, protective or casual seated pose
- **Lying on side with head propped on hand**: classic reclining beauty pose
- **Power stance**: strong wide stance, hands on hips or arms crossed
- **Movement blur suggestion**: pose that implies motion (coat flying, hair moving, mid-turn)
- **Mirror pose**: interacting with a mirror, looking at reflection or at camera through it
- **Prop interaction**: clearly interacting with a chair, railing, car, or architectural element

### 8. Intensidad y actitud de la pose

- **Static and composed**: still, controlled, elegant
- **Dynamic and energetic**: sense of movement and vitality
- **Relaxed and candid**: natural, as if unaware of the camera
- **Strong and assertive**: powerful body language
- **Soft and delicate**: gentle, feminine, graceful lines
- **Editorial and unconventional**: unexpected angles or anti-poses typical of high fashion
- **Sensual and elongated**: long lines, arched back, extended limbs
- **Playful and light**: lively, youthful energy

### Posiciones de Yoga (Asanas)

#### 1. Poses de pie (Standing Poses)

- **Tadasana (Mountain Pose)**: standing tall with feet together or hip-width apart, arms by the sides, spine elongated, grounded and strong posture
- **Urdhva Hastasana (Upward Salute)**: standing with arms extended straight up overhead, palms facing each other or touching, chest open
- **Utthita Trikonasana (Extended Triangle Pose)**: standing with legs wide apart, one hand reaching down toward the shin or floor, the other arm extended upward, torso rotated open
- **Parivrtta Trikonasana (Revolved Triangle Pose)**: standing wide-legged stance with a deep twist, one hand on the floor or block, the other reaching upward
- **Utthita Parsvakonasana (Extended Side Angle Pose)**: deep lunging stance, front knee bent, forearm resting on the thigh or hand on the floor, top arm reaching overhead in a long line
- **Parivrtta Parsvakonasana (Revolved Side Angle Pose)**: lunge position with a strong spinal twist, hands in prayer or one hand down
- **Virabhadrasana I (Warrior I)**: deep lunge with back foot angled, hips squared forward, arms reaching straight up overhead
- **Virabhadrasana II (Warrior II)**: wide lunging stance, front knee bent, arms extended horizontally in opposite directions, gaze over the front hand
- **Virabhadrasana III (Warrior III)**: balancing on one leg, torso and back leg extended parallel to the floor, arms reaching forward or by the sides
- **Ardha Chandrasana (Half Moon Pose)**: balancing on one leg and one hand, the other leg and arm extended upward, open hip and chest
- **Vrksasana (Tree Pose)**: standing on one leg, the other foot placed on the inner thigh or calf, hands in prayer or overhead
- **Garudasana (Eagle Pose)**: standing on one leg with the other leg wrapped around it, arms wrapped in front of the body
- **Utkatasana (Chair Pose)**: feet together, knees bent as if sitting in a chair, arms reaching upward
- **Utkata Konasana (Goddess Pose)**: wide stance with toes turned out, deep squat, arms raised in cactus position or overhead
- **Prasarita Padottanasana (Wide-Legged Forward Fold)**: wide stance, folding forward from the hips, hands on the floor or holding the feet
- **Parsvottanasana (Pyramid Pose)**: short lunge stance, hips squared, deep forward fold over the front leg

#### 2. Poses de equilibrio (Balancing Poses)

- **Natarajasana (Dancer Pose / Lord of the Dance)**: standing on one leg, holding the other foot behind the body, torso leaning forward, free arm extended forward
- **Utthita Hasta Padangusthasana (Extended Hand-to-Big-Toe Pose)**: standing on one leg, holding the extended leg with one hand, torso upright or folding forward
- **Ardha Baddha Padmottanasana (Half Bound Lotus Forward Fold)**: standing forward fold with one leg in half lotus, hand binding behind the back
- **Bakasana (Crow Pose)**: balancing on the hands with knees resting on the upper arms, body compact and lifted
- **Parsva Bakasana (Side Crow)**: crow variation with a twist, both legs stacked to one side
- **Eka Pada Galavasana (Flying Pigeon)**: arm balance with one leg wrapped over the upper arm, the other leg extended back
- **Pincha Mayurasana (Forearm Stand)**: balancing on the forearms with the body inverted, legs extended upward
- **Adho Mukha Vrksasana (Handstand)**: full inversion balancing on the hands, body straight or slightly arched

#### 3. Poses sentadas (Seated Poses)

- **Sukhasana (Easy Pose)**: simple cross-legged seated position, spine tall
- **Padmasana (Lotus Pose)**: classic lotus with each foot placed on the opposite thigh, spine erect
- **Ardha Padmasana (Half Lotus)**: one foot on the opposite thigh, the other leg bent
- **Siddhasana (Accomplished Pose)**: seated with heels aligned near the perineum, spine straight
- **Dandasana (Staff Pose)**: seated with legs extended straight forward, spine tall, hands by the hips
- **Paschimottanasana (Seated Forward Fold)**: seated with legs extended, folding deeply forward over the legs
- **Janu Sirsasana (Head-to-Knee Pose)**: one leg extended, the other bent with sole against the inner thigh, folding over the straight leg
- **Upavistha Konasana (Wide-Angle Seated Forward Fold)**: seated with legs wide apart, folding forward
- **Baddha Konasana (Bound Angle Pose / Butterfly)**: soles of the feet together, knees open to the sides, optional forward fold
- **Gomukhasana (Cow Face Pose)**: legs stacked with knees aligned, arms bound behind the back in a cow-face shape
- **Marichyasana (Sage Marichi’s Pose)**: various binding twists with one leg bent and the other extended
- **Ardha Matsyendrasana (Half Lord of the Fishes Pose)**: classic seated spinal twist with one leg bent and the other foot outside the opposite thigh
- **Parivrtta Sukhasana (Revolved Easy Pose)**: simple cross-legged position with a gentle twist
- **Navasana (Boat Pose)**: balancing on the sitting bones with legs and torso lifted in a V-shape
- **Ubhaya Padangusthasana (Both Big Toes Pose)**: seated balance holding both big toes, legs extended upward

#### 4. Flexiones hacia adelante (Forward Bends)

- **Uttanasana (Standing Forward Fold)**: standing fold from the hips, head hanging, hands on the floor or holding opposite elbows
- **Ardha Uttanasana (Halfway Lift)**: flat back position from a forward fold, hands on shins or floor
- **Kurmasana (Tortoise Pose)**: deep seated forward fold with arms under the legs
- **Supta Kurmasana (Reclining Tortoise)**: advanced version with legs crossed behind the head

#### 5. Flexiones hacia atrás (Backbends)

- **Bhujangasana (Cobra Pose)**: lying on the stomach, lifting the chest with arms, elbows bent or straight
- **Urdhva Mukha Svanasana (Upward-Facing Dog)**: similar to cobra but with thighs lifted and arms straight
- **Salabhasana (Locust Pose)**: lying on the stomach, lifting legs and chest off the floor
- **Dhanurasana (Bow Pose)**: lying on the stomach, holding the ankles and lifting into a bow shape
- **Ustrasana (Camel Pose)**: kneeling backbend, hands on the heels, chest lifted toward the ceiling
- **Urdhva Dhanurasana (Wheel Pose / Full Backbend)**: full upward bow, hands and feet on the floor, body arched
- **Matsyasana (Fish Pose)**: reclining backbend with chest lifted and head resting on the crown or forehead
- **Setu Bandhasana (Bridge Pose)**: lying on the back, lifting the hips, hands optionally clasped under the body
- **Eka Pada Setu Bandhasana (One-Legged Bridge)**: bridge with one leg extended upward
- **Kapotasana (Pigeon Pose – King Pigeon variation)**: deep kneeling or lying backbend with hands reaching toward the feet
- **Eka Pada Rajakapotasana (King Pigeon Pose)**: classic pigeon with the back leg bent and foot held, deep backbend

#### 6. Inversiones (Inversions)

- **Sirshasana (Headstand)**: balancing on the forearms and crown of the head, legs extended upward
- **Sirsasana II (Tripod Headstand)**: headstand variation with hands in a tripod position
- **Sarvangasana (Shoulder Stand)**: balancing on the shoulders with legs extended upward, hands supporting the back
- **Halasana (Plow Pose)**: from shoulder stand, legs extended over the head toward the floor
- **Karnapidasana (Ear-Pressure Pose)**: plow variation with knees bending down by the ears
- **Adho Mukha Svanasana (Downward-Facing Dog)**: classic inverted V-shape, hands and feet on the floor, hips high
- **Prasarita Padottanasana (Wide-Legged Standing Forward Fold)** – also acts as a mild inversion
- **Viparita Karani (Legs-Up-the-Wall Pose)**: restorative inversion with legs vertical against a wall or in the air

#### 7. Poses de suelo (Prone & Supine)

- **Balasana (Child’s Pose)**: kneeling and folding forward, arms extended or by the sides, forehead on the floor
- **Ananda Balasana (Happy Baby Pose)**: lying on the back, holding the feet, knees bent toward the armpits
- **Supta Baddha Konasana (Reclining Bound Angle)**: lying on the back with soles together and knees open
- **Supta Padangusthasana (Reclining Hand-to-Big-Toe Pose)**: lying on the back, holding one extended leg
- **Jathara Parivartanasana (Revolved Abdominal Twist)**: lying twist with knees stacked and falling to one side
- **Savasana (Corpse Pose)**: lying flat on the back, completely relaxed, arms and legs slightly apart

#### 8. Poses de apertura de cadera (Hip Openers)

- **Eka Pada Rajakapotasana (Pigeon Pose – preparatory)**: front leg bent, back leg extended, torso upright or folding forward
- **Agnistambhasana (Fire Log Pose / Double Pigeon)**: seated with both shins stacked parallel to the front of the mat
- **Frog Pose (Mandukasana variation)**: deep hip opener on all fours or lying, knees wide
- **Lizard Pose (Utthan Pristhasana)**: low lunge with both hands inside the front foot, deep hip stretch
- **Butterfly Pose (Baddha Konasana)** – already listed, strong hip opener

#### 9. Poses restaurativas y suaves

- **Supported Child’s Pose**: child’s pose with a bolster under the torso
- **Supported Bridge Pose**: bridge with a block under the sacrum
- **Legs-Up-the-Wall (Viparita Karani)**
- **Reclined Twist with support**
- **Savasana with bolsters and blankets**

#### 10. Secuencias clásicas (útiles para prompts dinámicos)

- **Surya Namaskar A (Sun Salutation A)**: flowing sequence of mountain, upward salute, forward fold, halfway lift, plank, chaturanga, upward dog, downward dog
- **Surya Namaskar B (Sun Salutation B)**: includes chair pose and warrior I variations
- **Vinyasa flow transition**: dynamic movement between poses, breath-synchronized

### Poses Sentadas

#### 1. Poses sentadas clásicas en silla

- **Sitting upright on a chair**: sitting straight on a chair with perfect posture, feet flat on the floor or elegantly placed, hands resting on the thighs or armrests
- **Sitting with legs crossed at the knees**: classic elegant seated pose, one leg crossed over the other at the knee, torso upright and refined
- **Sitting with legs crossed at the ankles**: more delicate and modest version, ankles crossed, knees together
- **Sitting with one leg crossed over the other**: relaxed yet polished, one ankle resting on the opposite knee (figure-four position)
- **Sitting on the edge of the chair**: perched on the front edge of the seat, body leaning slightly forward, dynamic and engaged
- **Sitting back in the chair**: reclining slightly against the backrest, relaxed and confident posture
- **Sitting sideways on a chair**: body turned to the side, one arm resting on the backrest, legs elegant
- **Sitting with legs wide apart**: strong, grounded seated stance, knees open, assertive attitude (more common in menswear or editorial)
- **Sitting with knees together, feet apart**: refined feminine posture, knees close, feet slightly turned out
- **Sitting with one foot tucked under**: casual seated position, one foot pulled under the opposite thigh
- **Sitting with both feet on the chair**: childlike or playful, feet resting on the seat, knees bent up
- **Sitting with legs extended forward**: legs stretched straight out in front while seated, elongated lines
- **Sitting with one leg extended, the other bent**: asymmetrical and elegant, creating interesting negative space
- **Leaning forward while seated**: torso inclined toward the camera or a surface, engaged and intimate
- **Leaning back while seated**: torso reclined, open chest, relaxed or luxurious feeling
- **Twisted seated pose**: torso rotated relative to the hips while sitting, creating tension and shape
- **Sitting with arms resting on the back of the chair**: one or both arms draped over the backrest, casual elegance
- **Sitting with hands on the knees**: formal and composed, palms resting on the thighs
- **Sitting with hands clasped in the lap**: classic demure or professional hand position
- **Sitting with one hand on the chin**: thoughtful or contemplative seated pose
- **Sitting with arms crossed**: confident or closed-off energy while seated

#### 2. Poses sentadas en el suelo

- **Sitting cross-legged on the floor**: classic cross-legged position, spine tall or slightly rounded
- **Sitting with legs extended in front**: both legs straight out, torso upright or folding slightly forward
- **Sitting with one knee up**: one knee bent with foot on the floor, the other leg extended or bent
- **Sitting with both knees up**: knees bent, feet flat on the floor, arms resting on the knees (casual and approachable)
- **Sitting with legs folded to one side**: both legs bent and tucked to the same side (mermaid or side-sit position)
- **Sitting in a diamond shape**: soles of the feet together or close, knees open (butterfly variation)
- **Sitting with legs wide apart on the floor**: straddle position, open and grounded
- **Sitting on one hip**: weight shifted onto one hip, legs elegantly arranged to the side
- **Kneeling while “sitting” on the heels**: seiza-style or high kneeling, upright and formal
- **Sitting between the heels**: buttocks resting between the feet (virasana variation), more advanced and grounded
- **Reclining while seated on the floor**: torso leaning back on the hands, legs extended or bent
- **Lying on the side with upper body propped up**: semi-reclined, supported by one arm, legs stacked or slightly separated
- **Sitting with back against a wall**: casual floor pose, legs extended or bent, relaxed attitude

#### 3. Poses sentadas en superficies elevadas o especiales

- **Sitting on a high stool**: legs dangling or one foot hooked on a rung, modern and editorial
- **Sitting on a low stool or ottoman**: more grounded, knees higher than hips
- **Sitting on the edge of a table or desk**: perching on a surface, legs dangling or one leg bent
- **Sitting on the arm of a sofa or chair**: informal and stylish, one hip on the armrest
- **Sitting on stairs**: various levels, one foot on a higher or lower step, dynamic composition
- **Sitting on a windowsill**: legs inside or dangling outside, natural light interaction
- **Sitting on a bed**: cross-legged, knees up, or legs extended, intimate and lifestyle feeling
- **Sitting on the floor with back against a sofa or bed**: casual and lived-in atmosphere
- **Sitting on a bench**: classic public or park bench pose, legs crossed or parallel
- **Sitting on a rock or natural surface**: outdoor editorial, organic and grounded
- **Sitting on a suitcase or prop**: travel or conceptual advertising pose
- **Sitting inside a car**: one leg out, or both legs in, lifestyle and automotive advertising classic

#### 4. Variaciones de actitud y energía (sentadas)

- **Elegant and refined seated pose**: perfect posture, elongated neck, controlled limbs, high-fashion energy
- **Relaxed and candid seated pose**: soft posture, natural asymmetry, as if unaware of the camera
- **Power seated pose**: strong back, open chest, direct gaze, authoritative presence
- **Intimate and soft seated pose**: slightly rounded shoulders, gentle hand gestures, vulnerable or sensual mood
- **Playful seated pose**: unexpected leg or arm positions, light and youthful energy
- **Editorial anti-pose (seated)**: slightly awkward or unconventional arrangement of limbs, high-fashion attitude
- **Sensual seated pose**: arched back, elongated legs, hand placements that emphasize the body
- **Professional / corporate seated pose**: upright, composed, hands neatly placed, clean and trustworthy
- **Lifestyle seated pose**: natural, everyday feeling, as if captured in a real moment
- **Dynamic seated pose**: sense of movement even while sitting (turning, adjusting, mid-gesture)

#### 5. Interacciones con las manos y brazos mientras se está sentado

- **Hands resting lightly on the thighs**
- **One hand on the opposite knee**
- **Arms wrapped around the knees** (when knees are up)
- **Hands holding the seat edge**
- **One arm draped over the backrest**
- **Hands adjusting clothing or hair while seated**
- **Holding a prop (cup, book, phone, bag) in a natural way**
- **Elbows on the knees, hands supporting the face**
- **Arms extended behind the body, supporting the torso**
- **Hands clasped behind the head while seated**

#### 6. Poses sentadas específicas por estilo de campaña

- **High fashion seated**: extreme elegance, long lines, often on the edge of the seat or with strong asymmetry
- **Commercial / lifestyle seated**: approachable, natural, warm, realistic body language
- **Beauty close-up seated**: upper body focused, perfect posture, flattering angles for face and product
- **Lingerie or intimates seated**: soft, intimate, often on bed or floor, elongated and sensual lines
- **Streetwear seated**: casual, slightly slouched or wide-legged, cool and urban attitude
- **Corporate / business seated**: upright, controlled, confident but not aggressive
- **Editorial storytelling seated**: pose that suggests a narrative (waiting, thinking, resting, observing)

### Posiciones de Baile

#### 1. Posiciones básicas de Ballet (pies y brazos)

##### Posiciones de los pies
- **First position**: heels together, toes turned out in a straight line, classic ballet stance
- **Second position**: feet apart in a wide turned-out stance, heels aligned
- **Third position**: one foot in front of the other, heel of the front foot touching the arch of the back foot
- **Fourth position**: one foot in front of the other with space between them, both turned out
- **Fifth position**: feet tightly crossed, the heel of one foot touching the toe of the other, maximum turnout

##### Posiciones de los brazos
- **Bras bas (preparatory position)**: arms gently rounded and held low in front of the thighs
- **First position arms**: arms rounded in front of the body at the level of the diaphragm, forming an oval
- **Second position arms**: arms extended to the sides, slightly rounded and held just below shoulder height
- **Third position arms**: one arm in first position, the other in second
- **Fourth position arms**: one arm raised in fifth, the other in first or second
- **Fifth position arms**: both arms raised above the head, rounded and framing the face
- **Arabesque arms**: classic long line, one arm extended forward, the other extended back

#### 2. Poses clásicas de Ballet

- **Arabesque**: standing on one leg, the other leg extended straight behind the body, torso upright or slightly tilted, long elegant line
- **Attitude**: similar to arabesque but the raised leg is bent at the knee, creating a graceful curved shape
- **Plié**: knees softly bent while maintaining turnout, can be demi-plié or grand plié
- **Relevé**: rising onto the balls of the feet or full pointe, elongated and lifted
- **Tendu**: one leg extended with the toes pointed and still touching the floor
- **Dégagé**: similar to tendu but the foot leaves the floor slightly
- **Pirouette preparation**: classic preparation stance before a turn, one foot in fourth or fifth, arms in position
- **Pirouette**: captured mid-turn on one leg, other leg in passé (foot at the knee), arms gathered
- **Passé**: standing on one leg, the other foot pointed and placed at the knee of the standing leg
- **Développé**: the working leg unfolds from a bent position into a full extension (front, side or back)
- **Grand battement**: high, powerful kick with a straight leg
- **Cambré**: upper body bending gracefully to the side or back while the lower body remains stable
- **Port de bras**: elegant movement or final position of the arms, flowing and expressive

#### 3. Poses de Danza Contemporánea y Moderna

- **Contraction**: torso deeply curved inward, as if the center of the body is pulling inward (Graham technique)
- **Release**: the opposite of contraction, open and expanded torso
- **Spiral**: body twisting around its central axis in a continuous spiral shape
- **Off-balance tilt**: torso and body leaning off the vertical axis while still controlled
- **Floor work – seated twist**: sitting on the floor with a deep spiral in the spine
- **Floor work – lying with limbs extended**: body on the floor in an expansive, expressive shape
- **Hinge**: knees bent, torso leaning backward in a straight line from knees to head
- **Lunge with upper body twist**: deep lunge combined with a strong rotation of the torso
- **Inverted shapes**: weight on hands or shoulders, legs in the air in sculptural positions
- **Fall and recovery**: mid-fall or just recovering from a controlled fall, dynamic tension
- **Curved spine standing**: standing with a deep C-curve in the spine, contemporary aesthetic
- **Asymmetrical balance**: balancing in an unexpected, non-classical shape

#### 4. Poses de Jazz y Musical Theatre

- **Jazz square suggestion**: body captured in the middle of a jazz square step, angled and lively
- **Fosse-style pose**: shoulders forward, hips back, classic Bob Fosse attitude, often with turned-in knees or specific hand gestures
- **High kick**: one leg extended high in front or to the side, supporting leg straight, arms in opposition
- **Layout**: body arched backward with one leg extended, dramatic and open
- **Side lean**: strong lateral bend of the torso while standing or lunging
- **Isolated shoulder or hip pose**: clear isolation of shoulders or hips, sharp and rhythmic feeling
- **Strut pose**: confident walking pose with strong attitude, chest lifted, one hip leading

#### 5. Poses de Hip-Hop, Street Dance y Urban

- **Power pose / stance**: strong wide-legged stance, knees bent, arms in a dominant or expressive position
- **Freeze**: classic breaking freeze, body balanced in a sculptural, often inverted or angled position
- **Tutting position**: geometric arm and hand shapes, right angles, precise and graphic
- **Waving pose**: body captured mid-wave, creating a fluid S or ripple shape through the arms and torso
- **Popping hit**: sharp contracted muscle pose, as if frozen in a strong isolation
- **Krump stance**: aggressive, expansive, emotional posture with strong chest and arm expressions
- **Low crouching dance pose**: deep squat or crouch with upper body expressive and dynamic
- **Toprock stance**: upright bouncing or rocking stance typical of breaking toprock
- **Air pose / jump**: captured in the air during a jump or leap, legs and arms in dynamic shape

#### 6. Poses de Baile de Salón y Latino

- **Closed hold position**: classic ballroom embrace, partners close (or single dancer suggesting the frame)
- **Promenade position**: body facing the direction of movement, elegant traveling pose
- **Tango pose**: dramatic, sharp lines, often with a strong lunge or cross, intense attitude
- **Waltz sway**: soft, rising and falling feeling, body in a gentle side curve
- **Salsa / Mambo open position**: partners apart (or solo), arms extended, rhythmic hip and foot suggestion
- **Cha-cha check**: classic check position with one leg extended, body angled
- **Rumba walk suggestion**: sensual walking pose with hip action and elongated lines
- **Paso Doble cape pose**: dramatic, matador-inspired stance, strong and proud
- **Samba bounce pose**: lively, bouncing energy with soft knees and expressive arms

#### 7. Saltos, giros y movimiento (poses dinámicas)

- **Grand jeté**: large split leap in the air, legs fully extended, arms in opposition
- **Sauté**: small jump from two feet, body lifted and light
- **Tour en l’air**: mid-air turn, body rotated
- **Barrel jump**: jump with legs bent and body curved sideways in the air
- **Stag leap**: leap with one leg bent and the other extended
- **Turning attitude or arabesque**: mid-turn with the leg in attitude or arabesque
- **Spotting head**: head sharply turned in the opposite direction of a turn (classic pirouette detail)
- **Mid-spin pose**: body captured during a fast spin, fabric or hair showing movement

#### 8. Poses expresivas y de actitud (útiles en moda y publicidad)

- **Dramatic reach**: one or both arms extended in a strong reaching gesture, emotional intensity
- **Closed, introspective dance pose**: body folded inward, arms wrapped or head down
- **Open and expansive pose**: arms and chest wide open, celebratory or free energy
- **Sensual body roll suggestion**: torso captured in a wave-like curve, hips and chest in opposition
- **Sharp angular pose**: clear angles in elbows, knees and wrists, graphic and modern
- **Soft lyrical pose**: continuous curved lines, gentle and emotional
- **Grounded rhythmic pose**: low center of gravity, strong connection to the floor, powerful presence
- **Playful and light pose**: bouncy, youthful, with unexpected arm or leg gestures




## Ropa

Bifurcación 1:

- Hombre
- Mujer

Bifurcación 2:

- Pose conjunta de las dos piernas
- Pose individual de cada pierna

Combinar con:
- Colores
- Intensidades

Y un sistema de outfits:

```txt
OUTFIT
│
├── Estilo
│   ├── Casual
│   ├── Formal
│   ├── Business
│   ├── Streetwear
│   ├── Sport
│   ├── Elegant
│   ├── Summer
│   ├── Winter
│   └── ...
│
├── Parte superior
│
├── Parte inferior
│
├── Capa exterior
│
├── Calzado
│
├── Accesorios
│
└── Colores
``` 

Se pueden guardar outfits:

```txt
Urban Casual #12

Style:
Streetwear

Top:
oversized beige hoodie

Bottom:
wide-leg dark blue jeans

Shoes:
white sneakers

Accessories:
black sunglasses
silver watch
```

#### Hombre
- camisas
- polos
- camisetas
- pantalones

#### Mujer
- blusas
- vestidos
- chaquetas
- gabardinas
- Faldas
- camisetas 
- sudaderas
- pantalones
- blazers

#### Tipos de pantalones 

##### 1. Por silueta / corte
- **Pantalón skinny / pitillo**: Muy ajustado desde la cadera hasta el tobillo. Marca la pierna.
- **Pantalón slim**: Ajustado pero menos extremo que el skinny, con un poco más de holgura.
- **Pantalón straight / recto**: Caída vertical y recta desde la cadera hasta el bajo. Clásico y versátil.
- **Pantalón tapered**: Más holgado en cadera y muslo, se estrecha hacia el tobillo.
- **Pantalón bootcut**: Ajustado o recto hasta la rodilla y se abre ligeramente en el bajo (para llevar con botas).
- **Pantalón flared / campana**: Se abre de forma pronunciada a partir de la rodilla.
- **Pantalón wide-leg / de pierna ancha**: Holgado y amplio en toda la pierna.
- **Pantalón palazzo**: Extremadamente amplio y fluido, normalmente de tejidos ligeros y largo a tobillo o suelo.
- **Pantalón carrot**: Holgado en cadera y muslo, se estrecha de forma redondeada hacia el tobillo.
- **Pantalón boyfriend**: Holgado, con aire masculino, normalmente con rotos o aspecto desgastado.
- **Pantalón mom**: Talle alto, holgado en cadera y muslo, y se estrecha hacia el tobillo (estilo años 80-90).
- **Pantalón dad**: Similar al mom pero aún más holgado y con pernera más recta o ligeramente tapered.
- **Pantalón baggy**: Muy holgado en toda la pierna, silueta amplia y desestructurada.
- **Pantalón cigarette**: Recto y estrecho, termina en el tobillo o ligeramente por encima. Elegante.
- **Pantalón culotte**: Longitud midi (a media pantorrilla), pernera amplia y caída limpia.
- **Pantalón paperbag**: Cintura fruncida con cinturón, volumen en la parte superior.
- **Pantalón cargo**: Con bolsillos laterales grandes (de parche), silueta normalmente recta o ligeramente holgada.
- **Pantalón de pinzas / pleated**: Con una o dos pinzas en el delantero que dan holgura y elegancia.
- **Pantalón chino**: Corte clásico, normalmente de algodón twill, silueta recta o ligeramente tapered.
- **Pantalón jogger**: Cintura y bajos elásticos, tejido cómodo (punto, felpa o técnico).
- **Pantalón legging**: Extremadamente ajustado, de tejido elástico, como una malla gruesa.

##### 2. Por largo / longitud
- **Pantalón full-length / largo completo**: Hasta el tobillo o rozando el suelo.
- **Pantalón ankle-length / a tobillo**: Termina exactamente en el tobillo o 1-2 cm por encima.
- **Pantalón cropped / corto**: Termina varios centímetros por encima del tobillo.
- **Pantalón midi / culotte length**: A media pantorrilla.
- **Pantalón bermuda**: Por encima de la rodilla (normalmente 5-15 cm arriba).
- **Short / pantalón corto**: Claramente por encima de la rodilla.
- **Hot pants**: Muy cortos y ajustados.
- **Capri**: Termina a media pantorrilla, más ajustado que el culotte.

##### 3. Por estilo / ocasión / estética
- **Vaqueros / jeans**: El más versátil. Existen en todos los cortes (skinny, straight, wide, mom…).
- **Pantalón de traje / dress pants**: Tejidos estructurados (lana, sarga, elásticos técnicos), ideal para looks formales.
- **Pantalón chino**: Entre formal e informal, perfecto para smart-casual.
- **Pantalón cargo**: Estilo utilitario y militar.
- **Pantalón de cuero o efecto cuero**: Ajustado o recto, muy usado en looks nocturnos y rock.
- **Pantalón de terciopelo o pana**: Textura rica, ideal para otoño-invierno.
- **Pantalón de lino**: Ligero y arrugado con gracia, perfecto para verano.
- **Pantalón deportivo / track pants**: Con bandas laterales, bajos elásticos o zíper, estilo athleisure.
- **Pantalón de chándal / sweatpants**: De felpa o punto, máximo confort.
- **Pantalón militar / army**: Colores caqui o tierra, bolsillos y detalles funcionales.
- **Pantalón western / cowboy**: Con costuras características y a veces bordados.
- **Pantalón workwear / utility**: Robustos, con refuerzos y bolsillos múltiples.
- **Pantalón de vestir formal**: Para trajes de chaqueta, smoking o etiqueta.
- **Pantalón fluido / fluid pants**: Tejidos con mucha caída (viscosa, crepé, satén).
- **Pantalón estampado**: Floral, animal print, geométrico, cuadros, rayas…
- **Pantalón de punto**: Elástico y cómodo, silueta normalmente recta o tapered.

##### 4. Por talle / altura de cintura
- **Talle alto / high-waisted**: Por encima del ombligo, alarga la pierna y marca la cintura.
- **Talle medio / mid-rise**: En el ombligo o ligeramente por debajo.
- **Talle bajo / low-rise**: Claramente por debajo del ombligo.
- **Talle ultra-alto**: Muy por encima del ombligo, a veces hasta debajo del busto (menos frecuente).

##### 5. Por tejido y acabados característicos (especialmente en vaqueros)
- **Denim crudo / raw denim**
- **Denim lavado / washed**
- **Denim stretch** (con elastano)
- **Denim rígido / rigid**
- **Acabados**: distressed (rotos), ripped, faded, stone-wash, acid-wash, coated, overdyed…
- **Otros tejidos**: sarga, popelín, lana, lino, terciopelo, cuero, sintéticos técnicos, punto.

##### 6. Detalles constructivos y variaciones frecuentes
- Con pinzas (una o dos)
- Con plisados
- Con bolsillos de vivo, de parche o cargo
- Con cinturón o pretina ancha
- Con elásticos en cintura o bajos
- Con cremallera, botón o cierre oculto
- Con aberturas en el bajo (side slits)
- Con bajo doblado (cuffed) o deshilachado (frayed)
- Con costuras contrastadas
- Con pretina paperbag o fruncida
- Con efecto moldeador (shapewear pants)
- Con rodilleras o refuerzos

#### Tipos de chaquetas (clasificación completa de experta en moda)

##### 1. Por silueta / corte principal
- **Chaqueta recta / straight**: Caída vertical limpia, sin mucho volumen ni ajuste excesivo.
- **Chaqueta fitted / ajustada**: Marca la cintura y la silueta, con pinzas o costuras de confección.
- **Chaqueta oversize / oversized**: Amplia, hombros caídos y largo generoso. Muy actual.
- **Chaqueta cropped**: Corta, termina en o por encima de la cintura.
- **Chaqueta longline**: Más larga de lo habitual, cubre parte de la cadera o llega a media muslo.
- **Chaqueta peplum**: Con volante o peplum en la cintura que añade volumen.
- **Chaqueta cruzada / double-breasted**: Dos hileras de botones y solapas que se cruzan.
- **Chaqueta de un solo botón o dos botones** (single-breasted)
- **Chaqueta sin solapas / collarless**: Cuello limpio, sin solapa.
- **Chaqueta kimono**: Corte amplio, mangas integradas y caída fluida (inspiración oriental).
- **Chaqueta boxy**: Silueta cuadrada, hombros marcados y largo corto o medio.

##### 2. Por estilo / tipología clásica
- **Blazer / americana**: El básico de sastrería. Solapas, botones y confección estructurada. Puede ser de vestir o casual.
- **Chaqueta de sastre / tailored jacket**: Muy estructurada, con hombreras y pinzas, ideal para traje.
- **Cazadora vaquera / denim jacket**: De tejido denim, clásica, atemporal y versátil.
- **Cazadora biker / perfecto / moto**: De cuero o efecto cuero, solapas asimétricas, cremallera diagonal y remaches.
- **Bomber / blouson**: Cintura y puños elásticos, cremallera delantera, origen militar y aviador.
- **Chaqueta militar / army jacket**: Bolsillos cargo, colores tierra o caqui, estilo utilitario.
- **Sahariana / safari jacket**: Cinturón, bolsillos de fuelle y aspecto explorador.
- **Chaqueta field / de campo**: Similar a la militar, con más bolsillos y tejido resistente.
- **Chaqueta trucker**: Versión vaquera con costuras características y a veces forro.
- **Chaqueta western / cowboy**: Yugo en hombros, botones a presión y a veces bordados.
- **Chaqueta bowling / souvenir**: Estilo retro, a menudo con bordados o estampados en la espalda.
- **Chaqueta varsity / universitaria**: Mangas de contraste (normalmente de cuero o rib), estilo americano.
- **Chaqueta coach**: Ligera, de nailon o similar, con cordón en la cintura y aspecto deportivo.
- **Chaqueta anorak**: Con capucha, cierre de cremallera o botones y a veces faldón.
- **Parka**: Más larga que el anorak, con capucha (a menudo forrada de pelo) y gran capacidad térmica.
- **Chaqueta puffer / de plumas / quilted**: Acolchada, ligera o gruesa, con cámara de aire para aislamiento.
- **Chaqueta down / de plumón**: Relleno de plumón natural o sintético.
- **Chaqueta softshell**: Técnica, elástica e impermeable, para actividad outdoor.
- **Chaqueta hardshell**: Totalmente impermeable y cortavientos, para condiciones extremas.
- **Trench coat corto / trench jacket**: Versión acortada del clásico trench (gabardina).
- **Chaqueta trench**: Con solapas, cinturón y bajo recto o ligeramente evasé.
- **Chaqueta peacoat / navy**: Doble botonadura, de paño grueso, origen marinero.
- **Chaqueta barroquera / de paño**: De lana gruesa, estructurada y cálida.
- **Chaqueta de punto / cardigan jacket**: De punto grueso que imita la estructura de una chaqueta.
- **Chaqueta smoking / dinner jacket**: De etiqueta, normalmente negra o blanca, con solapas de raso.

##### 3. Por largo
- **Cropped / corta**: Por encima o a la altura de la cintura.
- **A la cadera / hip-length**: Termina en la cadera.
- **A media muslo / mid-thigh**: Largo intermedio.
- **Larga / longline**: Cubre gran parte del muslo o llega a la rodilla (límite con el abrigo).

##### 4. Por material y temporada
- **De cuero o efecto cuero**: Biker, perfecto, rectas o oversize.
- **De denim / vaquera**
- **De lana y paño**: Otoño-invierno, estructuradas.
- **De algodón y gabardina**: Media estación.
- **De lino o mezclas ligeras**: Verano y climas cálidos.
- **De seda, satén o tejidos fluidos**: Noche o looks sofisticados.
- **Acolchadas / quilted / puffer**
- **De punto grueso o bouclé**
- **Técnicas (softshell, hardshell, impermeables)**
- **De piel vuelta / shearling**: Con el pelo hacia dentro o visible.
- **De rafia o tejidos naturales**: Versiones veraniegas y de evento.

##### 5. Por ocasión / estética
- **Formal / de vestir**: Blazer de sastrería, smoking jacket, peacoat elegante.
- **Smart-casual**: Americana de algodón, sahariana, denim estructurada.
- **Casual / diario**: Cazadora vaquera, bomber, trucker, oversize.
- **Urbano / streetwear**: Bomber oversize, puffer, varsity, cargo jackets.
- **Outdoor / técnico**: Parka, anorak, softshell, hardshell.
- **Rock / edgy**: Biker de cuero, chaquetas con tachuelas o parches.
- **Romántico / femenino**: Chaquetas con peplum, de tweed bouclé, de encaje o con volantes.
- **Minimalista**: Líneas limpias, pocos detalles, colores neutros.
- **Vintage / retro**: Estilos años 70, 80, 90 (varsity, bowling, western…).
- **De trabajo / utility**: Field jacket, militar, cargo.

##### 6. Detalles constructivos y variaciones frecuentes
- Con solapas (pico, muesca, chal, smoking)
- Con hombreras o sin ellas
- Con cinturón o pretina
- Con bolsillos de vivo, de parche, de fuelle o cargo
- Con cremallera, botones, broches o cierre oculto
- Con capucha (fija, desmontable o enrollable)
- Con forro (liso, estampado, de piel o polar)
- Con puños elásticos, de botón o abiertos
- Con aberturas traseras (ventilación)
- Con remaches, tachuelas o parches
- Con costuras contrastadas
- Con efecto distressed o lavados especiales
- Con mangas desmontables (transformable en chaleco)

#### Tipos de camisas 

##### 1. Por silueta / corte
- **Camisa regular fit / corte clásico**: Recta y cómoda, con holgura moderada en el torso.
- **Camisa slim fit / adjusted**: Más ajustada al cuerpo, estrecha en cintura y mangas.
- **Camisa extra-slim / skinny**: Muy ceñida, silueta marcada.
- **Camisa oversize / oversized**: Amplia, hombros caídos y largo generoso. Muy actual.
- **Camisa boyfriend**: Inspirada en la camisa masculina, holgada y con aire desenfadado.
- **Camisa cropped**: Corta, termina por encima de la cintura o a la altura del ombligo.
- **Camisa longline**: Más larga de lo habitual, cubre parte de la cadera.
- **Camisa peplum**: Con volante o peplum en la cintura que añade volumen.
- **Camisa a-line / evasé**: Se ensancha suavemente hacia el bajo.
- **Camisa boxy**: Corte cuadrado, hombros anchos y silueta rectangular.
- **Camisa fitted waist**: Marca la cintura con pinzas o costuras para dar forma.

##### 2. Por tipo de cuello
- **Cuello italiano / spread collar**: Puntas abiertas, elegante y versátil (ideal con corbata o sin ella).
- **Cuello francés / cutaway**: Aún más abierto que el italiano, muy formal.
- **Cuello button-down**: Con botones que fijan las puntas al cuerpo de la camisa (clásico americano).
- **Cuello americano / point collar**: Puntas más cerradas y largas.
- **Cuello mao / mandarin**: Sin solapas, cuello alto y cerrado (estilo oriental).
- **Cuello smoking / wing collar**: Puntas dobladas hacia arriba, exclusivo de etiqueta.
- **Cuello club / redondeado**: Puntas redondeadas, aspecto vintage y preppy.
- **Cuello barco / boat neck**: Horizontal y amplio (más habitual en versiones femeninas).
- **Cuello off-shoulder**: Deja los hombros descubiertos.
- **Cuello one-shoulder**: Solo un hombro descubierto.
- **Cuello lazo / pussy-bow**: Con lazo anudado en el cuello, muy femenino.
- **Cuello alto / funnel o turtleneck**: Cubre parte del cuello.
- **Sin cuello / collarless**: Cuello limpio, sin solapa.

##### 3. Por tipo de manga
- **Manga larga clásica**: Hasta la muñeca, con puño simple o doble.
- **Manga corta**: Termina a media altura del brazo.
- **Manga tres cuartos**: Llega aproximadamente al codo o un poco más abajo.
- **Manga farol / puff sleeve**: Abullonada en el hombro o a lo largo de la manga.
- **Manga murciélago / batwing**: Muy amplia en la sisa.
- **Manga dolman**: Holgada en la parte superior y más estrecha hacia la muñeca.
- **Manga campana / flared**: Se abre en el bajo.
- **Manga enrollada / rolled-up**: Diseñada para llevarse doblada.
- **Sin mangas / sleeveless**: Tirantes o sisa limpia.

##### 4. Por estilo / ocasión / estética
- **Camisa formal / de vestir (dress shirt)**: Tejidos lisos o con microdiseño, ideal para traje y corbata.
- **Camisa oxford**: Tejido oxford característico, más informal y resistente. Clásica del estilo preppy.
- **Camisa de vestir blanca**: La más versátil y atemporal del guardarropa formal.
- **Camisa vaquera / denim shirt**: De tejido denim, puede ser clara, media o oscura. Muy versátil.
- **Camisa de lino**: Ligera y transpirable, ideal para verano y climas cálidos. Arruga con facilidad (parte de su encanto).
- **Camisa de cuadros / check**: Desde vichy hasta tartán o windowpane.
- **Camisa de franela / flannel**: Tejido cepillado, cálida, típica de otoño-invierno y estilo lumberjack.
- **Camisa hawaiana / tropical**: Estampados florales o exóticos, manga corta, ambiente vacacional.
- **Camisa bowling / camp shirt**: Cuello abierto, bolsillo en el pecho, corte más holgado y retro.
- **Camisa western / cowboy**: Con yugo en hombros y espalda, botones a presión y a veces bordados.
- **Camisa militar / army**: Bolsillos cargo, colores tierra o caqui, detalles funcionales.
- **Camisa workwear / utility**: Robusta, con bolsillos múltiples y tejidos resistentes.
- **Camisa de seda o satén**: Caída lujosa, ideal para noche o looks sofisticados.
- **Camisa transparente o de tejido ligero**: Para capas o looks más sensuales.
- **Camisa estampada**: Floral, animal print, geométrica, abstracta…
- **Camisa de rayas**: Desde raya diplomática hasta raya ancha o bayadère.
- **Camisa de etiqueta / smoking shirt**: Con pliegues o pechera lisa, cuello wing o italiano, para black tie.

##### 5. Por tejido y construcción
- **Popelín**: Fino, fresco y con caída limpia (el más usado en camisas formales).
- **Oxford**: Más grueso y texturizado.
- **Twill**: Con diagonal visible, resistente y con buen caído.
- **Pinpoint**: Intermedio entre popelín y oxford.
- **Lino y mezclas de lino**
- **Algodón 100% o mezclas con elastano**
- **Seda, satén, viscosa o cupro** (para versiones más fluidas y femeninas)
- **Denim y chambray**
- **Franela y flannel**
- **Tejidos técnicos o de viaje** (antiarrugas, elásticos)

##### 6. Detalles constructivos y variaciones frecuentes
- Con pinzas delanteras o traseras (para marcar cintura)
- Con plisado en la espalda (box pleat o side pleats)
- Con yugo (yoke) en hombros
- Con bolsillos de parche, de vivo o de solapa
- Con puños simples, dobles (para gemelos) o convertibles
- Con botones contrastados o ocultos (hidden placket)
- Con aberturas laterales (side slits)
- Con bajo curvo o recto
- Con costuras francesas o ribeteadas
- Con bordados, iniciales o aplicaciones
- Con efecto distressed o lavados especiales (en versiones vaqueras)


#### Tipos de faldas

##### 1. Por silueta / forma
- **Falda lápiz (Pencil skirt)**: Recta, ajustada a la cadera y muslos, termina en la rodilla o justo por encima/debajo. Silueta vertical y elegante.
- **Falda tubo**: Muy similar a la lápiz, pero suele ser más estrecha y de largo medio o corto.
- **Falda A-line / evasé**: Cintura ajustada y se abre en forma de “A” hacia abajo. Fluye sin marcar demasiado la cadera.
- **Falda circular (Circle skirt)**: Corte en círculo completo o media círculo. Muy volumen y movimiento, se abre en 360°.
- **Falda godet / con godets**: Recta en la parte superior e inserta triángulos de tela (godets) en el bajo para dar vuelo.
- **Falda plisada (Pleated skirt)**: Con pliegues permanentes (tabla, cuchillo, caja, acordeón…). Puede ser de cualquier largo.
- **Falda de tablas**: Variante de plisada con pliegues más anchos y planos.
- **Falda envolvente (Wrap skirt)**: Se cruza y se ata en la cintura. Ajustable y muy versátil.
- **Falda tulipán (Tulip skirt)**: Cintura marcada y forma de tulipán que se cierra ligeramente en el bajo.
- **Falda globo / bubble**: Volumen redondeado en la cadera y se recoge o se estrecha en el bajo.
- **Falda peplum**: Falda corta o media con volante o peplum superpuesto en la cintura.
- **Falda asimétrica**: Bajo irregular, más corto de un lado o con cortes diagonales.
- **Falda con volantes / ruffles**: Uno o varios volantes superpuestos a lo largo de la falda.
- **Falda de capas / tiered**: Varias capas de tela superpuestas que crean volumen escalonado.
- **Falda sirena / mermaid**: Ajustada hasta la rodilla o media pierna y se abre en forma de cola de sirena.
- **Falda cargo**: Estilo utilitario con bolsillos laterales grandes y silueta más recta o ligeramente evasé.
- **Falda recta**: Línea limpia y vertical, sin mucho volumen ni ajuste excesivo.

##### 2. Por largo
- **Falda mini**: Por encima de la rodilla (generalmente 10-20 cm por encima).
- **Falda corta**: Ligeramente por encima de la rodilla.
- **Falda a la rodilla / knee-length**: Termina exactamente en la rodilla o 2-3 cm por encima/debajo.
- **Falda midi**: Entre la rodilla y el tobillo (generalmente a media pantorrilla).
- **Falda maxi / larga**: Hasta el tobillo o el suelo.
- **Falda tea-length**: Largo clásico de los años 50, aproximadamente a media pantorrilla.

##### 3. Por estilo / ocasión / tejido característico
- **Falda vaquera / denim**: De tejido denim, puede ser de cualquier silueta (lápiz, A-line, cargo…).
- **Falda de cuero o efecto cuero**: Ajustada o con volumen, muy usada en looks urbanos y de noche.
- **Falda de tul / gasa / chiffon**: Ligera, con mucho movimiento, ideal para looks románticos o de fiesta.
- **Falda de lana o tweed**: Estructurada, típica de otoño-invierno y estilos más formales o preppy.
- **Falda de punto / punto de lana**: Elástica, cómoda, suele ser de silueta tubo o A-line.
- **Falda de satén o seda**: Caída fluida, elegante, perfecta para noche o looks sofisticados.
- **Falda estampada (floral, animal print, geometric…)**: El estampado define el estilo más que la silueta.
- **Falda de fiesta / cocktail**: Generalmente midi o corta, con brillos, lentejuelas o tejidos nobles.
- **Falda de oficina / workwear**: Preferentemente lápiz, A-line o tubo en tejidos estructurados y colores neutros.
- **Falda boho / hippie**: Maxi, con volantes, capas, estampados étnicos o florales y tejidos fluidos.
- **Falda deportiva / athleisure**: De tejidos técnicos, a veces con cintura elástica y detalles deportivos.

##### 4. Variaciones y detalles constructivos frecuentes
- Con abertura (delantera, trasera o lateral)
- Con bolsillos (laterales, cargo, ocultos)
- Con cinturón o pretina ancha
- Con cremallera invisible o visible
- Con forro completo o parcial
- Con vuelo o sin vuelo
- Con corte imperio o bajo de pecho
- Con drapeados o frunces

#### Estilos de camisetas 

##### 1. Por silueta / corte
- **Camiseta básica / regular fit**: Corte clásico y recto, ni muy ajustado ni holgado. La más versátil.
- **Camiseta fitted / slim fit**: Ajustada al cuerpo, marca la silueta sin ser excesivamente ceñida.
- **Camiseta oversize / oversized**: Amplia y holgada, hombros caídos y largo generoso. Muy actual.
- **Camiseta boyfriend**: Inspirada en la camiseta masculina, holgada y con aire desenfadado.
- **Camiseta cropped / crop top**: Corta, deja ver la cintura o el abdomen. Puede ser más o menos ajustada.
- **Camiseta longline / larga**: Más larga de lo habitual, cubre parte de la cadera o llega a media nalga.
- **Camiseta muscle / muscle tee**: Sin mangas o con mangas muy cortas, sisa amplia, resalta hombros y brazos.
- **Camiseta boxy**: Corte cuadrado, hombros anchos y largo corto o medio. Silueta rectangular.
- **Camiseta a-line / evasé**: Más estrecha en hombros y se abre suavemente hacia el bajo.
- **Camiseta peplum**: Con volante o peplum en la cintura que añade volumen en la cadera.
- **Camiseta asimétrica**: Bajo irregular o un hombro más descubierto que el otro.

##### 2. Por tipo de cuello
- **Cuello redondo / crew neck**: El más clásico y versátil.
- **Cuello en V / V-neck**: Alarga el cuello y es más favorecedor en muchos casos.
- **Cuello barco / boat neck**: Horizontal y amplio, deja ver los hombros.
- **Cuello halter**: Se anuda o cierra detrás del cuello, deja la espalda descubierta.
- **Cuello alto / turtleneck o mock neck**: Cubre el cuello (completo o medio).
- **Cuello cuadrado / square neck**: Escote rectangular, muy favorecedor y actual.
- **Cuello corazón / sweetheart**: Forma de corazón, más habitual en tops más vestidos.
- **Cuello off-shoulder / bardot**: Deja ambos hombros descubiertos.
- **Cuello one-shoulder**: Solo un hombro descubierto.
- **Cuello anudado / tie-neck**: Con lazo o nudo en el cuello.
- **Cuello polo / collar**: Con solapa pequeña (más típico de polos, pero existe en camisetas).
- **Cuello henley**: Con abertura delantera y botones (normalmente 2-4).

##### 3. Por tipo de manga
- **Sin mangas / tank top / tirantes**: Tirantes finos o anchos, o sisa americana.
- **Manga corta clásica**: Termina a media altura del brazo.
- **Manga corta raglán**: Costura diagonal desde el cuello hasta la sisa (muy deportiva).
- **Manga corta enrollada / rolled sleeve**: Con el bajo de la manga doblado.
- **Manga tres cuartos**: Llega aproximadamente al codo o un poco más abajo.
- **Manga larga**: Hasta la muñeca.
- **Manga farol / puff sleeve**: Abullonada en el hombro o en toda la manga.
- **Manga murciélago / batwing**: Muy amplia en la sisa y se estrecha hacia la muñeca.
- **Manga cap / cap sleeve**: Muy cortita, apenas cubre el hombro.
- **Manga dolman**: Similar a la murciélago, con mucha holgura en la parte superior.
- **Manga campana / flared**: Se abre en el bajo de la manga.

##### 4. Por estilo / estética / ocasión
- **Camiseta gráfica / graphic tee**: Con estampados, frases, logos o ilustraciones.
- **Camiseta lisa / básica de color**: Sin estampados, ideal para combinar.
- **Camiseta vintage / retro**: Lavados desgastados, cortes antiguos o estampados de décadas pasadas.
- **Camiseta deportiva / performance**: Tejidos técnicos, transpirables, a veces con costuras flatlock.
- **Camiseta de punto fino / jersey**: Aspecto más refinado, caída ligeramente más estructurada.
- **Camiseta de algodón grueso / heavyweight**: Más rígida y con cuerpo, muy usada en streetwear.
- **Camiseta de canalé / ribbed**: Tejido acanalado que se ajusta al cuerpo.
- **Camiseta de lino o mezclas naturales**: Aspecto más veraniego y textura visible.
- **Camiseta de seda o satén**: Caída lujosa, más elegante y nocturna.
- **Camiseta transparente o de malla**: Capas o efecto see-through.
- **Camiseta con aberturas o cut-outs**: Detalles recortados en hombros, costados o espalda.
- **Camiseta con volantes o ruffles**: Detalles románticos en hombros, pecho o bajo.
- **Camiseta de estilo militar o utility**: Bolsillos, colores tierra o detalles funcionales.
- **Camiseta de estilo preppy**: Colores sólidos o rayas finas, aspecto limpio y clásico.

##### 5. Detalles constructivos y variaciones frecuentes
- Con costuras vistas o decorativas
- Con bajo curvo o recto
- Con aberturas laterales (side slits)
- Con bolsillos (de parche o invisibles)
- Con bordados, strass o aplicaciones
- Con lavados especiales (acid wash, stone wash, overdye…)
- Con efecto distressed / rotos
- Con doble capa o forro
- Con cierre de botones, cremallera o lazos
- Con espalda total o parcialmente descubierta
- Con hombros caídos (drop shoulder)
- Con sisa americana (racerback)

#### Estilos de vestidos 

##### 1. Por silueta / forma principal
- **Vestido tubo / sheath**: Recto y ajustado al cuerpo de hombros a bajo, sin mucho volumen. Elegante y minimalista.
- **Vestido lápiz / pencil**: Similar al tubo pero suele marcar más la cintura y cadera, con línea muy limpia.
- **Vestido A-line / evasé**: Cintura definida (o ligeramente marcada) y se abre en forma de “A” hacia el bajo. Favorecedor para casi todas las siluetas.
- **Vestido fit and flare**: Ajustado en busto y cintura, y se abre a partir de la cadera con mucho vuelo.
- **Vestido princesa / ball gown**: Cintura marcada y falda muy amplia y voluminosa (a veces con enagua o crinolina). Ideal para ocasiones formales.
- **Vestido sirena / mermaid**: Ajustado hasta la rodilla o media pierna y se abre en forma de cola de sirena.
- **Vestido columna / column**: Línea recta y vertical, sin cintura marcada, muy alargadora.
- **Vestido imperio**: Cintura alta justo debajo del busto, falda que cae suelta desde ahí.
- **Vestido trapecio / trapeze**: Holgado desde los hombros, se abre en forma de trapecio sin marcar la cintura.
- **Vestido shift**: Recto y suelto, cae desde los hombros sin definir la cintura. Cómodo y moderno.
- **Vestido bodycon / ajustado**: Muy ceñido al cuerpo, de tejidos elásticos. Resalta la silueta.
- **Vestido peplum**: Con volante o peplum en la cintura que crea volumen en la cadera.
- **Vestido envolvente / wrap**: Se cruza en el delantero y se ata en la cintura. Muy adaptable y favorecedor.
- **Vestido camisero / shirt dress**: Inspirado en una camisa, con solapa, botones delanteros y a veces cinturón.
- **Vestido babydoll**: Holgado, corto, con vuelo desde el busto o debajo de él, aspecto juvenil y romántico.
- **Vestido oversize / oversized**: Amplio y holgado, silueta rectangular o trapecio exagerada.
- **Vestido tent**: Similar al trapecio pero aún más amplio y con caída muy suelta.
- **Vestido de capas / tiered**: Varias capas de tela superpuestas que generan volumen escalonado.
- **Vestido con godets**: Insertos triangulares en la falda para dar movimiento y vuelo.
- **Vestido drapeado**: Con pliegues y caídas de tela artísticas que crean volumen controlado.

##### 2. Por largo
- **Vestido mini**: Por encima de la rodilla (generalmente 10-20 cm arriba).
- **Vestido corto**: Ligeramente por encima o justo en la rodilla.
- **Vestido a la rodilla / knee-length**: Termina en la rodilla o 2-3 cm alrededor.
- **Vestido midi**: Entre la rodilla y el tobillo (normalmente a media pantorrilla).
- **Vestido tea-length**: Clásico de media pantorrilla, muy usado en looks vintage y formales diurnos.
- **Vestido maxi / largo**: Hasta el tobillo o rozando el suelo.
- **Vestido floor-length**: Completamente hasta el suelo (típico de gala y novia).

##### 3. Por estilo / ocasión / estética
- **Vestido de cóctel**: Generalmente midi o corto, elegante pero no excesivamente formal. Ideal para eventos de tarde-noche.
- **Vestido de noche / evening gown**: Largo, sofisticado, con tejidos nobles (seda, satén, gasa, terciopelo…).
- **Vestido de fiesta / party**: Con brillos, lentejuelas, cortes atrevidos o volúmenes llamativos.
- **Little Black Dress (LBD)**: El clásico vestido negro corto o midi, versátil y atemporal.
- **Vestido slip / lencero**: De corte simple, tirantes finos, caída fluida, inspirado en la lencería.
- **Vestido boho / bohemio**: Holgado, con volantes, estampados étnicos o florales, tejidos naturales y aire desenfadado.
- **Vestido casual / day dress**: Cómodo, de tejidos frescos, ideal para el día a día.
- **Vestido de oficina / workwear**: Siluetas limpias (tubo, A-line, camisero), colores neutros y tejidos estructurados.
- **Vestido de novia**: Desde minimalistas hasta princesa, con tejidos especiales y detalles de encaje, tul, etc.
- **Vestido de invitada de boda**: Elegante, normalmente midi o largo, con cuidado en el color y el protocolo.
- **Vestido sweater / de punto**: Tejido de punto, cómodo, suele ser de silueta tubo o A-line.
- **Vestido denim / vaquero**: De tejido denim, puede ser camisero, A-line o ajustado.
- **Vestido floral**: Definido por el estampado floral más que por la silueta (puede ser de cualquier corte).
- **Vestido de verano / sundress**: Ligero, sin mangas o con tirantes, tejidos frescos y colores vivos.
- **Vestido vintage / retro**: Inspirado en décadas concretas (años 50, 60, 70, 90…).
- **Vestido minimalista**: Líneas limpias, pocos detalles, colores sólidos y tejidos de calidad.
- **Vestido estructurado**: Con costuras internas, ballenas o forros que mantienen una forma definida.
- **Vestido fluido / fluid**: Tejidos con mucha caída (seda, viscosa, crepé) y silueta suelta.

##### 4. Detalles constructivos y variaciones frecuentes
- Con escote (en V, redondo, cuadrado, corazón, word, asimétrico, off-shoulder, one-shoulder…)
- Con mangas (sin mangas, tirantes finos, manga corta, tres cuartos, larga, abullonada, farol, murciélago…)
- Con abertura (lateral, delantera, trasera)
- Con cinturón o pretina marcada
- Con drapeados, frunces o pliegues
- Con volumen en hombros o cadera
- Con forro completo o parcial
- Con cierre (cremallera invisible, botones, lazo, cremallera visible)
- Con espalda descubierta o semidescubierta
- Con cola o train (en vestidos de gala y novia)


### Complementos para la cabeza

#### 1. Sombreros de ala (Hats)
- **Sombrero de ala ancha / wide-brim hat**: Ala generosa que protege del sol y da mucha presencia.
- **Pamela**: Ala extremadamente ancha y flexible, normalmente de fibra natural o rafia. Muy usada en bodas y eventos de día.
- **Sombrero fedora**: Copa rehundida con pliegue longitudinal y ala media-baja, ligeramente caída hacia delante. Clásico y elegante.
- **Sombrero trilby**: Similar al fedora pero con ala más corta y copa más baja.
- **Sombrero borsalino**: Variante italiana del fedora, de gran calidad y prestigio.
- **Sombrero pork pie**: Copa baja y plana con un pliegue circular en la parte superior y ala estrecha.
- **Sombrero bowler / bombín**: Copa redonda y rígida, ala corta y curva. Estilo británico clásico.
- **Sombrero de copa / top hat**: Muy alto y cilíndrico, exclusivo de etiqueta (smoking y chaqué).
- **Sombrero de paja / straw hat**: De fibra natural (toquilla, rafia, sisal…). Ideal para verano.
- **Sombrero canotier / boater**: De paja rígida, copa baja y plana, ala recta. Estilo vintage y veraniego.
- **Sombrero cloché**: Copa ajustada y ala muy pequeña que se acerca a la cara. Estilo años 20.
- **Sombrero bucket / pescador**: Copa baja y ala caída hacia abajo, muy casual y actual.
- **Sombrero cowboy / western**: Ala ancha y curva, copa alta con dentado característico.
- **Sombrero cordobés**: Ala ancha y plana, copa alta y cilíndrica. Estilo andaluz.
- **Sombrero sevillano / de faralá**: Similar al cordobés pero con más adornos y usado en ferias.
- **Sombrero de cazador / safari hat**: Ala media y copa con pinzas, estilo colonial o explorador.
- **Sombrero panama**: De paja toquilla fina, ligero y elegante (puede adoptar forma fedora, gambler, etc.).

#### 2. Gorras (Caps)
- **Gorra de béisbol / baseball cap**: Visera curva o plana, cierre ajustable o de velcro. El complemento más casual y universal.
- **Gorra trucker**: Parte delantera estructurada y parte trasera de malla. Muy streetwear.
- **Gorra snapback**: Visera plana y cierre de broches a presión.
- **Gorra dad hat**: Visera curva, aspecto desestructurado y lavado. Estilo relajado.
- **Gorra five-panel**: Cinco paneles, visera normalmente plana o ligeramente curva.
- **Gorra militar / army cap**: Sin visera pronunciada o con visera corta, estilo casquillo.
- **Gorra flat cap / baker boy / newsboy**: De paño o tweed, copa redondeada y visera corta. Estilo británico.
- **Gorra ivy / cabbie**: Similar a la flat cap pero más baja y ajustada.
- **Gorra de cazador / deerstalker**: Con viseras delantera y trasera y orejeras (estilo Sherlock Holmes).
- **Gorra de plato / peaked cap**: Visera rígida y plato superior, estilo militar o de uniforme.
- **Gorra cycling / de ciclista**: Visera corta y copa ajustada.
- **Gorra de lana con visera**: Versión invernal de la gorra clásica.

#### 3. Gorros y complementos de punto o ajustados
- **Gorro beanie / de punto**: Ajustado a la cabeza, con o sin vuelta. El más básico de invierno.
- **Gorro slouchy**: Más holgado y caído hacia atrás.
- **Gorro con pompón**: Clásico y juvenil.
- **Gorro balaclava / pasamontañas**: Cubre cabeza, cuello y parte de la cara.
- **Gorro fisherman**: Bajo y con canalé marcado, estilo marinero.
- **Gorro bucket de punto**: Versión de invierno del bucket hat.
- **Gorro de orejeras / trapper hat**: Con orejeras que se pueden atar arriba o abajo.
- **Gorro de lana con borla o pompón largo**
- **Turbante**: Tejido enrollado alrededor de la cabeza. Puede ser de punto, satén o tela estampada.
- **Bandana / pañuelo anudado**: Cuadrado de tela doblado y anudado de diferentes formas.
- **Durag**: Prenda ajustada de tejido satinado, originaria de la cultura afroamericana.

#### 4. Tocados y complementos de ocasión
- **Tocado**: Estructura decorativa (plumas, flores, malla, sinamay…) que se sujeta con peineta o diadema. Muy usado en bodas y eventos.
- **Mini-pamela**: Versión reducida de la pamela, más práctica.
- **Fascinator**: Tocado pequeño y elaborado que se coloca ladeado.
- **Diadema / headband**: Desde finas hasta anchas, rígidas o de tejido, con o sin adornos.
- **Diadema joya / tiara**: Con cristales, perlas o metal, para ocasiones especiales.
- **Peineta**: Tradicional española, a menudo combinada con mantilla.
- **Mantilla**: Velo de encaje que se sujeta con peineta (uso ceremonial o religioso).
- **Velos y redecillas**: Complementos más delicados y vintage.

#### 5. Por material y temporada
- **De paja y fibras naturales** (verano y eventos de día)
- **De fieltro y lana** (otoño-invierno)
- **De algodón y sintéticos ligeros** (todo el año, casual)
- **De punto y lana gruesa** (invierno)
- **De piel o efecto piel**
- **De satén, seda o tejidos nobles** (noche y eventos)
- **De rafia, toquilla y sinamay** (pamelas y tocados)

#### 6. Por estilo / estética
- **Clásico / elegante**: Fedora, borsalino, canotier, pamela sobria.
- **Casual / streetwear**: Gorra de béisbol, bucket hat, beanie.
- **Romántico / boho**: Pamela con cintas, turbantes, diademas de flores.
- **Vintage / retro**: Cloché, canotier, flat cap, pork pie.
- **Formal / de etiqueta**: Sombrero de copa, tocados elaborados, pamelas de invitada.
- **Deportivo**: Gorras técnicas, viseras de running.
- **Étnico y cultural**: Turbantes, sombreros cordobeses, panamas, etc.
- **Minimalista**: Líneas limpias, pocos adornos, colores neutros.
- **Maximalista**: Plumas, flores, volúmenes y colores intensos.

#### 7. Detalles y variaciones frecuentes
- Con cinta o banda decorativa
- Con plumas, flores o lazos
- Con hebillas o metal
- Con forro interior
- Con ajuste interno (sudadera o elástico)
- Con orejeras
- Con velo o malla
- Con logo o bordados
- Plegables o de viaje
- Con protección UV

### Complementos de joyería y bisutería

#### 1. Collares y gargantillas (Necklaces)
- **Collar corto / choker**: Se ajusta al cuello, longitud muy corta (30-35 cm).
- **Gargantilla**: Similar al choker, pero puede ser ligeramente más elaborada o de tejido.
- **Collar princesa**: Longitud clásica que cae justo debajo de la clavícula (40-45 cm).
- **Collar matiné**: Llega a la parte superior del pecho (50-60 cm).
- **Collar ópera**: Largo, llega a la altura del busto o más abajo (70-90 cm).
- **Collar rope / soga**: Muy largo (más de 100 cm), se puede enrollar varias veces.
- **Collar de cadena fina / delicate chain**: Minimalista, normalmente con un colgante pequeño.
- **Collar de eslabones / chunky chain**: Eslabones grandes y llamativos.
- **Collar de perlas**: De una o varias vueltas, clásico y atemporal.
- **Collar de cuentas / beaded**: Con perlas de cristal, piedra, madera o resina.
- **Collar statement / statement necklace**: Pieza protagonista, grande y decorativa.
- **Collar bib / babero**: Ancho y plano, cubre la parte superior del pecho.
- **Collar collarín / collar necklace**: Rígido o semi-rígido que se apoya sobre la clavícula.
- **Collar de múltiples vueltas / layered**: Diseñado para llevarse en capas.
- **Collar con colgante / pendant**: Cadena con un dije o medalla.
- **Collar de perlas barrocas o irregulares**
- **Collar de piedras semipreciosas o cristales**
- **Collar choker de terciopelo o terciopelo con camafeo**

#### 2. Pendientes (Earrings)
- **Pendientes de botón / studs**: Pequeños y se apoyan directamente en el lóbulo.
- **Pendientes de aro / hoops**: Circulares, desde mini hasta XXL.
- **Pendientes de lagrima / drop**: Cuelgan por debajo del lóbulo de forma alargada.
- **Pendientes de araña / chandelier**: Elaborados, con varias alturas y mucho movimiento.
- **Pendientes largos / dangle**: Cuelgan de forma vertical y fluida.
- **Pendientes de clip / clip-on**: Sin necesidad de agujero.
- **Pendientes ear cuffs**: Se ajustan al cartílago sin perforación.
- **Pendientes climbers / ear climbers**: Suben por el borde de la oreja.
- **Pendientes huggie**: Aros pequeños y gruesos que “abrazan” el lóbulo.
- **Pendientes statement**: Grandes y llamativos, protagonistas del look.
- **Pendientes de perla**
- **Pendientes de aro torcidos o irregulares**
- **Pendientes asimétricos** (uno diferente del otro)
- **Pendientes de presión o imán**
- **Pendientes trepadores con brillantes o cristales**

#### 3. Pulseras y brazaletes (Bracelets & Bangles)
- **Pulsera de cadena fina**
- **Pulsera de eslabones gruesos / chunky**
- **Pulsera rígida / bangle**: Aro cerrado o semi-abierto que se desliza por la muñeca.
- **Pulsera manchette / cuff**: Ancha y rígida, cubre parte del antebrazo.
- **Pulsera tennis**: Línea continua de brillantes o cristales.
- **Pulsera de perlas**
- **Pulsera de cuentas / beaded**
- **Pulsera de cuerda o hilo** (con o sin nudos)
- **Pulsera charm / de dijes**: Con colgantes personalizables.
- **Pulsera de varios hilos / multi-strand**
- **Pulsera elástica**
- **Pulsera de identificación / ID bracelet**
- **Pulsera de cadena con cierre de mosquetón o imán**
- **Conjunto de pulseras apilables / stackable**

#### 4. Anillos (Rings)
- **Anillo solitario**: Una sola piedra central.
- **Anillo de compromiso / de pedida**
- **Alianza / wedding band**
- **Anillo de promesa**
- **Anillo statement / cocktail ring**: Grande y decorativo.
- **Anillo midi**: Se lleva en la falange media.
- **Anillo apilable / stacking ring**: Fino, diseñado para combinarse con otros.
- **Anillo sello / signet**: Con una superficie plana para grabar.
- **Anillo de banda ancha**
- **Anillo abierto / open ring**
- **Anillo de múltiples dedos / multi-finger**
- **Anillo con piedras laterales o pavé**
- **Anillo toi et moi**: Dos piedras enfrentadas.
- **Anillo eternity**: Piedras alrededor de toda la banda.

#### 5. Broches, alfileres y otros
- **Broche clásico**: De flores, animales, abstractos o vintage.
- **Broche de solapa / lapel pin**
- **Alfiler de corbata / tie pin** (también usado en camisas o vestidos)
- **Camafeo**
- **Broche convertible** (se puede usar como colgante)
- **Imperdible decorativo / safety-pin jewelry**

#### 6. Joyería corporal y otras piezas
- **Tobilleras / ankle bracelets**
- **Anillos de pie / toe rings**
- **Piercings decorativos** (helix, tragus, septum, etc. con joyería visible)
- **Body chains / cadenas corporales**: Que se colocan sobre el torso o la espalda.
- **Collares de espalda / back necklaces**
- **Joyas para el cabello**: Horquillas, peinetas joya, enfilados.
- **Guantes con joyería integrada**

#### 7. Por material y calidad
- **Alta joyería**: Oro (amarillo, blanco, rosa), platino, diamantes y piedras preciosas.
- **Joyería fina / fine jewelry**: Materiales nobles con piedras semipreciosas o brillantes.
- **Bisutería de calidad / fashion jewelry**: Baños de oro o plata, latón, zamak, cristales, resinas.
- **Bisutería de fantasía**: Materiales más económicos, tendencias rápidas.
- **Materiales frecuentes**:
  - Metales: oro, plata, acero, latón, titanio, baño de oro/plata
  - Piedras: diamante, zafiro, esmeralda, rubí, cuarzo, amatista, turquesa, perla…
  - Otros: cristal, resina, madera, concha, cuero, terciopelo, cerámica

#### 8. Por estilo / estética
- **Minimalista**: Líneas limpias, piezas pequeñas y discretas.
- **Clásico / atemporal**: Perlas, solitarios, cadenas finas, aros medianos.
- **Statement / maximalista**: Piezas grandes, volumen y protagonismo.
- **Vintage / retro**: Camafeos, broches, estilos art déco, años 70…
  - **Boho**: Cuentas, plumas, piedras naturales, capas.
- **Rock / edgy**: Tachuelas, cadenas gruesas, spikes, metal negro.
- **Romántico**: Lazos, corazones, flores, perlas barrocas.
- **Geométrico y arquitectónico**: Formas limpias y modernas.
- **Colorido / joyful**: Piedras de colores, esmaltes, resinas.
- **Sostenible / ético**: Materiales reciclados, oro certificado, lab-grown diamonds.

#### 9. Formas de llevar y tendencias de combinación
- Layering (capas de collares y pulseras)
- Mix & match de metales (oro + plata)
- Apilado de anillos y pulseras
- Asimetría en pendientes
- Piezas convertibles (collar que se convierte en pulsera, etc.)
- Joyería invisible o “second skin” (piezas muy finas que parecen parte de la piel)





### Prendas de lencería

#### 1. Sujetadores (Bras)
- **Sujetador con aros / underwire**: Estructura con aros metálicos o de plástico que eleva y da forma.
- **Sujetador sin aros / soft-cup o wireless**: Más cómodo, sin estructura rígida.
- **Sujetador push-up**: Con relleno o construcción que aumenta y acerca el pecho.
- **Sujetador balconette / balcón**: Copas horizontales que dejan la parte superior del pecho descubierta y elevan.
- **Sujetador plunge / escote profundo**: Copas que se unen muy abajo, ideal para escotes pronunciados.
- **Sujetador triangular / bralette triangular**: Forma de triángulo, normalmente sin aros y con aspecto más natural.
- **Bralette**: Sin aros, suave, a menudo con encaje o detalles decorativos. Puede ser corta o larga.
- **Sujetador deportivo / sports bra**: De compresión o encapsulación, diseñado para actividad física.
- **Sujetador strapless / sin tirantes**: Se sostiene por sí mismo, ideal para hombros descubiertos.
- **Sujetador multiway / convertible**: Tirantes intercambiables (normales, cruzados, halter, sin tirantes…).
- **Sujetador longline**: Se prolonga por debajo del pecho, a veces hasta la cintura, con efecto faja suave.
- **Sujetador maternity / de lactancia**: Con aperturas o clips para facilitar la lactancia.
- **Sujetador minimizer**: Reduce visualmente el volumen del pecho.
- **Sujetador full-coverage**: Cubre completamente el pecho, da contención máxima.
- **Sujetador demi-cup**: Cubre aproximadamente 1/2 o 3/4 del pecho.
- **Sujetador con relleno / padded**: Con espuma o relleno para dar forma y volumen.
- **Sujetador transparente o de tul**: Efecto see-through, más sensual.
- **Sujetador de encaje**: Con aplicaciones de encaje, romántico o sofisticado.
- **Sujetador bustier / corsé corto**: Estructurado, con ballenas, llega hasta debajo del pecho o a la cintura.

#### 2. Bragas y partes inferiores
- **Braga clásica / full brief**: Cubre completamente glúteos y cadera.
- **Braga de talle alto / high-waisted**: Llega por encima de la cintura, efecto faja suave.
- **Braga de talle medio**: El corte más habitual y versátil.
- **Braga de talle bajo / low-rise**: Se sitúa bajo el ombligo.
- **Culotte**: Corte intermedio entre braga clásica y shorty, cubre más la cadera.
- **Shorty / boyshort**: Estilo short, cubre completamente los glúteos con pernera corta.
- **Tangas / thong**: Parte trasera mínima en forma de T o hilo.
- **Hilo dental / G-string**: Aún más mínimo que el tanga, casi invisible.
- **Braga brasileña / Brazilian**: Cubre parcialmente los glúteos, dejando la parte inferior descubierta.
- **Braga seamless / sin costuras**: Invisible bajo la ropa, de tejido elástico continuo.
- **Braga moldeadora / shapewear brief**: Con compresión para suavizar la silueta.
- **Braga de encaje**: Decorativa, con motivos de encaje.
- **Braga abierta o crotchless**: Con abertura en la entrepierna (uso más íntimo/sensual).
- **Braga con aberturas o cut-outs**: Detalles recortados en cadera o laterales.

#### 3. Bodies y prendas de una pieza
- **Body clásico**: Une sujetador y braga en una sola prenda, con cierre en la entrepierna.
- **Body de escote pronunciado**: Plunge o escote profundo.
- **Body de espalda descubierta**: Con tirantes finos o diseño que deja la espalda libre.
- **Body de manga larga o corta**: Versiones con mangas.
- **Body tanga o brasileño**: Parte inferior en estilo tanga o brasileña.
- **Body moldeador / shapewear body**: Con zonas de compresión para definir la figura.
- **Teddy**: Similar al body pero normalmente más suelto y decorativo, a menudo con encaje.
- **Babydoll**: Camisón corto y holgado, normalmente con braga a juego, aspecto juguetón y romántico.
- **Chemise**: Camisón largo y fluido, de tejidos delicados (seda, satén, gasa).

#### 4. Corsés, bustiers y fajas
- **Corsé clásico**: Estructurado con ballenas, cierra con cordones o broches, moldea cintura y busto.
- **Overbust corset**: Cubre el pecho.
- **Underbust corset**: Se sitúa debajo del pecho.
- **Bustier**: Similar al corsé pero más corto y ligero, a menudo con aros.
- **Faja / waist cincher**: Se centra en reducir la cintura.
- **Shapewear / prendas moldeadoras**: Bodies, shorts, camisetas o fajas de compresión modernas.
- **Waspie**: Faja estrecha centrada solo en la cintura.

#### 5. Camisones, pijamas y prendas de dormir de lencería
- **Camisón largo**: Hasta la pantorrilla o el tobillo, tejidos fluidos.
- **Camisón corto**: Longitud mini o a media muslo.
- **Pijama de satén o seda**: Conjunto de camiseta + pantalón o shorts, aspecto lujoso.
- **Pijama de encaje**: Más decorativo y sensual.
- **Bata / robe de lencería**: Para cubrir el conjunto, de satén, encaje o tul.
- **Negligé**: Camisón muy ligero y transparente o semitransparente.

#### 6. Accesorios y complementos de lencería
- **Ligas / garter belt**: Cinturón con ligas para sujetar las medias.
- **Medias de lencería**: Hasta el muslo, con o sin refuerzo de silicona.
- **Pantys de lencería**: Finas, con detalles de encaje o transparencia.
- **Ligas independientes / suspender**: Se enganchan al sujetador o body.
- **Guantes largos de lencería**: De tul, satén o encaje.
- **Antifaz o accesorios decorativos**: Para sets más elaborados.
- **Tirantes decorativos o arneses**: Elementos de estilo bondage light o fashion.

#### 7. Por estilo / estética
- **Clásica / elegante**: Encaje, satén, colores neutros (negro, nude, burdeos, blanco).
- **Romántica**: Volantes, lazos, bordados florales, tonos pasteles.
- **Sensual / seductora**: Transparencias, aberturas, cortes atrevidos, rojos y negros.
- **Minimalista**: Líneas limpias, tejidos lisos, sin demasiados adornos.
- **Vintage / retro**: Inspirada en los años 40-60 (corsés, balconette, ligas clásicas).
- **Deportiva-chic**: Mezcla de bralettes deportivos con detalles de moda.
- **Shapewear moderna**: Prendas técnicas que moldean sin perder estética.
- **Bridal / de novia**: Blancos, marfiles, con encajes delicados y detalles especiales.

#### Tejidos

- Algodón
- Lino
- Seda
- Lana
- Cachemira
- Poliéster
- Nylon
- Elastano
- Acrílico
- Viscosa
- Modal
- Tencel/Lyocell
- Softshell
- Gore‑Tex
- Neopreno
- Punto
- Tejido plano
- Sarga 
- Denim 

#### Escotes

- En V
- Cuello caja
- En U
- Cuello halter
- Cuadrado
- De barca
- Asimétrico
- Palabra de honor
- de gota
- corazón
- cuello alto
- bardot
- Halter
- profundo
- cut out
- Cuello cisne 
- Cuello Perkins
- cuello camisa
- cuello pico
- cuello bebé

## Clasificaciones de la ropa

### Tipo de prenda

``txt
Top
├── T-shirt
├── Shirt
├── Blouse
├── Polo
├── Sweater
└── Hoodie

Bottom
├── Jeans
├── Trousers
├── Shorts
├── Skirt
└── ...

```

### Estilo

- Casual
- Sport
- Formal
- Business
- Streetwear
- Elegant
- Bohemian
- Vintage
- Minimalist
- Gothic
- Preppy
- Punk
- Rock
- Romantic
...

### Tags

- summer
- winter
- urban
- beach
- office
- date
- party
- travel
- comfortable
- luxury
- young
- mature
- colorful
- monochrome

### Ocasión

```txt
Occasion
├── Daily
├── Work
├── Business meeting
├── Party
├── Wedding
├── Date
├── Beach
├── Gym
├── Travel
├── Home
└── Night out
```

### Ejemplo

```txt
OUTFIT
Urban Summer #12

STYLE
Streetwear

OCCASIONS
Daily
Travel
Beach

TAGS
casual
summer
urban
young
comfortable
daytime

TOP
Oversized white T-shirt

BOTTOM
Light blue wide-leg jeans

SHOES
White sneakers

ACCESSORIES
Black sunglasses
Silver watch

COLORS
White
Light blue
Silver
Black
```

## Escenario

Bifurcación:

- Interior
- Exterior

### Tipos de edificaciones 

#### 1. Edificaciones residenciales
- **Casa unifamiliar aislada**: Vivienda independiente en parcela propia.
- **Casa adosada / pareada**: Compartida por uno o ambos laterales con otra vivienda.
- **Chalet**: Casa unifamiliar de cierta calidad, normalmente con jardín.
- **Casa de campo / rural**: Vivienda en entorno rural, adaptada al paisaje y clima local.
- **Casa de madera**: Estructura y cerramientos principalmente de madera (tronco, entramado, CLT…).
- **Casa de piedra**: Construcción tradicional con muros de carga de piedra.
- **Casa prefabricada / modular**: Fabricada en taller y montada en obra.
- **Casa pasiva / Passivhaus**: Diseñada bajo estándares de altísima eficiencia energética.
- **Casa container**: Construida a partir de contenedores marítimos reutilizados.
- **Casa cueva / troglodita**: Excavada en roca o tierra.
- **Casa flotante / houseboat**: Vivienda sobre el agua.
- **Piso / apartamento urbano**: Vivienda en edificio colectivo de varias plantas.
- **Ático**: Piso situado en la última planta, normalmente con terraza.
- **Dúplex / triplex**: Vivienda que ocupa dos o tres plantas conectadas interiormente.
- **Loft**: Espacio diáfano, normalmente de origen industrial reconvertido.
- **Estudio**: Vivienda de una sola estancia principal.
- **Penthouse**: Ático de lujo, normalmente con grandes terrazas y vistas.
- **Villa**: Residencia de alto standing, aislada y con amplios jardines.
- **Mansión**: Gran residencia de lujo, normalmente histórica o de gran tamaño.
- **Bungalow**: Casa de una sola planta, normalmente de estilo informal.
- **Cabaña / cottage**: Construcción pequeña y rústica, habitualmente en entorno natural.
- **Cortijo**: Edificación rural tradicional del sur de España, con patio y dependencias agrícolas.
- **Masía**: Casa rural tradicional catalana, normalmente de piedra y con explotaciones agrarias.
- **Pazo**: Casa solariega gallega de carácter noble.
- **Hacienda / estancia**: Gran propiedad rural de origen colonial o agrario.

#### 2. Edificaciones monumentales e históricas
- **Castillo**: Fortificación medieval con torres, murallas y foso, de carácter defensivo y residencial.
- **Alcázar**: Fortaleza de origen islámico o mudéjar, posteriormente convertida en residencia real.
- **Palacio**: Residencia de gran magnificencia destinada a la realeza, nobleza o alto clero.
- **Palacio real**: Residencia oficial de un monarca.
- **Palacete**: Versión reducida de palacio, de carácter urbano o señorial.
- **Fortaleza**: Construcción militar de gran escala diseñada para la defensa.
- **Ciudadela**: Fortaleza que protege una ciudad o forma parte de ella.
- **Torreón / torre defensiva**: Elemento aislado o integrado de carácter militar.
- **Muralla urbana**: Sistema defensivo que rodea una ciudad histórica.
- **Bastión / baluarte**: Elemento avanzado de fortificación.
- **Fuerte**: Instalación militar fortificada, normalmente costera o fronteriza.

#### 3. Edificaciones religiosas
- **Iglesia**: Templo cristiano de uso parroquial o conventual.
- **Catedral**: Iglesia principal de una diócesis, sede del obispo.
- **Basílica**: Templo de especial relevancia (por privilegio papal o por tipología).
- **Capilla**: Espacio de culto de menor tamaño, independiente o integrado.
- **Monasterio / convento**: Conjunto de edificios destinados a la vida monástica.
- **Abadía**: Monasterio dirigido por un abad o abadesa.
- **Ermita**: Pequeño templo aislado, normalmente en entorno rural o natural.
- **Mezquita**: Lugar de culto islámico.
- **Sinagoga**: Lugar de culto judío.
- **Templo**: Edificación religiosa de diversas tradiciones (hindú, budista, etc.).
- **Pagoda**: Torre religiosa de origen asiático, normalmente budista.
- **Santuario**: Lugar de peregrinación o de especial significación religiosa.

#### 4. Edificaciones públicas e institucionales
- **Ayuntamiento / casa consistorial**: Sede del gobierno municipal.
- **Palacio de justicia / juzgados**
- **Parlamento / sede legislativa**
- **Palacio de gobierno / sede del poder ejecutivo**
- **Embajada / consulado**
- **Biblioteca**
- **Museo**
- **Teatro**
- **Ópera / auditorio**
- **Centro cultural**
- **Universidad / facultad**
- **Escuela / instituto**
- **Hospital / clínica**
- **Centro de salud**
- **Estación de tren / autobuses / aeropuerto**
- **Oficina de correos**
- **Comisaría / cuartel de policía**
- **Cuartel militar**
- **Prisión / centro penitenciario**

#### 5. Edificaciones comerciales y de servicios
- **Tienda / local comercial**
- **Centro comercial / mall**
- **Galería comercial**
- **Mercado**
- **Supermercado / hipermercado**
- **Hotel**
- **Hostal / pensión**
- **Resort**
- **Restaurante**
- **Cafetería / bar**
- **Banco / oficina bancaria**
- **Oficina / edificio de oficinas**
- **Coworking**
- **Centro de convenciones**
- **Pabellón de exposiciones**

#### 6. Edificaciones industriales y logísticas
- **Nave industrial**
- **Fábrica**
- **Almacén / depósito**
- **Centro logístico**
- **Taller**
- **Garaje / aparcamiento** (puede ser independiente o integrado)
- **Estación de servicio**
- **Planta de producción energética**
- **Silo**
- **Matadero**
- **Frigorífico industrial**

#### 7. Edificaciones deportivas y de ocio
- **Estadio**
- **Pabellón deportivo**
- **Gimnasio**
- **Piscina cubierta**
- **Hipódromo**
- **Plaza de toros**
- **Parque de atracciones (edificaciones)**
- **Casino**
- **Discoteca / club**

#### 8. Edificaciones funerarias y conmemorativas
- **Cementerio (edificaciones)**
- **Panteón**
- **Mausoleo**
- **Cripta**
- **Tanatorio**
- **Monumento conmemorativo**

#### 9. Tipologías especiales y contemporáneas
- **Rascacielos / edificio en altura**
- **Torre mixta** (residencial + oficinas + hotel)
- **Edificio inteligente / smart building**
- **Edificio sostenible / green building**
- **Eco-aldea / vivienda bioclimática**
- **Arquitectura efímera / pabellón temporal**
- **Arquitectura hinchable**
- **Arquitectura subterránea**
- **Arquitectura flotante / sobre el agua**
- **Mirador**
- **Faro**
- **Molino**
- **Hórreo** (edificación tradicional de almacenamiento elevada)
- **Palafito**: Vivienda construida sobre pilotes en zonas inundables o acuáticas.

#### 10. Por sistema constructivo o material dominante
- **Estructura de hormigón armado**
- **Estructura de acero**
- **Estructura de madera (entramado, CLT, troncos)**
- **Muros de carga de fábrica (ladrillo, piedra, bloque)**
- **Construcción prefabricada / industrializada**
- **Construcción modular**
- **Arquitectura textil / tensada**
- **Arquitectura de tierra (adobe, tapial, BTC)**

### Espacios de interior

#### 1. Espacios residenciales / domésticos
- **Salón / living room**: Espacio de estar principal, ideal para looks casuales, elegantes o de lifestyle.
- **Sala de estar / sitting room**: Versión más formal o íntima del salón.
- **Comedor**: Ambiente de mesa y sillas, perfecto para campañas de ropa de invitada o evening wear.
- **Cocina**: Desde minimalista hasta rústica o industrial. Muy usada en publicidad de moda cotidiana y lifestyle.
- **Cocina abierta / office**: Integrada con el salón, muy actual.
- **Dormitorio**: Cama como protagonista. Ideal para lencería, pijamas, homewear y campañas intimistas.
- **Dormitorio principal / master bedroom**: Más amplio y sofisticado.
- **Dormitorio infantil o juvenil**
- **Vestidor / walk-in closet**: Espacio soñado para campañas de moda y lujo.
- **Baño**: Desde minimalista hasta de hotel de lujo. Muy usado en belleza y lencería.
- **Cuarto de baño con bañera exenta**: Clásico de campañas sofisticadas.
- **Aseo de cortesía**
- **Pasillo / recibidor / hall de entrada**
- **Escalera interior**: Muy fotogénica para planos dinámicos.
- **Biblioteca / estudio**: Ambiente culto y elegante.
- **Despacho / home office**
- **Sala de juegos / sala de ocio**
- **Lavadero / cuarto de plancha** (para campañas más realistas o irónicas)
- **Buhardilla / ático abuhardillado**
- **Sótano reconvertido**

#### 2. Espacios de lujo y hospitalidad
- **Suite de hotel de lujo**
- **Lobby / vestíbulo de hotel**
- **Restaurant de hotel**
- **Spa / zona de bienestar**
- **Habitación de hotel boutique**
- **Penthouse**
- **Villa privada (interiores)**
- **Casa de campo de alto standing**
- **Palacio o casa señorial (salones, galerías, dormitorios)**
- **Castillo (salones, bibliotecas, habitaciones históricas)**

#### 3. Espacios culturales y de espectáculo
- **Teatro (butacas, escenario, palcos, tramoya)**
- **Sala de conciertos / auditorio**
- **Ópera (interior)**
- **Cine (sala y foyer)**
- **Museo (salas de exposición, patios interiores cubiertos)**
- **Galería de arte**
- **Biblioteca histórica o contemporánea**
- **Sala de exposiciones**

#### 4. Espacios corporativos y profesionales
- **Sala de juntas / boardroom**
- **Oficina directiva / despacho de dirección**
- **Open space / oficina diáfana**
- **Sala de reuniones**
- **Recepción de empresa**
- **Coworking**
- **Estudio de arquitectura o diseño**
- **Taller de moda / atelier**
- **Showroom**
- **Sala de espera de lujo**

#### 5. Espacios comerciales
- **Boutique de lujo**
- **Concept store**
- **Grandes almacenes (interior)**
- **Escaparate interior / corner**
- **Probador**
- **Pop-up store**
- **Mercado gourmet (interior)**
- **Librería de diseño**

#### 6. Espacios industriales y urbanos
- **Loft industrial**
- **Nave reconvertida**
- **Fábrica abandonada (interior)**
- **Garaje**
- **Taller mecánico**
- **Almacén**
- **Estación de tren (vestíbulo, andenes cubiertos)**
- **Aeropuerto (salas VIP, terminales)**
- **Parking subterráneo**

#### 7. Espacios históricos, temáticos y de carácter
- **Mazmorra / calabozo**: Ambiente oscuro, de piedra, con cadenas y atmósfera opresiva o teatral.
- **Cripta**
- **Capilla privada / oratorio**
- **Salón de baile histórico**
- **Galería de espejos**
- **Sala de armaduras**
- **Cocina de palacio o castillo**
- **Torre (interior)**
- **Sótano abovedado**
- **Patio interior cubierto / claustro**
- **Invernadero / conservatory**
- **Orangerie**

#### 8. Espacios de ocio y nightlife
- **Discoteca / club (interior)**
- **Bar de cócteles / speakeasy**
- **Casino (salas)**
- **Sala de billar**
- **Bowling (interior)**
- **Sala de cine privada**
- **Gimnasio de lujo**
- **Piscina interior / indoor pool**

#### 9. Espacios institucionales y públicos
- **Aula magna / salón de actos**
- **Juzgado (sala de vistas)**
- **Ayuntamiento (salón de plenos)**
- **Hospital (zonas nobles o modernas)**
- **Iglesia o catedral (interior)**
- **Sinagoga o mezquita (interior)**

#### 10. Espacios singulares y creativos para publicidad de moda
- **Estudio fotográfico neutro (cyclorama, fondo infinito)**
- **Estudio con luz natural lateral**
- **Contenedor reconvertido**
- **Casa-espejo / mirrored room**
- **Sala completamente blanca o negra**
- **Espacio con techos muy altos y vigas vistas**
- **Habitación con papel pintado impactante**
- **Baño de mármol y latón**
- **Cocina de acero inoxidable y diseño radical**
- **Dormitorio con dosel o cama a dosalturas**
- **Biblioteca de suelo a techo**
- **Invernadero lleno de plantas tropicales**
- **Sala con chimenea monumental**
- **Pasillo de espejos enfrentados**
- **Ascensor de lujo o histórico**
- **Azotea cubierta / rooftop lounge interior**

#### 11. Ambientes según atmósfera (útil para dirección de arte)
- **Minimalista / contemporáneo**
- **Clásico / señorial**
- **Industrial / raw**
- **Rústico / rural**
- **Barroco / maximalista**
- **Futurista / high-tech**
- **Oscuro / dramático (mazmorras, sótanos, clubs)**
- **Luminoso / etéreo**
- **Cálido / acogedor**
- **Frío / sofisticado**
- **Decadente / vintage**
- **Onírico / surrealista**

### Espacios exteriores

#### 1. Espacios urbanos
- **Calle de ciudad contemporánea**: Asfalto, aceras, fachadas modernas.
- **Calle histórica / casco antiguo**: Empedrado, edificios de piedra, farolas clásicas.
- **Avenida ancha con tráfico**
- **Calle peatonal / zona comercial**
- **Plaza urbana**: Con fuentes, bancos, estatuas o arquitectura representativa.
- **Plaza mayor histórica**
- **Callejón / callejuela estrecha**
- **Pasaje cubierto o galería comercial exterior**
- **Escaleras urbanas (públicas o monumentales)**
- **Puente urbano (moderno o histórico)**
- **Azotea / rooftop con vistas a la ciudad**
- **Terraza de edificio alto**
- **Balcón urbano**
- **Parking en azotea / rooftop parking**
- **Estación de tren o metro (exterior)**
- **Parada de autobús o taxi**
- **Semáforo y paso de peatones** (muy usado en campañas street)
- **Muro de hormigón o ladrillo con grafitis**
- **Solar vacío / solar en obras**
- **Andamio y zona de construcción**

#### 2. Espacios naturales
- **Playa de arena fina**
- **Playa de rocas / cala**
- **Dunas**
- **Acantilado / precipicio frente al mar**
- **Costa rocosa**
- **Bosque denso**
- **Bosque de ribera**
- **Claro de bosque**
- **Campo abierto / pradera**
- **Campo de trigo o cereal**
- **Campo de lavanda u otras flores**
- **Viñedo**
- **Olivar**
- **Montaña / paisaje alpino**
- **Valle**
- **Lago / laguna**
- **Río y orillas**
- **Cascada**
- **Desierto de arena**
- **Desierto de piedra / hamada**
- **Tundra o paisaje frío**
- **Marisma / humedal**
- **Jardín botánico (zonas exteriores)**
- **Parque natural**

#### 3. Espacios ajardinados y de ocio
- **Parque urbano clásico** (con bancos, fuentes y paseos)
- **Parque contemporáneo de diseño**
- **Jardín francés / formal**
- **Jardín inglés / paisajista**
- **Jardín japonés**
- **Jardín mediterráneo**
- **Jardín de esculturas**
- **Rosaleda**
- **Invernadero exterior o orangerie vista desde fuera**
- **Huerto urbano o rural**
- **Patio de vecinos / corrala**
- **Patio andaluz con vegetación**
- **Terraza ajardinada**
- **Piscina exterior (de villa, hotel o comunitaria)**
- **Zona de tumbonas y daybeds**
- **Pista de tenis exterior**
- **Campo de golf (green, fairway, clubhouse exterior)**

#### 4. Espacios históricos y monumentales
- **Castillo (exteriores, murallas, patio de armas)**
- **Palacio (fachada, jardines, patios)**
- **Ruinas arqueológicas**
- **Anfiteatro romano o griego**
- **Acueducto**
- **Muralla medieval**
- **Fortaleza / alcázar (exteriores)**
- **Iglesia o catedral (atrio, escalinata, ábside)**
- **Claustro (visto desde el exterior o patio)**
- **Cementerio histórico (con respeto y permiso)**
- **Puente histórico de piedra**
- **Faro**
- **Molino de viento o de agua**
- **Hacienda o cortijo (exteriores)**

#### 5. Espacios industriales y periurbanos
- **Zona industrial / polígono**
- **Nave industrial (exterior)**
- **Chimenea de fábrica**
- **Vías de tren y andenes exteriores**
- **Puente de ferrocarril**
- **Puerto / dársena**
- **Muelle y grúas**
- **Astillero**
- **Depósito de contenedores**
- **Gasolinera**
- **Autopista y áreas de servicio**
- **Aeropuerto (pistas vistas desde fuera, terminal exterior)**
- **Helipuerto**

#### 6. Espacios de transporte y movilidad
- **Carretera secundaria o de montaña**
- **Camino de tierra / pista forestal**
- **Autopista (arcén o mirador)**
- **Túnel (boca de entrada)**
- **Puente moderno de gran luz**
- **Puerto deportivo / marina**
- **Muelle de madera**
- **Embarcadero**

#### 7. Espacios de ocio y hospitality exteriores
- **Terraza de restaurante o café**
- **Chiringuito de playa**
- **Hotel boutique (exteriores y jardines)**
- **Resort (zonas comunes exteriores)**
- **Camping de lujo / glamping**
- **Festival (escenarios y zonas exteriores)**
- **Mercadillo al aire libre**
- **Feria o recinto ferial**

#### 8. Espacios singulares y de alto impacto visual
- **Desierto con cielo limpio**
- **Campo de energía eólica (molinos)**
- **Campo de paneles solares**
- **Cantera**
- **Mina a cielo abierto (con permisos)**
- **Glaciar o zona de alta montaña nevada**
- **Volcán (zonas seguras)**
- **Cueva con boca exterior amplia**
- **Arco natural de roca**
- **Playa negra o de arena volcánica**
- **Lago salado / desierto de sal**
- **Campo de flores silvestres en máxima floración**
- **Calle completamente vacía al amanecer o atardecer**
- **Ciudad bajo la lluvia o con suelo mojado (reflejos)**
- **Niebla densa en bosque o montaña**
- **Atardecer en azotea con skyline**
- **Amanecer en la playa desierta**

#### 9. Ambientes según atmósfera (dirección de arte)
- **Urbano contemporáneo limpio**
- **Urbano sucio / raw / street**
- **Histórico / monumental**
- **Natural salvaje**
- **Natural domesticado (jardines)**
- **Industrial / periurbano**
- **Lujoso / hospitality**
- **Minimalista (desierto, sal, nieve, hormigón)**
- **Romántico (bosque, jardín, atardecer)**
- **Dramático (acantilados, tormentas, ruinas)**
- **Onírico / surrealista**
- **Cinematográfico (carreteras infinitas, gasolineras aisladas)**









## Iluminación

#### 1. Esquemas y Técnicas de Iluminación para Interior (Plató / Sets)

En interiores buscamos el control absoluto de la luz, creando la atmósfera, la profundidad y el volumen adecuados para la cámara.

##### A. Esquemas de Dirección y Función (Trifocal y Avanzada)
* **Luz Principal (Key Light):** La fuente primaria que define la exposición general, la dirección del volumen y la sombra principal del sujeto.
* **Luz de Relleno (Fill Light):** Fuente suave (generalmente rebotada o difuminada) encargada de matizar las sombras de la *Key Light* para controlar el contraste (ratio de iluminación).
* **Luz de Contra / Contraluz (Backlight / Kicker):** Situada detrás del sujeto para perfilar los hombros y la cabeza, separándolo del fondo y generando tridimensionalidad.
* **Luz de Fondo (Background Light):** Ilumina de forma independiente la escenografía o paredes para crear textura, profundidad y separación visual.
* **Luz de Efecto / Practicals:** Lámparas, flexos o elementos visibles dentro de plano que aportan verosimilitud a la escena.

##### B. Técnicas según la Calidad y el Contraste
* **Luz Dura (Hard Light):** Sombras muy definidas y bordes marcados. Aporta dramatismo, textura y tensión. (Uso de focos fresnel, snoots o reflectores pulidos).
* **Luz Suave / Difusa (Soft Light):** Sombras muy matizadas, bordes suaves y transiciones progresivas. Ideal para belleza (*beauty*) y publicidad de producto. (Uso de octaboxes, mariposas con tela difusora o rebotes en porexpan/grid cloth).
* **Claro-Oscuro / Chiaroscuro (Low Key):** Predominio de tonos oscuros y sombras intensas con un ratio de contraste muy alto.
* **Clave Alta (High Key):** Escenas hiperiluminadas, con bajísimo contraste, casi sin sombras. Muy usada en publicidad corporativa, productos de higiene y belleza.
* **Iluminación Rembrandt:** Esquema donde la luz principal crea un triángulo de luz característico en la mejilla del lado en sombra.

---

#### 2. Esquemas y Técnicas de Iluminación para Exterior (Luz Natural y Mixta)

En exteriores no controlamos la fuente principal (el Sol), por lo que el trabajo del gaffer consiste en tamizar, rebotar, bloquear o complementar esa luz natural con fuentes artificiales potente (como luces HMI o LEDs de alto wattage).

##### A. Según la Posición y Hora del Sol (Luz Natural)
* **Luz de Mediodía (Sol cenital):** Luz extremadamente dura, vertical y cenital. Genera sombras marcadas bajo los ojos y la nariz (sombra de "mapache"). Se requiere el uso de *pamelas* o mariposas difusoras (*overhead*).
* **Hora Dorada (Golden Hour):** Justo tras el amanecer o antes del atardecer. Luz cálida, suave, muy rasante y con sombras largas.
* **Hora Azul (Blue Hour):** Momento justo antes del amanecer o tras el atardecer. Temperatura de color muy fría (azulada) con escasa luz residual en el cielo.
* **Día Nublado (Difusor Natural):** Las nubes actúan como una gran caja de luz (*softbox* natural), ofreciendo iluminación uniforme sin sombras duras.

##### B. Técnicas de Control y Apoyo en Exteriores
* **Sun Scrim / Difusión Overhead:** Colocación de bastidores gigantes con telas difusoras (*grid cloth*, seda) suspendidos entre la luz del sol y el actor para suavizar la luz directa.
* **Contraluz Natural + Relleno (Backlit + Fill):** Colocar al sol por detrás del sujeto como contra natural (*rim light*) e iluminar el rostro por delante usando rebotadores (dorados, plateados o blancos) o un foco de relleno artificial (HMI / LED HMI replacement).
* **Negativo / Relleno Negativo (Negative Fill):** Uso de telas o paneles negros (*palios* o *floppies*) para bloquear el rebote indeseado de luz en exteriores y generar sombras donde la luz natural es demasiado envolvente.
* **Day for Night (Noche por Día):** Técnica cinematográfica para rodar de día simulando la noche mediante subexposición, filtrado azul (temperatura de color fría) y contraste alto.

## Colores

- Rojo
- Azul
- Amarillo
- Naranja
- Morado 
- Violeta
- Rosa
- Marrón 
- Pardo
- Negro
- Blanco
- Gris
- Celeste
- Turquesa
- Dorado
- Plateado
- Beige

O, mejor aún, como entidades:

## Saturación
- apagado 
- normal 
- intenso

## Acabado
- mate 
- brillante 
- satinado 
- metalizado

## Luminosidad
- oscuro 
- medio 
- claro

```txt 
Color
├── Nombre ES
├── Nombre EN
├── HEX
├── Familia
├── Luminosidad
├── Saturación
└── Etiquetas
```

## Cámara

### Tipo de plano
- Extreme close-up
- Close-up
- Headshot
- Bust shot
- Medium shot
- Medium full shot
- Full body
- Wide shot
### Ángulo
- Eye level
- Low angle
- High angle
- Bird's-eye view
- Worm's-eye view
- Dutch angle
### Distancia
- Close
- Medium
- Far
### Lente

- 24mm
- 35mm
- 50mm
- 85mm
- 105mm
- 135mm

## Reglas de contexto

Con:

- Weights -> Probabilidad.
- Constraints -> Restricciones.
- Dependencies -> Dependencias.
- Preferences -> Preferencias.
- Exclusions -> Exclusiones.

Las reglas deberían ser datos, no código, para evitar:

```php
if ($environment === 'beach') {
    ...
}
```

Mejor `rules` en base de datos.

Conceptualmente:

```txt
Rule
├── name
├── conditions
├── actions
├── priority
├── weight
└── active
```

Y:

```JSON
{
    "conditions": [
        {
            "attribute": "environment",
            "operator": "equals",
            "value": "beach"
        }
    ],
    "actions": [
        {
            "type": "increase_weight",
            "attribute": "clothing_style",
            "value": "summer",
            "amount": 50
        }
    ]
}
```

## Flujo de trabajo

```txt
┌──────────────────────────────────────────────┐
│              HUMAN IMAGES PROMPTS            │
├──────────────────────────────────────────────┤
│                                              │
│ PERSONAJE                                    │
│ ├─ Sexo                                      │
│ ├─ Edad                                      │
│ ├─ Apariencia / etnia                        │
│ └─ Características físicas                   │
│                                              │
│ CABEZA                                       │
│ ├─ Pelo                                      │
│ ├─ Ojos                                      │
│ ├─ Vello facial                              │
│ ├─ Labios                                    │
│ └─ ...                                       │
│                                              │
│ POSE                                         │
│ ├─ General                                   │
│ ├─ Cabeza                                    │
│ ├─ Hombros                                   │
│ ├─ Brazos                                    │
│ └─ Piernas                                   │
│                                              │
│ ROPA                                         │
│ ├─ Prenda superior                           │
│ ├─ Prenda inferior                           │
│ ├─ Complementos                              │
│ └─ Colores / intensidad                      │
│                                              │
│ ESCENARIO                                    │
│ ├─ Interior / Exterior                       │
│ ├─ Lugar                                     │
│ ├─ Momento del día                           │
│ └─ Iluminación                               │
│                                              │
│ [ GENERAR ALEATORIO ] [ GENERAR PROMPT ]     │
│                                              │
├──────────────────────────────────────────────┤
│ PROMPT                                       │
│                                              │
│ A 32-year-old man with...                    │
│                                              │
│ [Copiar] [Guardar] [Regenerar]               │
└──────────────────────────────────────────────┘
``` 

## Separación en concptos

### Atributos

Son las piezas básicas:

- Hair
- Eyes
- Skin
- Clothing
- Shoes
- Pose
- Lighting
- Environment
- Colors
...

Cada atributo tiene valores. Por ejemplo:

- hair_color
    - black
    - dark_brown
    - brown
    - light_brown
    - dark_blonde
    - blonde
    - light_blonde
    - red
    - gray
    - white

Cada atributo tendía dos valores:

Español: Rubio oscuro -> Para el front
Inglés: Dark blonde -> Para el prompt

```PHP
name_es = "Rubio oscuro"
name_en = "Dark blonde"
```

Incluso tres valores:

```txt
name_es:
"Rubio ceniza"

name_en:
"Ash blonde"

prompt_en:
"long ash-blonde wavy hair"

```

### Composiciones

Una composición sería un personaje completo.

Por ejemplo:

```txt
Personaje #001

Nombre: María García
Sexo: Mujer
Edad: 27
Piel: Clara
Pelo: Rubio oscuro
Ojos: Verde
...
```

Se pueden guardar para reutilizar más veces.

### Bibliotecas

Aquí guardamos elementos reutilizables:

- poses
- personajes
- outfits
- escenarios
- estilos fotográficos
- iluminaciones
- expresiones
- accesorios

Por ejemplo:

```txt

Outfit:
"Casual urbano de verano"

Prenda superior:
camiseta blanca oversize

Prenda inferior:
jeans azul claro

Calzado:
zapatillas blancas

Accesorios:
gafas de sol

Colores:
blanco + azul + gris
```

O en JSON:

```json
{
    "name": "Urban Summer #12",

    "styles": [
        "casual",
        "streetwear"
    ],

    "occasions": [
        "daily",
        "travel"
    ],

    "tags": [
        "summer",
        "urban",
        "young",
        "comfortable"
    ],

    "items": {
        "top": "oversized_white_tshirt",
        "bottom": "light_blue_wide_leg_jeans",
        "shoes": "white_sneakers"
    },

    "colors": [
        "white",
        "light_blue",
        "black",
        "silver"
    ]
}
```

Luego el generador puede utilizar ese outfit directamente.

### Plantillas de prompt

El traductor de todos esos datos a lenguaje natural.

Por ejemplo:

```txt
{{age}}-year-old {{gender}},
{{skin_description}},
{{hair_description}},
{{eye_description}},
wearing {{outfit}},
{{pose}},
in {{environment}},
{{lighting}},
{{style}}
```

Para mostrarlo al usuario. 

Para guardarlos, mejor como JSON:

```json
{
    "gender": "female",
    "age": 27,
    "skin": {
        "tone": "light",
        "undertone": "warm"
    },
    "hair": {
        "color": "dark_blonde",
        "length": "long",
        "type": "wavy"
    },
    "eyes": {
        "color": "green"
    },
    "pose": {
        "body": "standing",
        "head": "looking_at_camera",
        "arms": "crossed"
    },
    "outfit": "urban_casual_12",
    "environment": "coffee_shop",
    "lighting": "natural_window_light"
}
```

Así se pueden modificar a mano sólo algunos valores. 

## Interfaz web

### Bloques colapsables
- Personaje
- Cabeza
- Pose
- Ropa
- Escenario
- Colores

Con "modo manual" / "modo aleatorio":

- Manual: el usuario elige cada atributo.
- Aleatorio: el sistema rellena todo según reglas y rarezas.

Guardado en biblioteca:

Botones tipo: `[Guardar personaje]`, `[Guardar outfit]`, `[Guardar pose]`.

### Vistas

Vista de JSON + vista de prompt:

Panel con JSON editable.

Panel con prompt generado en tiempo real.

### Selectores

```txt
┌──────────────────────────────────────┐
│ OUTFIT                               │
├──────────────────────────────────────┤
│                                      │
│ Estilo                               │
│ [ Casual ▼ ]                         │
│                                      │
│ Ocasión                              │
│ [ + Añadir ]                         │
│                                      │
│ Tags preferidos                      │
│ [ summer ] [ urban ] [ comfortable ] │
│                                      │
│ Tags excluidos                       │
│ [ formal ]                           │
│                                      │
│ Colores                              │
│ [ Azul ] [ Blanco ]                  │
│                                      │
│ 🎲 Generar                           │
└──────────────────────────────────────┘
```

Se podrían elegir distintos estilos:

```txt
styles:
    casual
    streetwear
```

# DDD

## Contextos delimitados (Bounded Contexts)

### Character Context  
Personaje, atributos físicos, piel, pelo, ojos, edad, sexo.

### Pose Context  
Poses corporales, cabeza, brazos, piernas, reglas de combinación.

### Outfit Context  
Prendas, estilos, colores, tejidos, escotes, accesorios.

### Color Context  
Color como entidad compleja con saturación, luminosidad, acabado, familia.

### Environment Context  
Interior/exterior, lugar, iluminación, momento del día.

### Prompt Context  
Plantillas, traducción ES→EN, composición final del prompt.

### Composition Context

Responsable de combinar:

- Character
- Pose
- Outfit
- Environment
- Lighting
- Style
- Camera
- Expression

Cada uno puede tener su propio modelo, repositorios y servicios.

## Entidades (tienen identidad):

- Character
- Outfit
- Pose
- Environment
- Lighting
- Style
- ClothingItem
- Accessory
- ColorDefinition
- PromptTemplate
- Composition
- Rule

## Value Objects (no tienen identidad, solo valor):

- Age
- Gender
- SkinTone
- HairColor
- HairLength
- HairType
- EyeColor
- EyeShape
- SkinTone
- Color
- RGB
- HexColor
- LightingType
- ClothingItem
- PoseBody 
- PoseHead 
- PoseArms 
- PoseLegs
- Weight
- Probability

Los value objects son perfectos en este sistema porque:

- Son inmutables.
- Se pueden combinar.
- Se pueden reutilizar.
- Se pueden extender sin romper nada.

## Servicios de dominio

Estos servicios no dependen de Laravel, solo del dominio.

### CharacterGeneratorService  
Genera personajes aleatorios según reglas, rarezas y dependencias.

### PoseGeneratorService  
Combina poses según restricciones.

### OutfitGeneratorService  
Filtra por estilo, clima, sexo, colores, tejidos.

### ColorGeneratorService  
Genera colores con saturación, luminosidad y acabado.

### PromptBuilderService  
Traduce entidades y value objects a lenguaje natural.

## Agregados

Un agregado es un conjunto de entidades y value objects que se comportan como una unidad.

### CharacterAggregate
- Character
- Hair
- Eyes
- Skin


### OutfitAggregate
- Style
- Top
- Bottom
- Outer layer
- Shoes
- Accessories
- Colors

### PoseAggregate
- Body
- Head
- Arms
- Legs

## Repositorios

Cada agregado tiene su repositorio:

- CharacterRepository
- PoseRepository
- OutfitRepository
- ColorRepository
- EnvironmentRepository

Estos repositorios pueden estar implementados en Laravel (Eloquent), pero el dominio no depende de ellos.

## Factories

Las factories son perfectas para el sistema ya que se encargan de construir entidades completas a partir de value objects.

- CharacterFactory
- PoseFactory
- OutfitFactory
- ColorFactory

## Lenguaje ubicuo (Ubiquitous Language)

