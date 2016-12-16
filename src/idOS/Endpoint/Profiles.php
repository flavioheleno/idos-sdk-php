<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint;

/**
 * Profiles Class Endpoint.
 */
class Profiles extends AbstractEndpoint
{
    /**
     * Lists all Profiles.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret1585418938d706 = $this->sendGet('/profiles', $filters);
        if (! is_array($ret1585418938d706)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938d706) . ' given');
        }

        return $ret1585418938d706;
    }
}
