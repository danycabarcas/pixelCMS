-- MIGRACION: 002_fix_empresas_columns.sql
-- Objetivo: Asegurar que la columna direccion exista en empresas.

ALTER TABLE empresas ADD COLUMN IF NOT EXISTS direccion TEXT;
