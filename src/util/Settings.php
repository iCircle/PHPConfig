<?php
/**
 * User: Raaghu
 * Date: 22-09-2015
 * Time: PM 10:36
 */

namespace icircle\util;

use Composer\Autoload\ClassLoader;

class Settings{

    /**
     * this method retrieves settings of a package
     * settings are saved as config.json file in package root directory
     *
     * @param string $package Name of the package
     * @param string|null $setting setting to retrieve , Optional
     * @return mixed returns settings array
     * @throws \Exception if settings not found
     */
    public static function getSettings($package,$setting = null){

        $settings = Cache::getData("icircle\\utils\\Settings_".$package);
        if($settings == null){
            $classLoaderReflection = new \ReflectionClass(new ClassLoader());
            $vendorDir = dirname(dirname($classLoaderReflection->getFileName()));

            $packageConfigFile = $vendorDir.'\\'.$package.'\\config.json';

            if(!file_exists($packageConfigFile)){
                throw new \Exception("No configuration found for the package $package");
            }

            $settings = json_decode(file_get_contents($packageConfigFile),true);

            Cache::setData("icircle\\utils\\Settings_".$package,$settings);
        }

        if(is_string($setting)){
            $settingPaths = explode(".",$setting);
            foreach($settingPaths as $settingPath){
                if($settings[$settingPath] !== null && !isset($settings[$settingPath])){
                    throw new \Exception("setting $setting not found in package $package");
                }
                $settings = $settings[$settingPath];
            }
        }

        return $settings;

    }

}