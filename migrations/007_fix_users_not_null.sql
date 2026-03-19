-- MIGRACION: 007_fix_users_not_null.sql
-- Objetivo: Permitir que la creación de usuarios SaaS no falle por columnas antiguas obligatorias.

ALTER TABLE users ALTER COLUMN nombre DROP NOT NULL;
ALTER TABLE users ALTER COLUMN username SET NOT NULL;
