<?php
/**
 * MÓDULO 4: FLUJO - FUNCIONES, BREAK, CONTINUE, EXIT
 * Autor: JD
 * Descripción: Funciones para evaluar estado de estudiantes
 */

// Función para evaluar si está aprobado o reprobado
function evaluarEstado(float $promedio): string {
    // Módulo 4 - Uso de condicional if/else
    if ($promedio >= 61) {
        return "Aprobado";
    } else {
        return "Reprobado";
    }
}

// Función para retornar el color según el estado (para Tailwind)
function colorEstado(string $estado): string {
    // Módulo 4 - Uso de switch
    switch ($estado) {
        case "Aprobado":
            return "green";
        case "Reprobado":
            return "red";
        default:
            return "gray";
    }
}

// NOTA: Este archivo solo define funciones.
// Los datos vienen del módulo 3 y se procesan en el módulo 5.
?>