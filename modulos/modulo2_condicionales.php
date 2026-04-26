<?php
/**
 * Módulo 2 - Condicionales
 * Desarrollado por: AC
 * 
 * Procesa los datos del formulario:
 * - Lee nombres y notas del POST
 * - Valida y filtra con continue
 * - Calcula promedios
 * - Asigna escala con if/elseif/else
 * - Asigna letra con switch
 * - Llena el arreglo $estudiantes[]
 */

// Si no hay datos POST, no hacer nada
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    return;
}

// 1. Leer los datos del formulario
$nombres = $_POST["nombre"] ?? [];
$notas1 = $_POST["nota1"] ?? [];
$notas2 = $_POST["nota2"] ?? [];
$notas3 = $_POST["nota3"] ?? [];

// Inicializar arreglos
$estudiantes = [];
$errores = [];

// 2. Validar que haya al menos un nombre válido
$hayAlgunNombre = false;
foreach ($nombres as $nombre) {
    if (!empty(trim($nombre))) {
        $hayAlgunNombre = true;
        break;
    }
}

if (!$hayAlgunNombre) {
    die("Error: Debe ingresar al menos un estudiante.");
}

// 3. Recorrer cada estudiante
for ($i = 0; $i < count($nombres); $i++) {
    $nombre = trim($nombres[$i]);
    
    // Usar continue para omitir filas vacías
    if (empty($nombre)) {
        continue;
    }
    
    $n1 = trim($notas1[$i] ?? "");
    $n2 = trim($notas2[$i] ?? "");
    $n3 = trim($notas3[$i] ?? "");
    
    // Validar que las notas no estén vacías
    if ($n1 === "" || $n2 === "" || $n3 === "") {
        $errores[] = "El estudiante '$nombre' tiene notas incompletas.";
        continue;
    }
    
    $nota1 = (float)$n1;
    $nota2 = (float)$n2;
    $nota3 = (float)$n3;
    
    // Validar rango de notas (0-100)
    if ($nota1 < 0 || $nota1 > 100 || $nota2 < 0 || $nota2 > 100 || $nota3 < 0 || $nota3 > 100) {
        $errores[] = "El estudiante '$nombre' tiene notas fuera del rango (0-100).";
        continue;
    }
    
    // 4. Calcular promedio
    $promedio = ($nota1 + $nota2 + $nota3) / 3;
    $promedio = round($promedio, 2);
    
    // 5. Asignar ESCALA usando if/elseif/else
    if ($promedio >= 91 && $promedio <= 100) {
        $escala = "Sobresaliente";
    } elseif ($promedio >= 71 && $promedio <= 90) {
        $escala = "Bueno";
    } elseif ($promedio >= 61 && $promedio <= 70) {
        $escala = "Regular";
    } elseif ($promedio >= 51 && $promedio <= 60) {
        $escala = "Bajo";
    } else {
        $escala = "Reprobado";
    }
    
    // 6. Asignar LETRA usando switch
    $promedioEntero = (int)$promedio;
    switch (true) {
        case ($promedioEntero >= 90):
            $letra = "A";
            break;
        case ($promedioEntero >= 80):
            $letra = "B";
            break;
        case ($promedioEntero >= 70):
            $letra = "C";
            break;
        case ($promedioEntero >= 60):
            $letra = "D";
            break;
        default:
            $letra = "F";
            break;
    }
    
    // Obtener estado usando función de modulo4_flujo.php
    $estado = evaluarEstado($promedio);
    
    // 7. Llenar arreglo $estudiantes[]
    $estudiantes[] = [
        'nombre' => $nombre,
        'nota1' => $nota1,
        'nota2' => $nota2,
        'nota3' => $nota3,
        'promedio' => $promedio,
        'escala' => $escala,
        'letra' => $letra,
        'estado' => $estado
    ];
}

// Guardar en variables globales
$GLOBALS['estudiantes'] = $estudiantes;
$GLOBALS['errores'] = $errores;
?>