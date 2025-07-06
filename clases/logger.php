<?php
class Logger {
    private static $logFile = __DIR__ . '/registro.log'; // Puedes cambiar la ruta

    public static function log($nivel, $mensaje) {
        $fecha = date('Y-m-d H:i:s');
        $entrada = "[$fecha] [$nivel] $mensaje" . PHP_EOL;
        file_put_contents(self::$logFile, $entrada, FILE_APPEND);
    }

    public static function info($mensaje) {
        self::log('INFO', $mensaje);
    }

    public static function warning($mensaje) {
        self::log('WARNING', $mensaje);
    }

    public static function error($mensaje) {
        self::log('ERROR', $mensaje);
    }

    public static function debug($mensaje) {
        self::log('DEBUG', $mensaje);
    } 
}