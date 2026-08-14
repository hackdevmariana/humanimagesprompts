## ADDED Requirements

### Requirement: Admin login with email and password
The system SHALL authenticate a single preseeded admin user via an email and password form. Credentials SHALL be admin@example.com / password (stored as a password hash). Session-based authentication SHALL be handled by Symfony Security (form login + session cookie).

#### Scenario: Successful login
- **WHEN** an unauthenticated user POSTs valid credentials to /login
- **THEN** the server sets a session cookie and redirects to /dashboard

#### Scenario: Failed login
- **WHEN** an unauthenticated user POSTs invalid credentials to /login
- **THEN** the server returns HTTP 200 and re-renders the login form with an error flash message

### Requirement: Protected dashboard route
The system SHALL prevent unauthenticated users from accessing /dashboard.

#### Scenario: Redirect when unauthenticated
- **WHEN** an unauthenticated user navigates to /dashboard
- **THEN** the server redirects them to /login
