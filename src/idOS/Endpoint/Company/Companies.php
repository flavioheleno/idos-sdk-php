<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Company;

/**
 * Companies Class Endpoint.
 */
class Companies extends AbstractCompanyEndpoint
{
    /**
     * Creates a new company for the given parent company.
     *
     * @param string $name
     *
     * @return array Response
     */
    public function createNew($name)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to createNew() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $ret15854189373138 = $this->sendPost(sprintf('/companies/%s', $this->companySlug), [], ['name' => $name]);
        if (! is_array($ret15854189373138)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189373138) . ' given');
        }

        return $ret15854189373138;
    }
}
