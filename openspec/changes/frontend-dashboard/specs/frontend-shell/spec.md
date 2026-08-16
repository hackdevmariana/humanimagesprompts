# frontend-shell Specification

## Purpose
Initialize a Nuxt 4 frontend project that authenticates a single admin user via session cookies, proxies API requests to the Symfony backend, and provides the layout shell (sidebar + main canvas + right panel) for the five toggleable prompt-block editors.

## Requirements

### Requirement: Project scaffolding
The frontend SHALL be a Nuxt 4 project with TypeScript, TailwindCSS v4, Pinia 2, and Phosphor Icons. The dev server SHALL run on port 3000 and proxy `/api` requests to the Symfony backend on port 8000 with credentials (session cookies) included.

#### Scenario: Project initializes
- **WHEN** the user runs `npm run dev` in `frontend/`
- **THEN** the Nuxt dev server starts on `http://localhost:3000`
- **AND** browser requests to `/api/*` are proxied to `http://localhost:8000/api/*` with `credentials: include`

### Requirement: Auth flow
The system SHALL provide a login page that POSTs `{email, password}` to `/api/login` and stores the session via cookie. Authenticated routes SHALL redirect to `/dashboard`; unauthenticated access to `/dashboard` SHALL redirect to `/login`.

#### Scenario: Successful login
- **WHEN** the user submits valid credentials on `/login`
- **THEN** a session cookie is set by the backend
- **AND** the user is redirected to `/dashboard`

#### Scenario: Unauthenticated dashboard redirect
- **WHEN** an unauthenticated user navigates to `/dashboard`
- **THEN** they are redirected to `/login`

### Requirement: Layout shell
The dashboard SHALL present a three-column layout: left sidebar (block toggles), main canvas (active editor), right panel (live preview + compile). The layout SHALL be responsive: sidebar collapses on tablet, drawer on mobile.

#### Scenario: Sidebar block toggle
- **WHEN** the user clicks "Personaje" in the sidebar
- **THEN** the Character editor appears in the main canvas
- **AND** the sidebar item shows an active state
