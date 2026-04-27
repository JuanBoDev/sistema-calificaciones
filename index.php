<?php
/*
 * Integrantes:
 *   JuanB — Módulo 1 (Registro) + Módulo 5 (Tabla del reporte)
 *   AngélicaS — Módulo 2 (Condicionales) + Módulo 3 (Bucles)
 *   JoséG — Módulo 4 (Control de flujo) + Módulo 5 (Panel de resumen)
 *
 * Archivo: index.php
 * Descripción: Punto de entrada principal. Orquesta los módulos
 *              y renderiza la vista según el estado del formulario.
 */

// Módulo 4 siempre se carga primero porque define funciones que
// los demás módulos necesitan
require_once 'modulos/modulo4_flujo.php';

$formularioEnviado = $_SERVER["REQUEST_METHOD"] === "POST";
$estudiantes       = [];
$errores           = [];
$promedioGeneral   = 0;
$totalAprobados    = 0;
$totalReprobados   = 0;
$mejorEstudiante   = null;
$peorEstudiante    = null;

if ($formularioEnviado) {
    // Procesa los datos del formulario (Módulo 2 - Angélica)
    require_once 'modulos/modulo2_condicionales.php';
    // Calcula estadísticas generales con bucles (Módulo 3 - Angélica)
    require_once 'modulos/modulo3_bucles.php';
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Calificaciones — UTP</title>
    <link rel="stylesheet" href="css/output.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; }
        .gradient-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
        }
        .card-glass {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .progress-bar-bg {
            background: rgba(255,255,255,0.08);
        }
        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">

    <!-- ENCABEZADO -->
    <header class="gradient-header py-10 px-6 text-center shadow-2xl">
        <p class="text-blue-400 text-sm font-semibold tracking-widest uppercase mb-1">Universidad Tecnológica de Panamá</p>
        <h1 class="text-4xl font-bold text-white mb-1">Sistema de Calificaciones</h1>
        <p class="text-gray-400 text-sm">Desarrollo de Software VII — Grupo 2GS231</p>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-10">
        <?php if (!$formularioEnviado || empty($estudiantes)): ?>
            <!-- Mostrar formulario de registro (Módulo 1 - Juan) -->
            <?php require_once 'modulos/modulo1_registro.php'; ?>
        <?php else: ?>
            <!-- Mostrar reporte de resultados (Módulo 5 - José) -->
            <?php require_once 'modulos/modulo5_reporte.php'; ?>
        <?php endif; ?>
    </main>

    <footer class="text-center py-6 text-gray-600 text-xs border-t border-gray-800 mt-10">
        Universidad Tecnológica de Panamá — Desarrollo de Software VII 
    </footer>

</body>
</html>