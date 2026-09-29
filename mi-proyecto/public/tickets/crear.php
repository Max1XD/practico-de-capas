<?php
// CAPA DE PRESENTACIÓN — Formulario alta de Ticket
// Responsabilidades: mostrar el formulario, recibir datos,
// delegar la creación y mostrar el resultado.

require_once __DIR__ . '/../../negocio/Ticket.php';
require_once __DIR__ . '/../../datos/TicketRepository.php';

$mensaje = '';
$exito   = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo      = trim($_POST['titulo']      ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    if ($titulo === '' || $descripcion === '') {
        $mensaje = 'Por favor completá todos los campos.';
    } else {
        try {
            // Capa de negocio: crea el Ticket (el estado se asigna en el constructor)
            $ticket = new Ticket($titulo, $descripcion);

            // Capa de persistencia: guarda en la base de datos
            $repo = new TicketRepository();
            $repo->guardar($ticket);

            $exito   = true;
            $mensaje = '✔ Ticket creado correctamente con estado: <strong>'
                     . htmlspecialchars($ticket->getEstado()) . '</strong>';

        } catch (Exception $e) {
            $mensaje = '✖ Error al guardar el ticket: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ticket</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 40px 16px;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,.1);
            padding: 36px 32px;
            width: 100%;
            max-width: 480px;
        }

        h1 {
            font-size: 1.4rem;
            color: #1e293b;
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-size: .875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 4px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 1rem;
            color: #1e293b;
            outline: none;
            transition: border-color .2s;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.15);
        }

        .campo { margin-bottom: 18px; }

        textarea { resize: vertical; min-height: 100px; }

        button {
            width: 100%;
            padding: 11px;
            background: #2563eb;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background .2s;
        }

        button:hover { background: #1d4ed8; }

        .alerta {
            padding: 12px 14px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: .9rem;
        }

        .alerta.ok    { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alerta.error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    </style>
</head>
<body>
    <div class="card">
        <h1>🎫 Crear nuevo Ticket</h1>

        <?php if ($mensaje): ?>
            <div class="alerta <?= $exito ? 'ok' : 'error' ?>">
                <?= $mensaje ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">

            <div class="campo">
                <label for="titulo">Título</label>
                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    placeholder="Ej: Error en el módulo de pagos"
                    value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>"
                    required
                >
            </div>

            <div class="campo">
                <label for="descripcion">Descripción</label>
                <textarea
                    id="descripcion"
                    name="descripcion"
                    placeholder="Describí el problema con el mayor detalle posible..."
                    required
                ><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>
            </div>

            <button type="submit">Crear Ticket</button>

        </form>
    </div>
</body>
</html>
