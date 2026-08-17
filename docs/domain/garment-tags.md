# Taxonomía de Tags para Prendas (Garment)

## Convención
Todos los tags usan namespace `category:value` (snake_case para valores).

## Namespaces y Valores Canónicos

### `gender:` — Género al que va dirigida la prenda
- `gender:female` — Mujer
- `gender:male` — Hombre
- `gender:unisex` — Unisex / ambas

### `season:` — Estación óptima
- `season:spring` — Primavera
- `season:summer` — Verano
- `season:autumn` — Otoño
- `season:winter` — Invierno

### `weather:` — Condiciones climáticas adecuadas
- `weather:hot` — Calor intenso (>28°C)
- `weather:warm` — Cálido (20-28°C)
- `weather:mild` — Templado (12-20°C)
- `weather:cool` — Fresco (5-12°C)
- `weather:cold` — Frío (<5°C)
- `weather:rain` — Lluvia
- `weather:snow` — Nieve
- `weather:wind` — Viento fuerte

### `occasion:` — Ocasíon / estilo de uso
- `occasion:casual` — Uso diario informal
- `occasion:formal` — Eventos formales (boda, gala)
- `occasion:business` — Entorno laboral / oficina
- `occasion:street` — Streetwear / urbano
- `occasion:sport` — Actividad deportiva
- `occasion:elegant` — Elegante / noche
- `occasion:beach` — Playa / piscina
- `occasion:evening` — Salida nocturna
- `occasion:period` — Traje histórico / época

### `environment:` — Entorno de la sesión
- `environment:urban` — Ciudad / calles
- `environment:nature` — Naturaleza / exteriores
- `environment:studio` — Estudio fotográfico
- `environment:indoor` — Interiores (no estudio)
- `environment:outdoor` — Exteriores genéricos

## Uso en Generador de Outfits

El generador contextual (`useRandom.ts` → `randomOutfit()`) deriva tags de contexto:
- `character.gender` → `gender:female|male|unisex`
- `time.season` → `season:...`
- `time.weather` + `time.time_of_day` → `weather:...`
- `scene.environment_type` → `environment:...`

Y filtra prendas por **AND** de todos los tags aplicables. Fallback: si no hay candidatos, ignora tags.

## Validación (Suave)

En `GarmentController::fill()` y `OutfitController::fill()` se loggea warning si un tag no sigue la convención `namespace:value` con valores canónicos. No bloquea la creación.

## Ejemplos

```json
// Camiseta básica unisex verano
{
  "name": "Camiseta blanca algodón",
  "category": "TOP",
  "tags": ["gender:unisex", "season:summer", "weather:hot", "occasion:casual", "environment:urban"]
}

// Abrigo de lana invierno formal
{
  "name": "Abrigo lana camel",
  "category": "TOP",
  "tags": ["gender:female", "season:winter", "weather:cold", "occasion:formal", "environment:urban"]
}

// Bañador playa
{
  "name": "Bañador estampado",
  "category": "BOTTOM",
  "tags": ["gender:male", "season:summer", "weather:hot", "occasion:beach", "environment:outdoor"]
}
```