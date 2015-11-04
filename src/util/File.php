<?php
/**
 * User: Raaghu
 * Date: 05-11-2015
 * Time: AM 02:37
 */

namespace icircle\util;


class File{

    static function emptyDir($path){
        if(file_exists($path)){
            if(is_dir($path)){
                $children = array_diff(scandir($path),array('.','..'));
                foreach($children as $child){
                    self::emptyDir($path.'/'.$child);
                }
                rmdir($path);
            }elseif(is_file($path)) {
                unlink($path);
            }
        }
    }
}