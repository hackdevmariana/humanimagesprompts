## Context
Greenfield project "HumanImagesPrompts Engine". A single preseeded admin user composes AI image prompts by assembling five independent, named blocks (Character, Pose, Outfit, Scene, Lighting). This design covers the MVP only; the canonical JSON export and multi-user features are deferred.

## Goals / Non-Goals
- Goals:
  - Composable, toggleable prompt-block editor (Vue 3 + Pinia).
  - Reusable, named assets persisted in normalized tables.
  - Editable compiled plain-text prompt with copy-to-clipboard.
  - Searchable asset library with fuzzy autocomplete.
- Non-Goals:
  - Multi-user / RBAC.
  - Canonical JSON v1.0.0 export.
  - Direct AI model invocation or image rendering.

## Decisions
- **Database:** SQLite for the MVP (single file, zero server dependency). Migration path to MariaDB is identical (Doctrine abstracts the driver).
- **ORM:** Doctrine ORM. Domain entities placed under `src/<Domain>/Entity`, with value objects under `src/<Domain>/ValueObject`. No Eloquent-style Active Record; entities are plain PHP objects mapped by Doctrine YAML/`.php` mappings.
- **Domain layout:** Domain-driven folder structure (not Symfony's default `src/Entity`). Each domain (Character, Pose, Outfit, Scene, Lighting) owns its entity, value objects, repository interface, and API controller.
- **Value-object persistence:** Nested VOs (e.g. `SkinProfile`, `CranialMorphology`) map to either a dedicated value-table per aggregate (one-to-one) or to scalar columns on the aggregate table. Decision: **scalar columns on the aggregate row** for MVP simplicity (gender, age, ethnicity on `character`; key enums stored as strings; ColorVO as hex string). This keeps queries flat and normalized.
- **API layer:** Symfony REST controllers under `src/<Domain>/Api/`. JSON in/out. CSRF disabled for JSON API (session auth via cookie).
- **Frontend:** Nuxt 4 (Vue 3 + TypeScript), Pinia for state, TailwindCSS, composable form components per block. Forms POST/GET via `$fetch` or Axios.
- **Auth:** Symfony form login (`Symfony\Component\Security\Http\Firewall\FormLoginAuthenticator`). Session cookie. Single user fixture: `admin@example.com` / `password`.
- **Asset search:** SQLite FTS5 virtual table on a normalized `asset_index` view OR per-domain `FULLTEXT`-style column. MVP uses a simple `LIKE '%term%'` query with 300 ms debounce in the Vue autocomplete. Deferred: SQLite FTS5 for scale.
- **Prompt compilation:** A pure-PHP service `PromptCompiler` in `src/Prompt/` that maps active block data → human text. Deterministic string assembly; editable in the textarea before copy.

## Risks / Trade-offs
- [Risk] VO richness (e.g. heterochromia rules) vs MVP flat columns → Mitigation: MVP stores only the fields the editor needs; VOs evolve when invariants are validated.
- [Risk] Autocomplete latency with many assets → Mitigation: 300 ms debounce + SQLite `LIKE` index; upgrade to FTS5 in a later task.
- [Risk] Nuxt + Symfony session-cookie CSRF handling → Mitigation: disable CSRF for JSON API, rely on `sameSite=Lax` cookies; document if needed.

## Migration Plan
1. `openspec archive prompt-engine-mvp` (after specs are frozen and accepted).
2. Implement tasks.md top-to-bottom.
3. Re-validate against archived specs.

## Open Questions
- Canonical prompt schema field mapping is deferred to post-MVP (tracked in a later change).
