## 1. Frontend — Fix OutfitEditor template

- [ ] 1.1 Reescribir el bloque de plantilla líneas 32-44 en `frontend/app/components/editor/OutfitEditor.vue`: envolver el `<div>` "Sin prenda en este slot" y el `<UiButton>` "Catálogo" en un único contenedor `<div v-else class="space-y-2">`.
- [ ] 1.2 Verificar: `cd frontend && npx nuxi typecheck` → exit 0, sin errores.
- [ ] 1.3 Commit único del fichero `OutfitEditor.vue`.