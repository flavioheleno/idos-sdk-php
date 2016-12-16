<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint;

/**
 * Companies Class Endpoint.
 */
class Companies extends AbstractEndpoint
{
    /**
     * Lists all Companies.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret15854189371789 = $this->sendGet('/companies', $filters);
        if (! is_array($ret15854189371789)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189371789) . ' given');
        }

        return $ret15854189371789;
    }
}
