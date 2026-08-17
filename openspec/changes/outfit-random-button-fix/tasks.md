## 1. Fix BlockEditor - habilitar botón aleatorio en Outfit

- [ ] 1.1 Editar `frontend/app/components/BlockEditor.vue:130` — quitar `props.blockKey !== 'outfit'` de `supportsRandom`

## 2. Verificación

- [ ] 2.1 Ejecutar `npx nuxi typecheck` — sin errores nuevos
- [ ] 2.2 Probar manualmente en http://localhost:3001/ — botón "Carga aleatoria" visible en bloque Outfit y genera outfit al pulsar
- [ ] 2.3 Ejecutar `php bin/phpunit` — 63 tests verdes (sin regresiones)