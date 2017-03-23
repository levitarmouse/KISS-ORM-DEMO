<?php

function demoAutoloaderPSR0($sFullClassName) {
    $path = realpath(__DIR__ . "/../") . "/";

    $paths = array();
    $paths[] =  'src/';
    $paths[] =  'vendor/';

    $aSteps = explode('\\', $sFullClassName);
    if ($aSteps) {
        foreach ($paths as $ruta ) {
            $sFile = $ruta . implode('/', $aSteps) . '.php';

            if (file_exists($sFile)) {
                require_once $sFile;
                return;
            }            
        }
    }
}

spl_autoload_register('demoAutoloaderPSR0');
