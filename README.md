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

Prompt para José (módulo 4 y 5):
Estoy trabajando en un proyecto PHP universitario llamado 
"Sistema de Gestión de Calificaciones Estudiantiles" para la 
Universidad Tecnológica de Panamá, Desarrollo de Software VII.

El proyecto usa PHP puro + Tailwind CSS v3, sin base de datos.
Está organizado en archivos separados dentro de una carpeta /modulos/.

El index.php tiene este <head> con estos estilos globales:
- bg-gray-950 text-gray-100 en el body
- .gradient-header con background linear-gradient(135deg, #0f172a, #1e3a5f, #0f172a)
- .card-glass con background rgba(255,255,255,0.04), backdrop-filter blur, border rgba blanca
- .progress-bar-bg con background rgba(255,255,255,0.08)
- font-family: Segoe UI

Necesito que generes DOS archivos:

modulo4_flujo.php — debe:
- Definir función evaluarEstado(float $promedio): string 
  que retorna "Aprobado" si promedio >= 61, sino "Reprobado"
- Definir función colorEstado(string $estado): string
  que retorna "green" o "red" según el estado
- Solo PHP puro, sin HTML, se carga siempre primero

modulo5_reporte.php — debe:
- Mostrar panel de resumen con: $promedioGeneral, $totalAprobados, 
  $totalReprobados, $mejorEstudiante, $peorEstudiante
- Mostrar tabla completa con: nombre, nota1, nota2, nota3, promedio, 
  letra, escala, barra de progreso (for), estado
- Mostrar listado de reprobados usando do...while
- Botón para volver a index.php
- Usar las clases CSS globales: card-glass, progress-bar-bg
- Colores diferenciados: aprobados en verde (green-400, green-900, etc), 
  reprobados en rojo (red-400, red-900, etc)
- Comentarios indicando qué módulo y bucle se usa en cada sección
- Encabezado con "Desarrollado por: JD"

El estilo visual debe ser oscuro, usando clases de Tailwind como:
bg-gray-800, bg-gray-950, text-white, text-gray-400, rounded-2xl, 
border border-gray-700, etc. Consistente con un tema dark profesional.

---------------------------------------------------------------------------------------------

Prompt Para Angélica (módulo 2 y 3):
Estoy trabajando en un proyecto PHP universitario llamado 
"Sistema de Gestión de Calificaciones Estudiantiles" para la 
Universidad Tecnológica de Panamá, Desarrollo de Software VII.

El proyecto usa PHP puro + Tailwind CSS v3, sin base de datos.
Está organizado en archivos separados dentro de una carpeta /modulos/.

El index.php ya existe y hace require de los módulos en este orden:
1. modulo4_flujo.php (siempre primero, define funciones)
2. modulo2_condicionales.php (si el form fue enviado)
3. modulo3_bucles.php (si el form fue enviado)

Las variables que index.php inicializa y que tú debes usar/llenar son:
- $estudiantes = []
- $errores = []
- $promedioGeneral = 0
- $totalAprobados = 0
- $totalReprobados = 0
- $mejorEstudiante = null
- $peorEstudiante = null

La función evaluarEstado($promedio) ya existe en modulo4_flujo.php
y retorna "Aprobado" o "Reprobado".

Necesito que generes DOS archivos:

modulo2_condicionales.php — debe:
- Leer $_POST["nombre"][], $_POST["nota1"][], $_POST["nota2"][], $_POST["nota3"][]
- Usar exit/die si no hay ningún nombre válido
- Usar continue para omitir filas vacías o con notas inválidas, 
  guardando el mensaje en $errores[]
- Calcular el promedio de cada estudiante
- Usar if/elseif/else para la escala: 91-100 Sobresaliente, 
  71-90 Bueno, 61-70 Regular, 51-60 Bajo, 0-50 Reprobado
- Usar switch para la letra: A, B, C, D, F
- Llenar el arreglo $estudiantes[] con: nombre, nota1, nota2, 
  nota3, promedio, escala, letra, estado

modulo3_bucles.php — debe:
- Usar while para calcular $promedioGeneral acumulando notas una a una
- Usar foreach para contar $totalAprobados y $totalReprobados, 
  y detectar $mejorEstudiante y $peorEstudiante
- Usar for con break para buscar el estudiante con promedio más alto

El estilo del código debe ser:
- Comentarios en español
- Encabezado con nombre del módulo y "Desarrollado por: AC"
- Indentación de 4 espacios
- Sin HTML, solo lógica PHP pura
