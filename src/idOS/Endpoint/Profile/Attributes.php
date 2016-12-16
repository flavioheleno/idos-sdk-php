<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace idOS\Endpoint\Profile;

/**
 * Attribute Class Endpoint.
 */
class Attributes extends AbstractProfileEndpoint
{
    /**
     * Lists all attributes.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = [])
    {
        $ret1585418937e597 = $this->sendGet(sprintf('/profiles/%s/attributes', $this->userName), $filter);
        if (!is_array($ret1585418937e597)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418937e597) . " given");
        }
        return $ret1585418937e597;
    }
    /**
     * Retrieves an attribute given its slug.
     *
     * @param string $attributeName
     *
     * @return array Response
     */
    public function getOne($attributeName)
    {
        if (!is_string($attributeName)) {
            throw new \InvalidArgumentException("Argument \$attributeName passed to getOne() must be of the type string, " . (gettype($attributeName) == "object" ? get_class($attributeName) : gettype($attributeName)) . " given");
        }
        $ret1585418937e816 = $this->sendGet(sprintf('/profiles/%s/attributes/%s', $this->userName, $attributeName));
        if (!is_array($ret1585418937e816)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418937e816) . " given");
        }
        return $ret1585418937e816;
    }
}