# Guía: Local (desarrollo) → DreamHost (producción)

Esta guía explica cómo seguimos trabajando en el tema una vez que el sitio real ya vive en DreamHost. Local sigue siendo tu entorno de pruebas; DreamHost es lo que ve el público.

## 1. Por qué git solo en el tema, no en todo WordPress

No versionamos wp-admin, wp-includes, ni los plugins de terceros (WooCommerce, ACF) — eso es código de otros que se actualiza solo. Lo único que es "nuestro" y necesita historial es:

```
wp-content/themes/amex-machinery/
```

Por eso el repo de git vive ahí, no en la raíz de `public/`.

## 2. Flujo normal de trabajo

1. **Yo edito archivos en Local** (como hasta ahora) → los pruebas en tu navegador contra `http://localhost:PUERTO`.
2. **Cuando algo ya funciona y quieres guardarlo**, hacemos un commit:
   ```bash
   cd "wp-content/themes/amex-machinery"
   git add -A
   git commit -m "Descripción corta de qué cambió"
   ```
   Esto es local — todavía no toca DreamHost. Es tu "punto de guardado".
3. **Cuando quieres publicar esos cambios en el sitio real**, hacemos el *deploy* (ver sección 4).

## 3. Comandos de git que vas a usar seguido

| Quiero...                                      | Comando                                  |
|-------------------------------------------------|-------------------------------------------|
| Ver qué archivos cambiaron desde el último commit | `git status`                            |
| Ver el detalle de qué cambió línea por línea     | `git diff`                                |
| Guardar un punto en el tiempo (commit)           | `git add -A && git commit -m "mensaje"`  |
| Ver el historial de commits                      | `git log --oneline`                       |
| Deshacer cambios sin guardar (volver al último commit) | `git checkout -- .`                 |
| Volver a una versión anterior específica         | `git checkout <hash-del-commit> -- .`     |

**Regla de oro:** si algo se rompe después de un cambio mío, siempre podemos volver al último commit bueno con `git checkout -- .` — por eso conviene comitear seguido, no solo una vez al final.

## 4. Deploy a DreamHost (subir cambios a producción)

Con SSH ya habilitado en tu VPS/Dedicated de DreamHost, la forma más simple es `rsync` sobre SSH — copia solo lo que cambió, no todo el tema de nuevo cada vez.

```bash
rsync -avz --exclude '.git' --exclude '.gitignore' \
  "wp-content/themes/amex-machinery/" \
  usuario@tuservidor.dreamhost.com:/ruta/a/tu/sitio/wp-content/themes/amex-machinery/
```

Reemplaza `usuario@tuservidor.dreamhost.com` y la ruta con tus datos reales de DreamHost.

**Antes de correr esto en tu sitio real, dime y lo confirmamos juntos** — es una acción que sí toca producción.

## 5. Sobre los campos de ACF (acf-json)

Los archivos en `acf-json/` (los campos de Marca, Contacto, Venta, Renta, etc.) viajan con el tema — al hacer el rsync, se copian solos. Cuando ACF detecta que el `.json` es más nuevo que lo que tiene guardado en la base de datos de DreamHost, te va a mostrar un aviso de "Sync available" en **Personalizado > Campos** — dale clic para que tome los cambios. Esto es normal, no es un error.

## 6. Qué NO se sincroniza con este método

- **Contenido real** (productos, páginas, textos que captures en wp-admin) — eso vive en la base de datos de cada sitio por separado. Local y DreamHost tienen datos independientes.
- **Imágenes subidas** (`wp-content/uploads/`) — no está dentro del tema, así que este rsync no las toca.

Si en algún momento quieres traer contenido/productos de un lado a otro, es un proceso aparte (exportar/importar base de datos, o WP All Import como ya estás usando para Dreamhost).

## 7. Resumen mental

```
Local (pruebas)  --commit-->  historial en git (tu respaldo/versiones)
                 --rsync/SSH-->  DreamHost (producción, lo que ve la gente)
```

Local nunca "sabe" de DreamHost automáticamente, y viceversa — el deploy es siempre un paso manual y consciente, nunca automático.
