<?php
/**
 * Módulo 3 - Bucles
 * Desarrollado por: AC
 * 
 * Calcula estadísticas del grupo:
 * - Promedio general (while)
 * - Conteo de aprobados/reprobados (foreach)
 * - Mejor y peor estudiante (foreach)
 * - Búsqueda con for y break
 */

// Si no hay estudiantes, no hacer nada
if (!isset($GLOBALS['estudiantes']) || empty($GLOBALS['estudiantes'])) {
    return;
}

$estudiantes = $GLOBALS['estudiantes'];

// Inicializar variables
$promedioGeneral = 0;
$totalAprobados = 0;
$totalReprobados = 0;
$mejorEstudiante = null;
$peorEstudiante = null;
$sumaTotalNotas = 0;
$totalNotas = 0;

// 1. Usar WHILE para calcular promedio general
$i = 0;
while ($i < count($estudiantes)) {
    $estudiante = $estudiantes[$i];
    // Acumular las 3 notas de cada estudiante
    $sumaTotalNotas += $estudiante['nota1'] + $estudiante['nota2'] + $estudiante['nota3'];
    $totalNotas += 3;
    $i++;
}

if ($totalNotas > 0) {
    $promedioGeneral = round($sumaTotalNotas / $totalNotas, 2);
}

// 2. Usar FOREACH para contar aprobados/reprobados y detectar mejor/peor
$mejorPromedio = -1;
$peorPromedio = 101;

foreach ($estudiantes as $estudiante) {
    // Contar usando el estado de modulo4
    if (evaluarEstado($estudiante['promedio']) === "Aprobado") {
        $totalAprobados++;
    } else {
        $totalReprobados++;
    }
    
    // Detectar mejor estudiante
    if ($estudiante['promedio'] > $mejorPromedio) {
        $mejorPromedio = $estudiante['promedio'];
        $mejorEstudiante = $estudiante;
    }
    
    // Detectar peor estudiante
    if ($estudiante['promedio'] < $peorPromedio) {
        $peorPromedio = $estudiante['promedio'];
        $peorEstudiante = $estudiante;
    }
}

// 3. Usar FOR con BREAK para buscar el estudiante con promedio más alto
$mejorPromedioFor = -1;
$mejorNombreFor = null;

for ($j = 0; $j < count($estudiantes); $j++) {
    if ($estudiantes[$j]['promedio'] > $mejorPromedioFor) {
        $mejorPromedioFor = $estudiantes[$j]['promedio'];
        $mejorNombreFor = $estudiantes[$j]['nombre'];
    }
    // Si encontramos promedio perfecto, salimos con break
    if ($mejorPromedioFor == 100) {
        break;
    }
}

// Guardar resultados en variables globales
$GLOBALS['promedioGeneral'] = $promedioGeneral;
$GLOBALS['totalAprobados'] = $totalAprobados;
$GLOBALS['totalReprobados'] = $totalReprobados;
$GLOBALS['mejorEstudiante'] = $mejorEstudiante;
$GLOBALS['peorEstudiante'] = $peorEstudiante;
?>