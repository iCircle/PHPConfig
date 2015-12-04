<?php
/**
 * User: Raaghu
 * Date: 09-11-2015
 * Time: PM 03:44
 */

namespace icircle\util;


use Composer\Autoload\ClassLoader;

abstract class Exception extends \Exception{
    function __construct($message = "",$code = 0,\Exception $previous = null){
        parent::__construct($message,$code,$previous);

        $errorLogFile = Settings::getSettings("icircle/php-utils","errorLogFile");
        if(isset($errorLogFile)){
            $classLoaderReflection = new \ReflectionClass(new ClassLoader());
            $baseDir = dirname(dirname(dirname($classLoaderReflection->getFileName())));

            $errorLogFilePath = $baseDir.'/'.$errorLogFile;
            $filePaths = array_diff(explode("/",dirname($errorLogFile)),array("","/","\\"));
            $curPath = $baseDir;
            foreach($filePaths as $filePath){
                if(!is_dir($curPath."/".$filePath)){
                    chmod($curPath,0777);
                    mkdir($curPath."/".$filePath);
                }
                $curPath = $curPath."/".$filePath;
            }
            error_log($message."\n",3,$errorLogFilePath);
            error_log($this->getTraceAsString()."\n",3,$errorLogFilePath);
        }
    }
}