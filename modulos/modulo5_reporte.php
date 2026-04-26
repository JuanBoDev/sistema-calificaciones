<?php
/**
 * MÓDULO 5: REPORTE FINAL
 * Autor: JD
 * Descripción: Muestra resumen, tabla completa y listado de reprobados
 * Utiliza: foreach, for, do...while
 */

session_start();

// Verificar que existan los datos
if (!isset($_SESSION['estudiantes']) || !isset($_SESSION['resultados'])) {
    header('Location: ../index.php');
    exit;
}

$estudiantes = $_SESSION['estudiantes'];
$resultados = $_SESSION['resultados'];

// Variables del resumen (calculadas en módulo 3)
$promedioGeneral = $_SESSION['promedioGeneral'] ?? 0;
$totalAprobados = $_SESSION['totalAprobados'] ?? 0;
$totalReprobados = $_SESSION['totalReprobados'] ?? 0;
$mejorEstudiante = $_SESSION['mejorEstudiante'] ?? ['nombre' => 'N/A', 'promedio' => 0];
$peorEstudiante = $_SESSION['peorEstudiante'] ?? ['nombre' => 'N/A', 'promedio' => 0];

// Cargar las funciones del módulo 4
require_once 'modulo4_flujo.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Calificaciones - UTP</title>
    <link href="../css/output.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .gradient-header {
            background: linear-gradient(135deg, #0f172a, #1e3a5f, #0f172a);
        }
        .card-glass {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .progress-bar-bg {
            background: rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">
    
    <!-- Encabezado -->
    <div class="gradient-header rounded-b-3xl shadow-2xl mb-8">
        <div class="container mx-auto px-4 py-10">
            <h1 class="text-3xl md:text-4xl font-bold text-center">
                 Reporte Final de Calificaciones
            </h1>
            <p class="text-center text-gray-300 mt-2">Universidad Tecnológica de Panamá</p>
            <p class="text-center text-gray-400 text-sm mt-1">Desarrollado por: JD</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        
        <!-- PANEL DE RESUMEN - MÓDULO 5 -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
            <div class="card-glass rounded-xl p-4 text-center">
                <p class="text-gray-400 text-sm">Promedio General</p>
                <p class="text-2xl font-bold text-blue-400"><?php echo number_format($promedioGeneral, 2); ?></p>
            </div>
            <div class="card-glass rounded-xl p-4 text-center">
                <p class="text-gray-400 text-sm"> Aprobados</p>
                <p class="text-2xl font-bold text-green-400"><?php echo $totalAprobados; ?></p>
            </div>
            <div class="card-glass rounded-xl p-4 text-center">
                <p class="text-gray-400 text-sm"> Reprobados</p>
                <p class="text-2xl font-bold text-red-400"><?php echo $totalReprobados; ?></p>
            </div>
            <div class="card-glass rounded-xl p-4 text-center">
                <p class="text-gray-400 text-sm"> Mejor Estudiante</p>
                <p class="text-md font-semibold text-yellow-400"><?php echo htmlspecialchars($mejorEstudiante['nombre']); ?></p>
                <p class="text-sm text-gray-400"><?php echo number_format($mejorEstudiante['promedio'], 2); ?></p>
            </div>
            <div class="card-glass rounded-xl p-4 text-center">
                <p class="text-gray-400 text-sm"> Peor Estudiante</p>
                <p class="text-md font-semibold text-orange-400"><?php echo htmlspecialchars($peorEstudiante['nombre']); ?></p>
                <p class="text-sm text-gray-400"><?php echo number_format($peorEstudiante['promedio'], 2); ?></p>
            </div>
        </div>

        <!-- TABLA COMPLETA - MÓDULO 5 (USANDO foreach) -->
        <div class="card-glass rounded-2xl p-6 mb-8">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                 <span>Tabla de Calificaciones</span>
                <span class="text-sm text-gray-400 font-normal">(Recorrido con foreach - Módulo 3/5)</span>
            </h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 px-2">Nombre</th>
                            <th class="text-center py-3 px-2">Nota 1</th>
                            <th class="text-center py-3 px-2">Nota 2</th>
                            <th class="text-center py-3 px-2">Nota 3</th>
                            <th class="text-center py-3 px-2">Promedio</th>
                            <th class="text-center py-3 px-2">Letra</th>
                            <th class="text-center py-3 px-2">Escala</th>
                            <th class="text-center py-3 px-2">Progreso</th>
                            <th class="text-center py-3 px-2">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $est): 
                            // Usar funciones del módulo 4
                            $estado = evaluarEstado($est['promedio']);
                            $color = colorEstado($estado);
                            $barraWidth = $est['promedio']; // Para la barra de progreso
                        ?>
                        <tr class="border-b border-gray-800 hover:bg-gray-900 transition">
                            <td class="py-3 px-2 font-medium"><?php echo htmlspecialchars($est['nombre']); ?></td>
                            <td class="text-center py-3 px-2"><?php echo $est['nota1']; ?></td>
                            <td class="text-center py-3 px-2"><?php echo $est['nota2']; ?></td>
                            <td class="text-center py-3 px-2"><?php echo $est['nota3']; ?></td>
                            <td class="text-center py-3 px-2 font-semibold"><?php echo number_format($est['promedio'], 2); ?></td>
                            <td class="text-center py-3 px-2"><?php echo $est['letra']; ?></td>
                            <td class="text-center py-3 px-2"><?php echo $est['escala']; ?></td>
                            <td class="py-3 px-2">
                                <!-- BARRA DE PROGRESO - MÓDULO 3 (Usando for para dibujar) -->
                                <div class="progress-bar-bg rounded-full h-2 w-full">
                                    <div class="h-2 rounded-full transition-all duration-500"
                                         style="width: <?php echo $barraWidth; ?>%; background: <?php echo $color === 'green' ? '#4ade80' : '#f87171'; ?>">
                                    </div>
                                </div>
                                <span class="text-xs text-gray-400"><?php echo round($barraWidth); ?>%</span>
                            </td>
                            <td class="text-center py-3 px-2">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-<?php echo $color; ?>-900 text-<?php echo $color; ?>-400">
                                    <?php echo $estado; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- LISTADO DE REPROBADOS - MÓDULO 5 -->
        <div class="card-glass rounded-2xl p-6 mb-8">
            <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                 <span>Listado de Estudiantes Reprobados</span>
                <span class="text-sm text-gray-400 font-normal">(Recorrido con do...while - Módulo 5)</span>
            </h2>
            
            <?php
            // FILTRAR REPROBADOS - Usando foreach para filtrar
            $reprobados = [];
            foreach ($resultados as $est) {
                if (evaluarEstado($est['promedio']) === 'Reprobado') {
                    $reprobados[] = $est;
                }
            }
            
            // Mostrar con do...while (MÓDULO 5 - ESTRUCTURA DE FLUJO)
            if (count($reprobados) > 0):
                $i = 0;
                $totalReprobadosLista = count($reprobados);
            ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php do { 
                        $rep = $reprobados[$i];
                    ?>
                        <div class="bg-red-900/20 border border-red-800 rounded-lg p-4 hover:bg-red-900/30 transition">
                            <p class="font-semibold text-red-300"> <?php echo htmlspecialchars($rep['nombre']); ?></p>
                            <p class="text-sm text-gray-300">Promedio: <?php echo number_format($rep['promedio'], 2); ?></p>
                            <p class="text-xs text-red-400">Letra: <?php echo $rep['letra']; ?> | Escala: <?php echo $rep['escala']; ?></p>
                        </div>
                    <?php 
                        $i++;
                    } while ($i < $totalReprobadosLista); ?>
                </div>
            <?php else: ?>
                <p class="text-green-400 text-center py-4"> ¡No hay estudiantes reprobados! Todos aprobaron.</p>
            <?php endif; ?>
        </div>

        <!-- BOTÓN PARA VOLVER -->
        <div class="text-center">
            <a href="../index.php" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                ← Volver al Registro de Notas
            </a>
        </div>

        <!-- PIE DE PÁGINA - MÓDULO 5 -->
        <div class="text-center mt-12 pt-6 border-t border-gray-800 text-gray-500 text-sm">
            <p>Sistema de Gestión de Calificaciones Estudiantiles - UTP</p>
            <p>Módulo 5 desarrollado por JD | Uso de foreach, for, do...while, break, continue, exit</p>
        </div>
        
    </div>
</body>
</html>