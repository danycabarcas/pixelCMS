-- MIGRACION: 008_noticias_seo_pro.sql
-- Objetivo: Dotar al módulo de noticias con arquitectura multitenant y SEO Full.

ALTER TABLE noticias ADD COLUMN IF NOT EXISTS empresa_id INTEGER REFERENCES empresas(id);
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS meta_title VARCHAR(255);
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS meta_description TEXT;
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS meta_keywords TEXT;
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS og_image_url VARCHAR(500);
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS views_count INTEGER DEFAULT 0;
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS autor_id INTEGER REFERENCES users(id);
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS tags TEXT;
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS is_featured BOOLEAN DEFAULT FALSE;
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS related_news TEXT; -- IDs separados por comas

-- Categorías como tabla relacional para mejor SEO
CREATE TABLE IF NOT EXISTS categorias_noticias (
    id SERIAL PRIMARY KEY,
    empresa_id INTEGER REFERENCES empresas(id),
    nombre VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL,
    description TEXT,
    UNIQUE(empresa_id, slug)
);

-- Migrar la columna categoria antigua a la nueva estructura si se requiere (manual después)
-- Por ahora vinculamos noticias con la tabla de categorías
ALTER TABLE noticias ADD COLUMN IF NOT EXISTS categoria_id INTEGER REFERENCES categorias_noticias(id);
