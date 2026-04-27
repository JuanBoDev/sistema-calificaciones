<?php
/*
 * Módulo 5 — Reporte final visual
 * Desarrollado por: JD (panel de resumen) y JB (tabla de resultados)
 *
 * Descripción: Renderiza el reporte completo usando Tailwind CSS.
 * Recibe las variables directamente desde index.php via require_once:
 *   - $estudiantes[]
 *   - $promedioGeneral
 *   - $totalAprobados
 *   - $totalReprobados
 *   - $mejorEstudiante
 *   - $peorEstudiante
 *   - $errores[]
 *
 * Las funciones evaluarEstado() y colorEstado() vienen de modulo4_flujo.php
 * que index.php ya cargó antes.
 */
?>

<!-- Advertencias de filas omitidas -->
<?php if (!empty($errores)): ?>
<div class="bg-yellow-900 border border-yellow-600 rounded-xl p-4 mb-6">
    <p class="font-bold text-yellow-300 mb-2">⚠️ Algunas filas fueron omitidas:</p>
    <?php foreach ($errores as $error): ?>
        <p class="text-yellow-200 text-sm">• <?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- ──────────────────────────────────────────────────────────────────────────
     PANEL DE RESUMEN — Desarrollado por: JD
     ────────────────────────────────────────────────────────────────────────── -->
<section class="mb-10">
    <h2 class="text-2xl font-bold text-blue-400 mb-6 flex items-center gap-2">
        📊 <span>Panel de Resumen</span>
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-4">
        <div class="card-glass rounded-xl p-4 text-center">
            <p class="text-gray-400 text-sm">Promedio General</p>
            <p class="text-2xl font-bold text-blue-400"><?= number_format($promedioGeneral, 2) ?></p>
        </div>
        <div class="card-glass rounded-xl p-4 text-center">
            <p class="text-gray-400 text-sm">Aprobados</p>
            <p class="text-2xl font-bold text-green-400"><?= $totalAprobados ?></p>
        </div>
        <div class="card-glass rounded-xl p-4 text-center">
            <p class="text-gray-400 text-sm">Reprobados</p>
            <p class="text-2xl font-bold text-red-400"><?= $totalReprobados ?></p>
        </div>
        <?php if ($mejorEstudiante): ?>
        <div class="card-glass rounded-xl p-4 text-center border border-green-800">
            <p class="text-gray-400 text-sm">🏆 Mejor Estudiante</p>
            <p class="text-md font-semibold text-green-400"><?= htmlspecialchars($mejorEstudiante['nombre']) ?></p>
            <p class="text-sm text-gray-400"><?= number_format($mejorEstudiante['promedio'], 2) ?></p>
        </div>
        <?php endif; ?>
        <?php if ($peorEstudiante): ?>
        <div class="card-glass rounded-xl p-4 text-center border border-red-800">
            <p class="text-gray-400 text-sm">📉 Peor Estudiante</p>
            <p class="text-md font-semibold text-red-400"><?= htmlspecialchars($peorEstudiante['nombre']) ?></p>
            <p class="text-sm text-gray-400"><?= number_format($peorEstudiante['promedio'], 2) ?></p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ──────────────────────────────────────────────────────────────────────────
     TABLA DE RESULTADOS 
     ────────────────────────────────────────────────────────────────────────── -->
<section class="mb-10">
    <h2 class="text-2xl font-bold text-blue-400 mb-6 flex items-center gap-2">
        📋 <span>Tabla de Resultados</span>
    </h2>
    <div class="card-glass rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-800 text-gray-400 text-xs uppercase tracking-wider">
                        <th class="py-4 px-4 text-left">Estudiante</th>
                        <th class="py-4 px-4 text-center">Nota 1</th>
                        <th class="py-4 px-4 text-center">Nota 2</th>
                        <th class="py-4 px-4 text-center">Nota 3</th>
                        <th class="py-4 px-4 text-center">Promedio</th>
                        <th class="py-4 px-4 text-center">Letra</th>
                        <th class="py-4 px-4 text-center">Escala</th>
                        <th class="py-4 px-4 text-center">Progreso</th>
                        <th class="py-4 px-4 text-center">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Módulo 3 — foreach: recorre el arreglo de estudiantes -->
                    <?php foreach ($estudiantes as $est):
                        $estado     = evaluarEstado($est['promedio']);
                        $color      = colorEstado($estado);
                        $esAprobado = $estado === 'Aprobado';
                    ?>
                    <tr class="border-b border-gray-800 <?= $esAprobado ? 'hover:bg-green-950 hover:bg-opacity-40' : 'hover:bg-red-950 hover:bg-opacity-40' ?> transition">
                        <td class="py-4 px-4 font-semibold text-white"><?= htmlspecialchars($est['nombre']) ?></td>
                        <td class="py-4 px-4 text-center text-gray-300"><?= $est['nota1'] ?></td>
                        <td class="py-4 px-4 text-center text-gray-300"><?= $est['nota2'] ?></td>
                        <td class="py-4 px-4 text-center text-gray-300"><?= $est['nota3'] ?></td>
                        <td class="py-4 px-4 text-center font-bold text-white text-base"><?= number_format($est['promedio'], 2) ?></td>
                        <td class="py-4 px-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full font-bold text-sm
                                <?= $esAprobado ? 'bg-green-700 text-green-100' : 'bg-red-700 text-red-100' ?>">
                                <?= $est['letra'] ?>
                            </span>
                        </td>
                        <td class="py-4 px-4 text-center text-gray-300 text-xs"><?= $est['escala'] ?></td>
                        <td class="py-4 px-4 w-36">
                            <!-- Módulo 3 — for: barra de progreso proporcional al promedio -->
                            <div class="progress-bar-bg rounded-full h-3 w-full overflow-hidden">
                                <?php
                                    $porcentaje = (int)$est['promedio'];
                                    $colorBarra = $esAprobado ? 'bg-green-500' : 'bg-red-500';
                                ?>
                                <?php for ($b = 0; $b < 1; $b++): ?>
                                <div class="<?= $colorBarra ?> h-3 rounded-full"
                                     style="width: <?= $porcentaje ?>%">
                                </div>
                                <?php endfor; ?>
                            </div>
                            <p class="text-gray-500 text-xs text-right mt-1"><?= $porcentaje ?>%</p>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <?php if ($esAprobado): ?>
                                <span class="bg-green-900 text-green-300 border border-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                    ✓ Aprobado
                                </span>
                            <?php else: ?>
                                <span class="bg-red-900 text-red-300 border border-red-700 text-xs font-bold px-3 py-1 rounded-full">
                                    ✗ Reprobado
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ──────────────────────────────────────────────────────────────────────────
     LISTADO DE REPROBADOS
     ────────────────────────────────────────────────────────────────────────── -->
<section class="mb-10">
    <h2 class="text-2xl font-bold text-red-400 mb-4 flex items-center gap-2">
        ⚠️ <span>Listado de Reprobados</span>
    </h2>

    <?php
    $reprobados = array_values(array_filter($estudiantes, fn($e) => evaluarEstado($e['promedio']) === 'Reprobado'));
    ?>

    <?php if (count($reprobados) > 0): ?>
    <div class="card-glass rounded-2xl p-6 border border-red-900">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php
            // Módulo 3 — do...while: garantiza al menos una iteración del bloque
            $idxDo = 0;
            do {
                $rep = $reprobados[$idxDo];
                echo '<div class="bg-red-900/20 border border-red-800 rounded-lg p-4 hover:bg-red-900/30 transition">';
                echo '<p class="font-semibold text-red-300">' . htmlspecialchars($rep['nombre']) . '</p>';
                echo '<p class="text-sm text-gray-300">Promedio: ' . number_format($rep['promedio'], 2) . '</p>';
                echo '<p class="text-xs text-red-400">Letra: ' . $rep['letra'] . ' | Escala: ' . $rep['escala'] . '</p>';
                echo '</div>';
                $idxDo++;
            } while ($idxDo < count($reprobados));
        ?>
        </div>
    </div>
    <?php else: ?>
    <div class="card-glass rounded-2xl p-6 border border-green-900 text-center">
        <p class="text-green-400 text-lg font-semibold">🎉 ¡Todos los estudiantes aprobaron!</p>
    </div>
    <?php endif; ?>
</section>

<!-- Botón para volver -->
<div class="text-center mt-6">
    <a href="/sistema-calificaciones/index.php"
       class="inline-block bg-blue-700 hover:bg-blue-600 text-white font-bold px-8 py-3 rounded-xl transition shadow-lg">
        ← Registrar nuevo grupo
    </a>
</div>

<!-- Pie de página -->
<div class="text-center mt-12 pt-6 border-t border-gray-800 text-gray-500 text-sm">
    <p>Sistema de Gestión de Calificaciones Estudiantiles — UTP</p>
</div>