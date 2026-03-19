-- MIGRACION: 004_add_domain_to_empresas.sql
-- Objetivo: Permitir que cada empresa tenga su dominio oficial asignado.

ALTER TABLE empresas ADD COLUMN IF NOT EXISTS dominio_autorizado VARCHAR(255);
ALTER TABLE empresas ADD COLUMN IF NOT EXISTS logo_url VARCHAR(255); -- Útil para el sitio final
