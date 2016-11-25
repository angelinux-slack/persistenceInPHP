<?php
/**
 * @author      Horacio Romero Méndez <horacio@consoluciones.com.mx>
 * @copyright   Copyleft 2016, Angelos Rosemary
 * @version     1.0 25/11/2016 11:25
 * @Project     persistenceInPHP
 * @File        person.php
 * @Internal    Host: MintOS
 *              Kernel: 3.16.0-38-generic x86_64 (64 bit)
 *              Desktop: MATE 1.10.0
 *              Distro: Linux Mint 17.2 Rafaela
 *              IDE: phpStorm
 */

@session_start();
include_once("../../init.php");

class person
{

    private static $name;
    private static $address;
    private static $tels;
    private static $email;

    /**
     * INIT CLASS
     */
    public static function start()
    {
        foreach (get_class_vars(__CLASS__) as $nombre => $valor)
            self::getValue($nombre);
    }

    /**
     * GET VARS
     * @VAR CAMPO: FIELD NAME
     * @RETURN MIXED
     */
    public static function getValue($campo)
    {
        return init::getPersist(__CLASS__, "$campo");
    }

    /**
     * CLEAN CLASS
     * @VAR CLASE: PARENT CLASS NAME (OPTIONAL)
     */
    public static function reset($clase = "")
    {
        $clase = ($clase == "") ? __CLASS__ : $clase;
        foreach (get_class_vars($clase) as $nombre => $valor)
            self::setValue($nombre, "", $clase);

        if (get_parent_class())
            parent::reset($clase);
    }

    /**
     * ASIGN VARS
     * @VAR CAMPO: FIELD NAME
     * @VAR VALOR: FIELD VALUE
     * @VAR CLASE: CHILDREN CLASS (OPTIONAL)
     * @RETURN NULL
     */
    public static function setValue($campo, $valor = "", $clase = "")
    {
        try {
            $clase = ($clase == "") ? __CLASS__ : $clase;
            init::setPersist($clase, $campo, $valor);
            if (array_key_exists($campo, get_class_vars($clase)))
                self::$$campo = $valor;
            elseif (get_parent_class($clase) != FALSE)
                parent::setValue($campo, $valor, $clase);
            else
                throw new Exception("Error: no existe la propiedad $campo en " . $clase, 1);

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }

    }


}