<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

include_once dirname(__FILE__).'/../vendor/autoload.php';

$classLoader = new \Composer\Autoload\ClassLoader();
$classLoader->addPsr4("icircle\\tests\\util\\",dirname(__FILE__).'/util',true);
$classLoader->register();
