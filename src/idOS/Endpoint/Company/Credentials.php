<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Company;

/**
 * Credentials Class Endpoint.
 */
class Credentials extends AbstractCompanyEndpoint
{
    /**
     * Lists all credentials from the given company.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = [])
    {
        return $this->sendGet(sprintf('/companies/%s/credentials', $this->companySlug), $filter);
    }
    /**
     * Creates a new credential for the given company.
     *
     * @param string $name
     * @param bool   $production
     *
     * @return array Response
     */
    public function createNew($name, $production)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to createNew() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        if (! is_bool($production)) {
            throw new \InvalidArgumentException('Argument $production passed to createNew() must be of the type bool, ' . (gettype($production) == 'object' ? get_class($production) : gettype($production)) . ' given');
        }
        $ret158541893753f0 = $this->sendPost(sprintf('/companies/%s/credentials', $this->companySlug), [], ['name' => $name, 'production' => $production]);
        if (! is_array($ret158541893753f0)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret158541893753f0) . ' given');
        }

        return $ret158541893753f0;
    }
}
