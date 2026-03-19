-- MIGRACION: 003_total_sync_empresas.sql
-- Objetivo: Asegurar que todos los campos finales existan en la tabla empresas.

ALTER TABLE empresas ADD COLUMN IF NOT EXISTS email_contacto VARCHAR(255);
ALTER TABLE empresas ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
