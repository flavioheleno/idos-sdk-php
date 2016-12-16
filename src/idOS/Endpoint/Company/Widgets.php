<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Company;

/**
 * Widget Class Endpoint.
 */
class Widgets extends AbstractCompanyEndpoint
{
    /**
     * List all widgets.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = [])
    {
        $ret158541893746bd = $this->sendGet(sprintf('/companies/%s/widgets', $this->companySlug), $filter);
        if (! is_array($ret158541893746bd)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret158541893746bd) . ' given');
        }

        return $ret158541893746bd;
    }
    /**
     * Retrieves a widget given its hash.
     *
     * @param string $hash
     *
     * @return array Response
     */
    public function getOne($hash)
    {
        if (! is_string($hash)) {
            throw new \InvalidArgumentException('Argument $hash passed to getOne() must be of the type string, ' . (gettype($hash) == 'object' ? get_class($hash) : gettype($hash)) . ' given');
        }
        $ret15854189374952 = $this->sendGet(sprintf('/companies/%s/widgets/%s', $this->companySlug, $hash));
        if (! is_array($ret15854189374952)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189374952) . ' given');
        }

        return $ret15854189374952;
    }
}
