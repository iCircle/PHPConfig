<?php
/**
 * User: Raaghu
 * Date: 03-10-2015
 * Time: PM 10:59
 */

namespace icircle\tests\util;

use Composer\Autoload\ClassLoader;

/**
 * Class Util
 *
 * A utility class for tescases
 *
 * @package icircle\tests\util
 */
class Util{

    static public function setSetting($setting,$package = null){
        $classLoaderReflection = new \ReflectionClass(new ClassLoader());
        $vendorDir = dirname(dirname($classLoaderReflection->getFileName()));
        $thisPackageDir = dirname($vendorDir);

        if($package == null){
            $composerJson = file_get_contents($thisPackageDir.'/composer.json');
            $composerJson = json_decode($composerJson,true);
            $package = $composerJson["name"];
            $originalSettingsDir = $thisPackageDir;
        }

        if(!isset($originalSettingsDir)){
            $originalSettingsDir = $vendorDir.'/'.$package;
        }

        $targetSettingsDir   = $vendorDir.'/'.$package;

        if(file_exists($originalSettingsDir.'/config.json.orig')){
            $originalSettingsStr = file_get_contents($originalSettingsDir.'/config.json.orig');
        }else{
            $originalSettingsStr = file_get_contents($originalSettingsDir.'/config.json');
        }

        $originalSettings = json_decode($originalSettingsStr,true);

        $settings = array_replace_recursive($originalSettings,$setting);
        $settings = json_encode($settings);

        if(!file_exists($targetSettingsDir)){
            mkdir($targetSettingsDir,0700,true);
        }

        //take a backup of original settings
        if($originalSettingsDir == $targetSettingsDir){
            file_put_contents($targetSettingsDir.'/config.json.orig',$originalSettingsStr);
        }

        file_put_contents($targetSettingsDir.'/config.json',$settings);
    }

}