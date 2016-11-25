<?php

/**
 * @author      Horacio Romero Méndez <horacio@consoluciones.com.mx>
 * @copyright   Copyleft 2016, Angelos Rosemary
 * @version     1.0 25/11/2016 11:23
 * @Project     persistenceInPHP
 * @File        init.php
 * @Internal    Host: MintOS
 *              Kernel: 3.16.0-38-generic x86_64 (64 bit)
 *              Desktop: MATE 1.10.0
 *              Distro: Linux Mint 17.2 Rafaela
 *              IDE: phpStorm
 */
class init
{

    public static function setPersist($clase, $var, $valor)
    {
        @session_start();
        if (is_array($valor)) $valor = json_encode($valor);
        $_SESSION["{$clase}_{$var}"] = self::setData($valor);
    }

    private static function setData($valor)
    {
        return base64_encode(filter_var($valor, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    }

    public static function getPersist($clase, $var)
    {
        @session_start();
        return (self::isJson(self::getData($clase, $var))) ? json_decode(self::getData($clase, $var), true) : self::getData($clase, $var);
    }

    /**
     * @param $string
     * @return bool
     * http://subinsb.com/php-check-if-string-is-json
     */
    private static function isJson($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

    private static function getData($clase, $var)
    {
        return filter_var(base64_decode(@$_SESSION["{$clase}_{$var}"]), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    }

    public static function clonar($ruta, $nombre)
    {

        try {
            if (!file_exists($ruta))
                die("Clase original no existe");

            $origen = file_get_contents($ruta);
            $rutaOrigen = pathinfo($ruta);
            $nombreOrigen = $rutaOrigen["filename"];
            $nuevo = str_replace("class $nombreOrigen", "class $nombre", $origen);
            $clase = sys_get_temp_dir() . "/{$nombre}.class";

            file_put_contents($clase, $nuevo);

            include_once($clase);

            $objClonado = new $nombre;

            unlink($clase);

            return $objClonado;
        } catch (Exception $e) {
            @unlink($clase);
        }
    }
}

?>