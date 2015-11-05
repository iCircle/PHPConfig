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
                self::delete($path.'/'.$child,$force);
            }
        }
    }

    static function copy($source,$target,$force = false){
        if(file_exists($source)){
            $source = realpath($source);
            if($force){
                chmod(dirname($source),0777);
                chmod($source,0777);
            }
            if(is_dir($source)){
                if(!file_exists($target)){
                    // create target dir if not exists
                    mkdir($target,0777,true);
                }
                $children = array_diff(scandir($source),array('.','..'));
                foreach($children as $child){
                    self::copy($source.'/'.$child,$target.'/'.$child,$force);
                }
            }elseif(is_file($source)) {
                copy($source,$target);
            }
        }
    }

    static function move($source,$target,$force = false){
        if(file_exists($source)){
            $source = realpath($source);
            if($force){
                chmod(dirname($source),0777);
                chmod($source,0777);
            }
            if(is_dir($source)){
                if(!file_exists($target)){
                    // create target dir if not exists
                    mkdir($target,0777,true);
                }
                $children = array_diff(scandir($source),array('.','..'));
                foreach($children as $child){
                    self::move($source.'/'.$child,$target.'/'.$child,$force);
                }
                rmdir($source);
            }elseif(is_file($source)) {
                rename($source,$target);
            }
        }
    }

    static function delete($path,$force = false){
        if(file_exists($path)){
            $path = realpath($path);
            if($force){
                chmod(dirname($path),0777);
                chmod($path,0777);
            }
            if(is_dir($path)){
                $children = array_diff(scandir($path),array('.','..'));
                foreach($children as $child){
                    self::delete($path.'/'.$child,$force);
                }
                rmdir($path);
            }elseif(is_file($path)) {
                unlink($path);
            }
        }
    }

}