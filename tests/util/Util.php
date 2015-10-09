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

    static public function setSetting($setting){
        $classLoaderReflection = new \ReflectionClass(new ClassLoader());
        $vendorDir = dirname(dirname($classLoaderReflection->getFileName()));
        $thisPackageDir = dirname($vendorDir);

        $orignalSettings = file_get_contents($thisPackageDir.'/config.json');
        $orignalSettings = json_decode($orignalSettings,true);
        $settings = array_replace_recursive($orignalSettings,$setting);

        $settings = json_encode($settings);

        $composerJson = file_get_contents($thisPackageDir.'/composer.json');
        $composerJson = json_decode($composerJson,true);
        $thisPackageName = $composerJson["name"];

        if(!file_exists($vendorDir.'/'.$thisPackageName)){
            mkdir($vendorDir.'/'.$thisPackageName,0700,true);
        }

        file_put_contents($vendorDir.'/'.$thisPackageName.'/config.json',$settings);
    }

}