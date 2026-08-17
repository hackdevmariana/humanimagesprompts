## Why

El `README.md` actual declara la licencia como "Proprietary / Private project. All rights reserved." El usuario quiere cambiar a **Apache License 2.0** con el titular del copyright **Aton Soluciones Tecnológicas, SL** (año 2026).

## What Changes

- Crear fichero `LICENSE` en la raíz del repositorio con el texto completo canónico de **Apache License 2.0** (versión oficial de https://www.apache.org/licenses/LICENSE-2.0) precedido por la cabecera de copyright: `Copyright 2026 Aton Soluciones Tecnológicas, SL`.
- Actualizar la sección **License / Licencia** del `README.md` (líneas 303-305) para indicar "Apache License 2.0" y enlazar al fichero `LICENSE` del repositorio.
- `frontend/README.md` no tiene sección de licencia → sin cambios.

## Capabilities

### New Capabilities
- `project-license`: Licencia Apache-2.0 declarada en el proyecto con fichero `LICENSE` estándar y referencia en README.

## Impact

- **Repo root**: Nuevo fichero `LICENSE` (texto completo Apache-2.0 + copyright).
- **README.md**: Sección License actualizada (reemplaza "Proprietary / Private project").
- **Frontend/Backend/API/DB**: Sin cambios.
- **Tests/Calidad**: Sin impacto.