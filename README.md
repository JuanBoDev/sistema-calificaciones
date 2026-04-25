| Integrante | Módulos asignados |

| Juan | Módulo 1 — Registro de estudiantes y notas |
| Angélica | Módulo 2 — Condicionales / Módulo 3 — Bucles |
| José | Módulo 4 — Control de flujo / Módulo 5 — Reporte visual |

Requisitos — Instalar antes de empezar

| Herramienta | Link | Para qué sirve |
|---|---|---|
| Node.js LTS | [nodejs.org](https://nodejs.org) | Necesario para correr Tailwind |
| PHP 8+ | [php.net](https://www.php.net/downloads) o instala XAMPP | Ejecutar el proyecto | Usaremos XAMPP


--Instalar Tailwind v3--

En terminal VS Code
npm install

> Esto lee el `package.json` e instala automáticamente Tailwind v3.

---

## ▶️ Cómo ejecutar el proyecto

Necesitas **dos terminales abiertas al mismo tiempo** en VS Code:

**Terminal 1 — Tailwind (mantener corriendo siempre)**
```bash
npm run watch
```
Esto genera el archivo `css/output.css` automáticamente cada vez que guardas cambios.

**Terminal 2 — Servidor PHP**
```bash
php -S localhost:8000
```
En el navegador se abre con http://localhost/...

Desde el panel de XAMPP - Clonar el repositorio directo el C:\xampp\htdocs\...

Abre XAMPP Control Panel
Dale Start a Apache
Copia tu carpeta del proyecto dentro de C:\xampp\htdocs\
Abre el navegador en http://localhost/sistema-calificaciones

## 📁 Estructura del proyecto

\```
sistema-calificaciones/
├── index.php               ← archivo principal
├── css/
│   ├── input.css           ← entrada de Tailwind (no editar)
│   └── output.css          ← CSS generado por Tailwind (no editar)
├── package.json            ← dependencias del proyecto
├── tailwind.config.js      ← configuración de Tailwind
├── .gitignore              ← archivos que Git ignora
└── README.md               ← este archivo
\```
