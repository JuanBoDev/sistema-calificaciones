<?php
/*
 * Módulo 1 — Registro de estudiantes y notas
 * Desarrollado por: JB
 *
 * Descripción: Formulario HTML para ingresar hasta 10 estudiantes
 *              con sus 3 calificaciones parciales (0–100).
 *              Este archivo es incluido por index.php cuando
 *              el formulario aún no ha sido enviado.
 */
?>

<section>
    <h2 class="text-2xl font-bold text-blue-400 mb-6 flex items-center gap-2">
        📋 <span>Registro de Estudiantes</span>
    </h2>

    <!-- Advertencias de filas omitidas si las hay -->
    <?php if (!empty($errores)): ?>
    <div class="bg-yellow-900 border border-yellow-600 rounded-xl p-4 mb-6">
        <p class="font-bold text-yellow-300 mb-2">⚠️ Algunas filas fueron omitidas:</p>
        <?php foreach ($errores as $error): ?>
            <p class="text-yellow-200 text-sm">• <?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
        <p class="text-yellow-400 text-sm mt-2">Las filas válidas sí fueron procesadas.</p>
    </div>
    <?php endif; ?>

<form method="POST" action="/sistema-calificaciones/index.php" class="card-glass rounded-2xl p-6 shadow-xl">        <p class="text-gray-400 text-sm mb-6">
            Ingresa hasta <span class="text-white font-semibold">10 estudiantes</span>
            con sus 3 calificaciones parciales (0–100).
        </p>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-400 border-b border-gray-700">
                        <th class="py-3 px-3 text-left font-semibold">#</th>
                        <th class="py-3 px-3 text-left font-semibold">Nombre del Estudiante</th>
                        <th class="py-3 px-3 text-center font-semibold">Nota 1</th>
                        <th class="py-3 px-3 text-center font-semibold">Nota 2</th>
                        <th class="py-3 px-3 text-center font-semibold">Nota 3</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < 10; $i++): ?>
                    <tr class="border-b border-gray-800 hover:bg-white hover:bg-opacity-5 transition">
                        <td class="py-3 px-3 text-gray-500 font-mono"><?= $i + 1 ?></td>
                        <td class="py-3 px-3">
                            <input
                                type="text"
                                name="nombre[]"
                                placeholder="Nombre completo"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-white placeholder-gray-500 transition"
                            >
                        </td>
                        <td class="py-3 px-3">
                            <input
                                type="number"
                                name="nota1[]"
                                min="0" max="100"
                                placeholder="0–100"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-white placeholder-gray-500 text-center transition"
                            >
                        </td>
                        <td class="py-3 px-3">
                            <input
                                type="number"
                                name="nota2[]"
                                min="0" max="100"
                                placeholder="0–100"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-white placeholder-gray-500 text-center transition"
                            >
                        </td>
                        <td class="py-3 px-3">
                            <input
                                type="number"
                                name="nota3[]"
                                min="0" max="100"
                                placeholder="0–100"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-white placeholder-gray-500 text-center transition"
                            >
                        </td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-500 text-white font-bold px-8 py-3 rounded-xl transition shadow-lg hover:shadow-blue-500/30"
            >
                Procesar Calificaciones →
            </button>
        </div>
    </form>
</section>