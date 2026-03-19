-- Esquema del Panel Maestro de Pixel CMS

-- Tabla de Empresas / Clientes
CREATE TABLE IF NOT EXISTS empresas (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    nit VARCHAR(50) UNIQUE,
    direccion TEXT,
    telefono VARCHAR(50),
    email_contacto VARCHAR(255),
    datos_facturacion JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Licencias
CREATE TABLE IF NOT EXISTS licencias (
    id SERIAL PRIMARY KEY,
    empresa_id INTEGER REFERENCES empresas(id) ON DELETE CASCADE,
    dominio VARCHAR(255) UNIQUE NOT NULL,
    codigo_licencia VARCHAR(100) UNIQUE NOT NULL,
    fecha_inicio DATE DEFAULT CURRENT_DATE,
    fecha_vencimiento DATE NOT NULL,
    plan_nombre VARCHAR(100) NOT NULL, -- Ej: Basico, Pro, Gobierno
    cuentas_correo INTEGER DEFAULT 0,
    modulos_habilitados JSONB DEFAULT '[]', -- Lista de slugs de módulos
    status SMALLINT DEFAULT 1, -- 1: Activa, 0: Inactiva, -1: Vencida
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Auditoría (Requerida por el Core)
CREATE TABLE IF NOT EXISTS auditoria (
    id SERIAL PRIMARY KEY,
    usuario_id INTEGER,
    accion VARCHAR(100),
    tabla VARCHAR(100),
    registro_id INTEGER,
    detalle JSONB,
    ip VARCHAR(50),
    endpoint TEXT,
    metodo VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Usuarios (Para el Master Panel)
CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(50) DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
