# apache-license Specification

## Purpose
Add Apache License 2.0 to the project with a standard `LICENSE` file at repo root and update the README license section to reference it.

## Requirements

### Requirement: LICENSE file exists with Apache-2.0 text
A file named `LICENSE` SHALL exist at the repository root containing the full official Apache License 2.0 text.

#### Scenario: LICENSE file present and correct
- **WHEN** checking repository root
- **THEN** `LICENSE` file exists
- **AND** first non-empty line is `Copyright 2026 Aton Soluciones Tecnológicas, SL`
- **AND** remaining content matches the official Apache License 2.0 text (https://www.apache.org/licenses/LICENSE-2.0)

### Requirement: README license section references Apache-2.0
The root `README.md` SHALL declare Apache License 2.0 in its License section and link to the `LICENSE` file.

#### Scenario: README shows Apache License 2.0
- **WHEN** reading `README.md` section "## 📄 License / Licencia"
- **THEN** text states "Apache License 2.0"
- **AND** includes a Markdown link to `LICENSE` (e.g., `[`LICENSE`](LICENSE)`)
- **AND** no text "Proprietary" or "Private project" remains in that section
- **AND** copyright line `Copyright 2026 Aton Soluciones Tecnológicas, SL` is present

### Requirement: Frontend README unchanged
The `frontend/README.md` SHALL NOT be modified (it has no license section).

#### Scenario: frontend/README.md unchanged
- **WHEN** comparing `frontend/README.md` before and after
- **THEN** no changes to license-related content