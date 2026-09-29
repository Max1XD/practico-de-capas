<?php
// CAPA DE PERSISTENCIA — Conexión a la base de datos
// Patrón Singleton: una sola instancia PDO por ejecución.

require_once __DIR__ . '/../config/config.php';

class Conexion {
    private static ?PDO $instancia = null;

    private function __construct() {}

    public static function obtener(): PDO {
        if (self::$instancia === null) {
            $dsn = 'mysql:host=' . DB_HOST
                 . ';dbname='   . DB_NAME
                 . ';charset='  . DB_CHARSET;

            self::$instancia = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }
        return self::$instancia;
    }
}
