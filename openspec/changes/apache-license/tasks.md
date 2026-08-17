## 1. Repo root — Create LICENSE file

- [ ] 1.1 Crear `LICENSE` en la raíz del repositorio con:
    - Primera línea: `Copyright 2026 Aton Soluciones Tecnológicas, SL`
    - Texto completo oficial de Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
- [ ] 1.2 Verificar: `head -5 LICENSE` muestra copyright + inicio de la licencia.
- [ ] 1.3 Commit único del fichero `LICENSE`.

## 2. Repo root — Update README.md license section

- [ ] 2.1 Editar `README.md` líneas 303-305 (sección `## 📄 License / Licencia`): reemplazar "Proprietary / Private project. All rights reserved." por nota Apache-2.0 con enlace a `LICENSE` y línea de copyright.
- [ ] 2.2 Verificar visual: `grep -A 3 "## 📄 License" README.md`.
- [ ] 2.3 Commit único del fichero `README.md`.

## 3. Verify no frontend changes

- [ ] 3.1 Confirmar `frontend/README.md` sin modificar: `git diff frontend/README.md` → vacío.