# Job Analyzer

Aplicación web en Laravel que analiza ofertas de empleo, puntúa el encaje con mi perfil y genera un CV y una carta de presentación adaptados a cada oferta.

Nació de un problema propio: adaptar cada candidatura a mano lleva tiempo y casi siempre se acaba enviando el mismo CV genérico. Aquí el perfil vive en base de datos y la IA decide qué destacar según lo que pide cada oferta.

> Estado: en desarrollo activo. Consulta el apartado [Estado del proyecto](#estado-del-proyecto).

## Qué hace

1. Guardo mi perfil completo una sola vez (experiencia, proyectos, skills, formación, soft skills, idiomas).
2. Pego una oferta de empleo.
3. El sistema la analiza con la API de OpenAI y devuelve una puntuación de encaje con el porqué.
4. Genera un CV y una carta adaptados a esa oferta, listos para exportar a PDF.

## Stack

- **Backend:** PHP, Laravel
- **IA:** OpenAI API
- **Vistas:** Blade
- **PDF:** [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
- **Base de datos:** [MySQL / SQLite / la que uses]

## Cómo está organizado

```
Perfil (BD) ──► ProfileCvTransformer ──► Servicio de análisis (OpenAI) ──► Vistas Blade ──► PDF
```

- **Perfil en base de datos.** Los bloques con estructura (experiencia, proyectos, skills, formación, soft skills, idiomas) se guardan como campos de tipo array, con la misma forma que tenía el antiguo `cv_base.php` estático.
- **`ProfileCvTransformer`** (`app/Services/Profile/`). Convierte el perfil guardado en el array que espera el servicio de análisis. El método `toCvArray(Profile $profile)` limpia los bloques vacíos y deja solo datos útiles para el prompt.
- **Servicio de análisis.** Envía a OpenAI la oferta y el perfil, y recibe la puntuación de encaje y los textos adaptados.
- **Generación de PDF.** Vistas Blade renderizadas con dompdf.

Decisión de diseño: `skills` y `soft_skills` son arrays simples e independientes. Descarté por ahora derivar skills automáticamente desde cada bloque de experiencia o proyecto porque añadía complejidad sin aportar todavía valor real.

## Instalación

Requisitos: PHP [8.x], Composer, [base de datos] y una clave de la API de OpenAI.

```bash
git clone https://github.com/jvivas95/job-analyzer.git
cd job-analyzer
composer install
cp .env.example .env
php artisan key:generate
```

Configura en `.env` la base de datos y tu clave:

```env
OPENAI_API_KEY=tu_clave
```

Después:

```bash
php artisan migrate
php artisan serve
```

## Estado del proyecto

- [x] Perfil almacenado en base de datos con campos anidados
- [x] Helper `cleanBlock()` para eliminar campos vacíos
- [x] Análisis de ofertas y puntuación de encaje con OpenAI
- [x] `ProfileCvTransformer` (en curso): sustituir por completo el antiguo `cv_base.php`
- [x] Vistas Blade para CV y carta en PDF con dompdf
- [ ] Tests automáticos
- [ ] [Capturas de pantalla y demo]

## Notas de desarrollo

Proyecto personal que programo yo mismo paso a paso. Uso IA como herramienta dentro del producto y para revisar decisiones, pero el código y la arquitectura son míos.

## Autor

**Jefferson Vivas Vásquez** · [jvivas.es](https://jvivas.es) · [GitHub](https://github.com/jvivas95)
