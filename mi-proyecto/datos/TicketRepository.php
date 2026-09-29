<?php
// CAPA DE PERSISTENCIA — Repositorio de Tickets
// Toda consulta SQL vive aquí, nunca en el formulario.

require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/../negocio/Ticket.php';

class TicketRepository {

    public function guardar(Ticket $ticket): bool {
        $pdo = Conexion::obtener();

        $sql = "INSERT INTO ticket (titulo, descripcion, estado)
                VALUES (:titulo, :descripcion, :estado)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':titulo'      => $ticket->getTitulo(),
            ':descripcion' => $ticket->getDescripcion(),
            ':estado'      => $ticket->getEstado(),
        ]);
    }
}
