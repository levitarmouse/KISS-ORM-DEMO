<?php

function autoloadPSR_0($sFullClassName) {
    $path = realpath(__DIR__ . "/../") . "/";

    $path .= 'src/';

    $aSteps = explode('\\', $sFullClassName);
    if ($aSteps) {
        $sFile = $path . implode('/', $aSteps) . '.php';

        if (file_exists($sFile)) {
            require_once $sFile;
            return;
        }
    }
}

spl_autoload_register('autoloadPSR_0');
