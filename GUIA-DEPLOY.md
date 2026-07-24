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

El tema vive en GitHub (`leogalvan29/repo_lonking`), y tanto Local como DreamHost son clones del mismo repo. Eso hace el deploy más simple que rsync: solo hay que subir a GitHub y luego bajar en DreamHost.

1. **Subir el commit a GitHub** (desde Local):
   ```bash
   cd "wp-content/themes/amex-machinery"
   git push origin main
   ```

2. **Bajar el cambio en DreamHost** (por SSH):
   ```bash
   ssh usuario@tuservidor.dreamhostps.com
   cd /ruta/a/tu/sitio/wp-content/themes/amex-machinery
   git pull origin main
   ```

`git pull` solo trae los archivos que cambiaron (como un rsync inteligente), y deja registro exacto de qué versión del tema está corriendo en producción en todo momento (`git log --oneline`).

**Antes de correr el `git pull` en tu sitio real, dime y lo confirmamos juntos** — es una acción que sí toca producción.

## 5. Sobre los campos de ACF (acf-json)

Los archivos en `acf-json/` (los campos de Marca, Contacto, Venta, Renta, etc.) viajan con el tema — al hacer `git pull`, se copian solos. Cuando ACF detecta que el `.json` es más nuevo que lo que tiene guardado en la base de datos de DreamHost, te va a mostrar un aviso de "Sync available" en **Personalizado > Campos** — dale clic para que tome los cambios. Esto es normal, no es un error.

## 6. Qué NO se sincroniza con este método

- **Contenido real** (productos, páginas, textos que captures en wp-admin, valores del Customizer como el teléfono) — eso vive en la base de datos de cada sitio por separado. Local y DreamHost tienen datos independientes.
- **Imágenes subidas** (`wp-content/uploads/`) — no está dentro del tema, así que `git pull` no las toca.

Si en algún momento quieres traer contenido/productos de un lado a otro, es un proceso aparte (exportar/importar base de datos, o REST API como usamos para los productos de Lonking).

## 7. Resumen mental

```
Local (pruebas)  --commit + push-->  GitHub (historial y respaldo central)
                                     GitHub --pull--> DreamHost (producción, lo que ve la gente)
```

Local nunca "sabe" de DreamHost automáticamente, y viceversa — el deploy es siempre un paso manual y consciente (push + pull), nunca automático.
