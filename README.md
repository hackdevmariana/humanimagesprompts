# HumanImagesPrompts Engine

> **"From chaotic prompt engineering to deterministic digital asset management for AI."**

---

## 📖 Introduction / Introducción

### ES
**HumanImagesPrompts Engine** es una infraestructura de software desacoplada, modular y reactiva (*Prompt-Driven Digital Asset Management*) diseñada para transformar la generación de imágenes fotorrealistas con IA.

Actualmente, la creación de imágenes mediante modelos de difusión (Midjourney, Flux, Stable Diffusion) padece del **"caos de la cadena de texto"**: prompts kilométricos, inconsistencia en la identidad de los personajes, imposibilidad de reutilizar vestuarios y dependencia del ensayo y error.

**HumanImagesPrompts** resuelve esta problemática tratando la morfología humana, el vestuario por capas, la física de la luz y la óptica cinematográfica no como texto plano, sino como **componentes de dominio fuertemente tipados, inmutables, mutables en caliente y completamente reutilizables**.

### EN
**HumanImagesPrompts Engine** is a decoupled, modular, and reactive software infrastructure (*Prompt-Driven Digital Asset Management*) designed to transform photorealistic image generation with AI.

Currently, image creation using diffusion models (Midjourney, Flux, Stable Diffusion) suffers from **"prompt string chaos"**: kilometer-long prompts, inconsistent character identity, inability to reuse outfits, and reliance on trial and error.

**HumanImagesPrompts** solves this by treating human morphology, layered clothing, light physics, and cinematic optics not as plain text, but as **strongly typed, immutable, hot-mutable, and fully reusable domain components**.

📖 **Full vision:** [`docs/domain/vision.md`](docs/domain/vision.md)

---

## 🏗️ Stack & Architecture / Pila y Arquitectura

| Layer / Capa | Technology / Tecnología | Port / Puerto |
|--------------|-------------------------|---------------|
| **Backend** | Symfony 8.1, PHP ≥ 8.4, Doctrine ORM 3.6 | 8000 |
| **Frontend** | Nuxt 4, Vue 3.5, Pinia, Tailwind CSS 4, TypeScript strict | 3000 |
| **Proxy** | Nuxt dev server proxies `/api/**` → `http://127.0.0.1:8000/api/**` | — |

**Bounded Contexts (DDD):**
1. **Catalog Context** — Technical taxonomies, incompatibility matrix, declarative rules.
2. **Asset Context** — Reusable entities: Characters, Layered Outfits, Poses, Lighting, Scenes, Time/Weather.
3. **Composer Context** — Reactive workbench (Vue/Pinia), hot mutations via `MutationOverrides` without altering original assets.
4. **Translation Context** — Adapters to translate canonical JSON → Midjourney / Flux.1 / SDXL syntax.

---

## ✅ Prerequisites / Requisitos Previos

| Tool / Herramienta | Version / Versión | Notes / Notas |
|--------------------|-------------------|---------------|
| **PHP** | ≥ 8.4 | `ctype`, `iconv`, `pdo_sqlite` extensions |
| **Composer** | 2.x | Dependency manager |
| **Node.js** | ≥ 20 (tested 22.23.2) | `npm` / `npx` |
| **Symfony CLI** | Latest (optional) | `symfony server:start` for dev |
| **Docker** | Latest (optional) | For PostgreSQL via `compose.yaml` |

---

## 🚀 Quick Start / Puesta en Marcha (Development)

### 1. Backend Setup / Backend

```bash
cd backend

# Install dependencies
composer install

# Environment configuration
cp .env.example .env
# Edit .env and set:
#   APP_SECRET=<generate with: php -r "echo bin2hex(random_bytes(32));">
#   ADMIN_EMAIL=admin@example.com
#   ADMIN_PASSWORD_HASH=<generate with: php -r "echo password_hash('password', PASSWORD_DEFAULT);">
#   DATABASE_URL="sqlite:///%kernel.project_dir%/var/data_dev.db"  (default)

# Run migrations
php bin/console doctrine:migrations:migrate

# Load fixtures (demo data: characters, outfits, poses, scenes, lightings, time-weather)
php bin/console doctrine:fixtures:load

# Start server (port 8000)
symfony server:start -d
# Alternative without Symfony CLI:
# php -S 0.0.0.0:8000 -t public
```

> **Default login:** `admin@example.com` / `password` (defined by `ADMIN_PASSWORD_HASH` in `.env`)

### 2. Frontend Setup / Frontend

```bash
cd frontend

# Install dependencies
npm install

# Start dev server (port 3000, proxies /api to backend:8000)
npm run dev
```

Open **http://localhost:3000** → login with `admin@example.com` / `password`.

### 3. Database Options / Opciones de Base de Datos

| Mode / Modo | Configuration / Configuración |
|-------------|-------------------------------|
| **SQLite (default / por defecto)** | No extra steps. File at `backend/var/data_dev.db`. |
| **PostgreSQL (via Docker)** | `docker compose up -d` (starts Postgres 16 on port 5432). Update `DATABASE_URL` in `.env` to `postgresql://app:app@127.0.0.1:5432/app?serverVersion=16&charset=utf8`. |

---

## 🔌 API Reference / Referencia de la API

All endpoints under `/api`. Authentication via session cookie (login sets cookie, subsequent requests send it automatically).

| Method | Endpoint | Description / Descripción |
|--------|----------|---------------------------|
| **POST** | `/api/login` | Login `{email, password}` → sets session cookie |
| **GET** | `/api/me` | Current authenticated user |
| **GET** | `/api/assets/search` | Search across all asset types |
| **POST** | `/api/compile` | Compile composition → canonical JSON + prompt text |
| **CRUD** | `/api/characters` | Characters |
| **CRUD** | `/api/poses` | Poses |
| **CRUD** | `/api/outfits` | Outfits (layered clothing) |
| **CRUD** | `/api/scenes` | Scenes (camera, environment) |
| **CRUD** | `/api/lightings` | Lighting setups |
| **CRUD** | `/api/time-weather` | Time & Weather (season, time of day, weather) |

**Compile request example:**
```json
{
  "characterId": "uuid",
  "poseId": "uuid",
  "outfitIds": ["uuid1", "uuid2"],
  "sceneId": "uuid",
  "lightingId": "uuid",
  "timeWeatherId": "uuid",
  "targetEngine": "FLUX_1_DEV"
}
```

**Compile response:**
```json
{
  "meta": { "generatedAt": "...", "targetEngine": "FLUX_1_DEV" },
  "canonical": { "character": {...}, "pose": {...}, ... },
  "compiled_text": "A photorealistic portrait of ... --ar 16:9 --v 6.0"
}
```

---

## ⚙️ Prompt Compilation / Compilación de Prompts

**Canonical order (fixed):**
1. Character (morphology, skin, hair)
2. Pose
3. Outfit (base → mid → outer → accessories)
4. Scene (camera, lens, environment)
5. Time/Weather (season, time of day, weather)
6. Lighting (scheme, color temp, hardness)

**Target engines (`targetEngine`):**
- `FLUX_1_DEV` — Dense narrative text optimized for Flux semantic understanding
- `MIDJOURNEY` — Descriptive English + tactical flags (`--ar 16:9 --style raw --v 6.0`)
- `SDXL` — Hierarchical tag/booru structure + negative prompts

See `docs/domain/canonical-prompt-schema.md` for JSON Schema v1.0.0.

---

## 🧪 Tests & Quality / Tests y Calidad

| Suite | Command | Notes |
|-------|---------|-------|
| **Backend (PHPUnit)** | `cd backend && php bin/phpunit` | 61 tests, 297 assertions. Uses file-based SQLite at `var/test.db`. |
| **Frontend (TypeCheck)** | `cd frontend && npx nuxi typecheck` | Strict TypeScript, exit 0 on success. |

---

## 🚢 Production Deployment / Despliegue en Producción

### Backend
```bash
# 1. Environment
APP_ENV=prod
APP_DEBUG=0
# Set real DATABASE_URL (MySQL/PostgreSQL recommended for multi-user)
# Set strong APP_SECRET and ADMIN_PASSWORD_HASH

# 2. Install optimized
composer install --no-dev --optimize-autoloader

# 3. Migrations
php bin/console doctrine:migrations:migrate --no-interaction

# 4. Cache
php bin/console cache:clear --no-warmup
php bin/console cache:warmup

# 5. Serve
# Option A: PHP-FPM + Nginx (serve backend/public/index.php)
# Option B: symfony server:start --no-tls --port=8000
```

### Frontend
```bash
cd frontend

# Build for production
npm run build

# Preview production build locally
npm run preview

# Or deploy .output/ to Node hosting (PM2, systemd, Docker, etc.)
```

### Required Production Env Vars / Variables Requeridas

**Backend (`.env.local` or server env):**
```
APP_ENV=prod
APP_SECRET=<32-char-hex>
ADMIN_EMAIL=admin@yourdomain.com
ADMIN_PASSWORD_HASH=<bcrypt-hash>
DATABASE_URL=mysql://user:pass@host:3306/db?serverVersion=8.0&charset=utf8mb4
# or postgresql://...
CORS_ALLOW_ORIGIN=https://yourdomain.com
```

**Frontend (build-time via `NUXT_PUBLIC_*`):**
```
NUXT_PUBLIC_API_BASE=https://api.yourdomain.com
```

---

## 📚 Documentation / Documentación

| Document | Description |
|----------|-------------|
| [`docs/domain/vision.md`](docs/domain/vision.md) | Product vision & architecture |
| [`docs/domain/entities.md`](docs/domain/entities.md) | Domain entities reference |
| [`docs/domain/canonical-prompt-schema.md`](docs/domain/canonical-prompt-schema.md) | CanonicalPrompt JSON Schema v1.0.0 |
| [`docs/domain/compatibility-matrix.md`](docs/domain/compatibility-matrix.md) | Tag-driven incompatibility rules |
| [`docs/project_and_data.md`](docs/project_and_data.md) | Project overview & data model |

---

## 🔄 OpenSpec Workflow / Flujo OpenSpec

Changes are proposed, designed, specified, and tasked via OpenSpec:

```bash
# Explore an idea
opencode run openspec-explore "Add X feature"

# Propose a change (generates proposal + design + specs + tasks)
opencode run openspec-propose "Add X feature"

# Apply tasks (implementation)
opencode run openspec-apply-change <change-id>

# Archive when done
opencode run openspec-archive-change <change-id>
```

Artifacts live under `openspec/changes/<change-id>/`.

---

## 📁 Project Structure / Estructura del Proyecto

```
humanimagesprompts/
├── backend/                 # Symfony 8.1 API
│   ├── src/
│   │   ├── Controller/Api/  # Controllers (Auth, CRUD, Compile)
│   │   ├── Entity/          # Doctrine entities (6 asset types + TimeWeather)
│   │   ├── Service/         # PromptCompiler, compatibility, etc.
│   │   └── Repository/
│   ├── config/              # Symfony config (routes, security, doctrine)
│   ├── migrations/          # Doctrine migrations
│   ├── fixtures/            # Demo data fixtures
│   ├── var/                 # SQLite DBs (dev, test), cache
│   ├── compose.yaml         # Optional PostgreSQL
│   └── .env.example         # Environment template
├── frontend/                # Nuxt 4 SPA
│   ├── app/
│   │   ├── components/      # Vue components (editors, sidebar, blocks)
│   │   ├── composables/     # Pinia stores + composables (useApi, useCompile...)
│   │   ├── pages/           # Login, Dashboard, SceneEditor
│   │   └── types/           # TypeScript interfaces
│   ├── nuxt.config.ts       # Proxy /api → backend:8000
│   └── package.json
├── docs/                    # Domain documentation
├── openspec/                # OpenSpec change artifacts
├── TODO.md                  # Task tracker
└── README.md                # This file
```

---

## 📄 License / Licencia

Proprietary / Private project. All rights reserved.

---

*Generated with ❤️ for deterministic AI image generation.*