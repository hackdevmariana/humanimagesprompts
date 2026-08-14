# Esquema del JSON Canónico de Prompt (Canonical Prompt Schema)

El **Canonical Prompt Schema** es la representación neutra, estructurada y desacoplada de todo el estado resuelto de un personaje, vestuario, pose, escena y mutaciones dentro de una composición.

---

## 1. Propósito y Flujo de Datos

```txt
[Composer Context] ---> Compila ---> [CanonicalPrompt (JSON v1.0.0)] ---> [Translation Context / Gem] ---> Genera ---> [Output: Midjourney / Flux / SDXL]
```

* **Estabilidad del Dominio:** Si las sintaxis o parámetros de Midjourney o Flux cambian en el futuro, el esquema canónico **permanece inalterado**. Solo se actualiza el prompt de la Gem o el adaptador de traducción.
* **Trazabilidad Total:** Incluye metadatos de versión, marca de tiempo y el historial de mutaciones aplicadas en caliente.

---

## 2. Estructura JSON Específica (Ejemplo Completo Resuelto)

```json
{
  "$schema": "[https://humanimagesprompts.com/schemas/v1/canonical-prompt.json](https://humanimagesprompts.com/schemas/v1/canonical-prompt.json)",
  "meta": {
    "schema_version": "1.0.0",
    "composition_id": "9b1deb4d-3b7d-4bad-9bdd-2b0d7b3dcb6d",
    "compiled_at": "2026-08-14T14:30:00Z",
    "target_model_hint": "FLUX_1_DEV"
  },
  "character": {
    "id": "a3f1c2d0-8e4b-4f9a-9123-bc4567890123",
    "demographics": {
      "gender": "FEMALE",
      "age": 26,
      "ethnicity": "CAUCASIAN"
    },
    "cranial_morphology": {
      "cranial_shape": "MESOCEPHALIC",
      "facial_structure": "OVAL",
      "jawline_definition": "SOFT",
      "cheekbones": "HIGH_PROMINENT",
      "ear_morphology": "ATTACHED_LOBE"
    },
    "skin_profile": {
      "fitzpatrick_scale": "TYPE_II",
      "undertone": "WARM_GOLDEN",
      "finish": "DEWY",
      "imperfections": [
        "FRECKLES",
        "MOLES"
      ],
      "freckle_density": "SPARSE"
    },
    "hair_profile": {
      "andre_walker_type": "TYPE_2A",
      "density": "MEDIUM",
      "porosity": "MEDIUM",
      "hairline": "STRAIGHT"
    },
    "eye_profile": {
      "primary_color": "GREEN",
      "secondary_color": null,
      "heterochromia_type": "NONE",
      "eye_shape": "ALMOND",
      "eyelash_details": "LONG_DENSE"
    },
    "grooming": {
      "hairstyle_name": "Ondas Surferas Despeinadas",
      "hair_length": "LONG",
      "hair_color_primary": {
        "color_name": "Warm Honey Blonde",
        "hex_code": "#E6C687"
      },
      "hair_color_secondary": null,
      "hair_finish": "STYLED",
      "facial_hair_style": "CLEAN_SHAVEN",
      "facial_hair_color": null
    },
    "makeup": {
      "style_name": "No-Makeup Natural Glow",
      "lipstick": {
        "color": {
          "color_name": "Nude Rose",
          "hex_code": "#D8A399"
        },
        "finish": "SATIN"
      },
      "eyeshadow": null,
      "eyeliner": null,
      "blush_and_contour": {
        "definition": "SOFT",
        "intensity": 3
      },
      "nails": {
        "length": "SHORT",
        "shape": "ROUND",
        "color": {
          "color_name": "Clear Gloss",
          "hex_code": "#F9F9F9"
        }
      }
    }
  },
  "outfit": {
    "id": "b7891011-c121-3141-5161-718192021222",
    "style_category": "CASUAL",
    "layers": [
      {
        "slot": "BASE_LAYER",
        "garment": {
          "id": "c1111111-2222-3333-4444-555555555555",
          "name": "Camiseta Algodón Orgánico Básica",
          "category": "TOP",
          "sub_category": "T-Shirt",
          "fit": "REGULAR",
          "fabric": {
            "material": "COTTON",
            "weave": "KNITTED",
            "weight": "LIGHTWEIGHT",
            "sheerness": "OPAQUE"
          },
          "primary_color": {
            "color_name": "Off-White",
            "hex_code": "#F4F4F0"
          },
          "secondary_color": null,
          "pattern": "SOLID"
        }
      },
      {
        "slot": "OUTER_LAYER",
        "garment": {
          "id": "d2222222-3333-4444-5555-666666666666",
          "name": "Chaqueta Denim Vintage Gastada",
          "category": "TOP",
          "sub_category": "Denim Jacket",
          "fit": "OVERSIZED",
          "fabric": {
            "material": "DENIM",
            "weave": "TWILL",
            "weight": "HEAVYWEIGHT",
            "sheerness": "OPAQUE"
          },
          "primary_color": {
            "color_name": "Washed Indigo Blue",
            "hex_code": "#3B5998"
          },
          "secondary_color": null,
          "pattern": "SOLID"
        }
      }
    ]
  },
  "pose": {
    "id": "e3333333-4444-5555-6666-777777777777",
    "category": "HIGH_FASHION",
    "body_language": "De pie, cuerpo inclinado ligeramente hacia atrás con una mano sostenida en la solapa de la chaqueta.",
    "facial_expression": "SERIOUS_LOOK",
    "expression_intensity": 6,
    "required_framing": "MEDIUM_SHOT"
  },
  "scene": {
    "id": "f4444444-5555-6666-7777-888888888888",
    "environment_type": "URBAN",
    "location_details": "Calle peatonal en el Soho de Nueva York con fachadas de ladrillo visto al fondo fuera de foco.",
    "lighting": {
      "setup_type": "GOLDEN_HOUR",
      "color_temperature": "WARM_2700K",
      "key_light_direction": "SIDE_45",
      "hardness": "SOFT_DIFFUSED"
    },
    "camera_and_lens": {
      "focal_length": "LENS_85MM_PORTRAIT",
      "aperture": "F_1_8",
      "depth_of_field": "SHALLOW_BOKEH",
      "film_grain": "SUBTLE_35MM",
      "camera_angle": "EYE_LEVEL"
    }
  },
  "applied_overrides": [
    {
      "target_path": "character.grooming.hair_finish",
      "original_value": "MATTE",
      "overridden_value": "STYLED",
      "reason": "Ajuste puntual para dar efecto despeinado en la composición actual"
    }
  ]
}

```

3. Contrato para el Prompt de la Gem (LLM Adaptor Prompt System)

Cuando esta estructura JSON es enviada a la Gem de traducción, el System Prompt de la Gem utiliza la siguiente directriz de procesamiento:

```txt
Eres un experto en Prompt Engineering para modelos de difusión de IA (Midjourney v6, Flux.1, Stable Diffusion XL).

Tu función es recibir un documento JSON "Canonical Prompt Schema" y compilarlo en un prompt descriptivo en lenguaje natural optimizado para el motor solicitado.

Reglas de compilación:
1. Extrae los detalles anatómicos y de piel del sujeto [character] e intégralos sin usar jerga médica cruda, traduciéndolos a descripciones fotográficas naturales (ej: "MESOCEPHALIC" + "TYPE_II" -> "A natural oval face with fair skin").
2. Traduce los materiales de ropa [outfit.layers.fabric] priorizando sensaciones táctiles y de iluminación (ej: "HEAVYWEIGHT DENIM" -> "rigid washed indigo denim jacket with visible twill texture").
3. Asigna los parámetros ópticos [scene.camera_and_lens] a especificaciones de fotografía profesional (ej: "LENS_85MM_PORTRAIT", "F_1_8" -> "Shot on 85mm lens, f/1.8 aperture, beautiful shallow depth of field, cream bokeh background").
4. Formatea la salida respetando el modelo destino seleccionado (ej: para Midjourney añade parámetros al final como `--ar 16:9 --style raw --v 6.0`).
``` 
