<?php
/**
 * User: Raaghu
 * Date: 17-09-2015
 * Time: PM 10:22
 */

namespace icircle\util;

class Cache{
    private static $iTtl = 0; // Time To Live

    // get data from memory
    public static function getData($sKey) {
        $bRes = false;
        $vData = apc_fetch($sKey, $bRes);
        return ($bRes) ? $vData :null;
    }

    // save data to memory
    public static function setData($sKey, $vData) {
        return apc_store($sKey, $vData, self::$iTtl);
    }

    // delete data from memory
    public static function delData($sKey) {
        return (apc_exists($sKey)) ? apc_delete($sKey) : true;
    }
}

?>
