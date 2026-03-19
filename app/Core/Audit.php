<?php

namespace App\Core;

class Audit
{
    public static function log(string $accion, string $tabla, ?int $registroId = null, $detalle = null): void
    {
        try {
            $db = Database::getInstance();
            $user = Session::get('user');
            
            $data = [
                'usuario_id'  => $user ? $user['id'] : null,
                'accion'      => $accion,
                'tabla'       => $tabla,
                'registro_id' => $registroId,
                'detalle'     => is_array($detalle) ? json_encode($detalle) : $detalle,
                'ip'          => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
                'endpoint'    => $_SERVER['REQUEST_URI'] ?? '',
                'metodo'      => $_SERVER['REQUEST_METHOD'] ?? ''
            ];

            $db->execute("
                INSERT INTO auditoria (usuario_id, accion, tabla, registro_id, detalle, ip, endpoint, metodo, created_at)
                VALUES (:usuario_id, :accion, :tabla, :registro_id, :detalle, :ip, :endpoint, :metodo, NOW())
            ", $data);
        } catch (\Exception $e) {
            error_log("Audit Error: " . $e->getMessage());
        }
    }
}
