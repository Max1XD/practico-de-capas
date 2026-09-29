<?php
// CAPA DE NEGOCIO — Clase Ticket
// Representa el ticket y sus reglas de negocio.
// Regla principal: todo ticket nuevo nace con estado "pendiente".

class Ticket {
    private string $titulo;
    private string $descripcion;
    private string $estado;

    public function __construct(string $titulo, string $descripcion) {
        $this->titulo      = $titulo;
        $this->descripcion = $descripcion;
        $this->estado      = 'pendiente'; // regla de negocio: el usuario no elige el estado
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getEstado(): string {
        return $this->estado;
    }
}
