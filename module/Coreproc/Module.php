<?php
/**
 * Coreproc\CryptoGuard
 *
 * @link      https://github.com/CoreProc/crypto-guard
 * @license   The MIT License (MIT)
 */

namespace Coreproc;

class Module {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
