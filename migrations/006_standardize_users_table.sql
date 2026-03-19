-- MIGRACION: 006_standardize_users_table.sql
-- Objetivo: Asegurar que las columnas coincidan con la lógica Senior del controlador.

-- 1. Renombrar si existen las columnas antiguas
DO $$ 
BEGIN
    IF EXISTS (SELECT 1 FROM information_schema.columns WHERE table_name='users' AND column_name='email') THEN
        ALTER TABLE users RENAME COLUMN email TO username;
    END IF;

    IF NOT EXISTS (SELECT 1 FROM information_schema.columns WHERE table_name='users' AND column_name='role') THEN
        ALTER TABLE users ADD COLUMN role VARCHAR(50) DEFAULT 'admin_empresa';
    END IF;

    IF NOT EXISTS (SELECT 1 FROM information_schema.columns WHERE table_name='users' AND column_name='empresa_id') THEN
        ALTER TABLE users ADD COLUMN empresa_id INTEGER REFERENCES empresas(id);
    END IF;
END $$;
