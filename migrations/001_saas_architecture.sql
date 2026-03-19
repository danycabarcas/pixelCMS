-- MIGRACION: 001_saas_architecture.sql
-- Objetivo: Añadir campos de empresas, planes, módulos y ajustar licencias.

-- 1. Campos de contacto en empresas
ALTER TABLE empresas ADD COLUMN IF NOT EXISTS responsable VARCHAR(255);
ALTER TABLE empresas ADD COLUMN IF NOT EXISTS whatsapp VARCHAR(50);
ALTER TABLE empresas ADD COLUMN IF NOT EXISTS contacto_facturacion VARCHAR(255);
ALTER TABLE empresas ADD COLUMN IF NOT EXISTS contacto_tecnico VARCHAR(255);

-- 2. Tabla de Módulos
CREATE TABLE IF NOT EXISTS modulos (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    descripcion TEXT,
    icono VARCHAR(50),
    status INTEGER DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabla de Planes
CREATE TABLE IF NOT EXISTS planes (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    descripcion TEXT,
    precio_mensual NUMERIC(10,2),
    meses_duracion INTEGER DEFAULT 1,
    modulos_incluidos JSONB, -- [slug1, slug2]
    status INTEGER DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Ajustes en Licencias para Periodos de Gracia y Planes
ALTER TABLE licencias ADD COLUMN IF NOT EXISTS periodo_gracia_dias INTEGER DEFAULT 7;
ALTER TABLE licencias ADD COLUMN IF NOT EXISTS ultima_facturacion DATE;
ALTER TABLE licencias ADD COLUMN IF NOT EXISTS modulos_json JSONB;
ALTER TABLE licencias ADD COLUMN IF NOT EXISTS gov_config JSONB;
ALTER TABLE licencias ADD COLUMN IF NOT EXISTS plan_id INTEGER REFERENCES planes(id);

-- 5. Insertando Módulos Base (Ejemplos)
INSERT INTO modulos (nombre, slug, descripcion, icono) VALUES 
('Constructor de Sitios', 'builder', 'Editor de páginas visual', 'fa-tools'),
('Gestión de Archivos', 'files', 'Gestor de medios y documentos', 'fa-folder-open')
ON CONFLICT (slug) DO NOTHING;
