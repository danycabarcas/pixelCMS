-- MIGRACION: 005_users_saas_link.sql
-- Objetivo: Permitir que los usuarios pertenezcan a una empresa específica.

ALTER TABLE users ADD COLUMN IF NOT EXISTS empresa_id INTEGER REFERENCES empresas(id);
ALTER TABLE users ADD COLUMN IF NOT EXISTS role VARCHAR(50) DEFAULT 'admin_empresa'; -- roles: superadmin, admin_empresa, editor

-- Un usuario que sea superadmin (como tú) no tendrá empresa_id asignado (será null)
-- para que pueda controlar todo el ecosistema.
