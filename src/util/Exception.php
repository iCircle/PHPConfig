<?php
/**
 * User: Raaghu
 * Date: 09-11-2015
 * Time: PM 03:44
 */

namespace icircle\util;


abstract class Exception extends \Exception{
    function __construct($message = "",$code = 0,\Exception $previous = null){
        parent::__construct($message,$code,$previous);

        $errorLogFile = Settings::getSettings("icircle/php-utils","errorLogFile");
        if(isset($errorLogFile)){
            if(!file_exists(dirname($errorLogFile))){
                mkdir(dirname($errorLogFile), 0777, true);
            }
            error_log($message."\n",3,$errorLogFile);
            error_log($this->getTraceAsString()."\n",3,$errorLogFile);
        }
    }
}