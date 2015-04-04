<?php

namespace ApplicationTest\Service;

use PHPUnit_Framework_TestCase;
use Coreproc\CryptoGuard;

class CryptoTest extends PHPUnit_Framework_TestCase {

    public function provideServiceList() {
        $config = include __DIR__ . '/../../../../config/module.config.php';
        $serviceConfig = array_merge(
            isset($config['service_manager']['invokables'])?$config['service_manager']['invokables']:array()
        );
        $services = array();
        foreach ($serviceConfig as $key => $val) {
            $services[] = array($key);
        }
        return $services;
    }

    /**
     * @dataProvider provideServiceList
     * @param [type] $service
     */
    public function testService($service) {
        $sm = \ApplicationTest\Bootstrap::getServiceManager();
        // test if service is available in SM
        $this->assertTrue($sm->has($service));
        // test if correct instance is created
        $this->assertInstanceOf($service, $sm->get($service));

        $service = $sm->get($service);
        $passphrase = $service->gerarHash();

        $stringToEncrypt = 'teste';
        $cryptoGuard = new CryptoGuard($passphrase);
        $encryptedText = $cryptoGuard->encrypt($stringToEncrypt);
        $decryptedText = $cryptoGuard->decrypt($encryptedText);

        $this->assertEquals($stringToEncrypt, $decryptedText);
    }
}
