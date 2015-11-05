<?php
/**
 * User: Raaghu
 * Date: 05-11-2015
 * Time: AM 02:37
 */

namespace icircle\util;


class File{

    static function emptyDir($path,$force = false){
        if(is_dir($path)){
            $children = array_diff(scandir($path),array('.','..'));
            foreach($children as $child){
                self::deletePath($path.'/'.$child,$force);
            }
        }
    }

    private static function deletePath($path,$force = false){
        if(file_exists($path)){
            $path = realpath($path);
            if($force){
                chmod(dirname($path),0777);
                chmod($path,0777);
            }
            if(is_dir($path)){
                $children = array_diff(scandir($path),array('.','..'));
                foreach($children as $child){
                    self::deletePath($path.'/'.$child);
                }
                rmdir($path);
            }elseif(is_file($path)) {
                unlink($path);
            }
        }
    }

}