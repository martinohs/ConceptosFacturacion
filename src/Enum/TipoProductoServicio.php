<?php

namespace App\Enum;

/**
 * Enum para el tipo de producto/servicio
 */
enum TipoProductoServicio: string{
    case PRODUCTO = 'P';
    case SERVICIO = 'S';

    public static function values(): array
    {
        return array_map(fn($e) => $e->value, self::cases());
    }
    
}