## Context

**Estado actual:**
- `README.md` líneas 303-305 declaran licencia como "Proprietary / Private project. All rights reserved.".
- No existe fichero `LICENSE` en la raíz del repositorio.
- Usuario quiere Apache License 2.0 con copyright **Aton Soluciones Tecnológicas, SL** (año 2026).

## Goals / Non-Goals

**Goals:**
1. Crear `LICENSE` en la raíz con el texto completo oficial de Apache License 2.0 + cabecera de copyright.
2. Actualizar sección License del `README.md` para referenciar Apache-2.0 y enlazar a `LICENSE`.
3. Mantener `frontend/README.md` intacto (no tiene sección de licencia).

**Non-Goals:**
- Cambiar licencias de dependencias (npm, composer) ni añadir headers a cada fichero fuente.
- Añadir badges SPDX (opcional, no requerido).

## Decisions

### 1. Texto completo canónico de Apache-2.0 en `LICENSE`
**Por qué:** Es la práctica estándar en proyectos open source. El texto oficial de https://www.apache.org/licenses/LICENSE-2.0 incluye los términos legales completos, y la cabecera `Copyright 2026 Aton Soluciones Tecnológicas, SL` identifica al titular.
**Alternativa:** Solo referencia a SPDX (`Apache-2.0`) sin texto completo → rechazada por no ser autosuficiente para distribución.

### 2. Cabecera de copyright: `Copyright 2026 Aton Soluciones Tecnológicas, SL`
**Por qué:** Año actual (2026), entidad legal especificada por el usuario. Sin "©" ni "All rights reserved" (el texto Apache ya cubre la reserva de derechos).

### 3. README: sección License → nota breve + enlace a LICENSE
**Diseño elegido:**
```markdown
## 📄 License / Licencia

Apache License 2.0 — see [`LICENSE`](LICENSE) for full text.

Copyright 2026 Aton Soluciones Tecnológicas, SL.
```
Reemplaza las dos líneas actuales ("Proprietary / Private project. All rights reserved.") manteniendo el encabezado `## 📄 License / Licencia`.

### 4. `frontend/README.md` sin cambios
**Por qué:** No tiene sección de licencia. No se añade para no duplicar información.