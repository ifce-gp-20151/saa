<?php

namespace Application\Service;

use Core\Service\Service;

define("PBKDF2_SALT_BYTE_SIZE", 6);

class Crypto extends Service {

    public function __construct() {}

    public function gerarHash() {
        return base64_encode(mcrypt_create_iv(PBKDF2_SALT_BYTE_SIZE, MCRYPT_DEV_URANDOM));
    }
}
