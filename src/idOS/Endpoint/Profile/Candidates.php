<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Profile;

/**
 * Candidate Class Endpoint.
 */
class Candidates extends AbstractProfileEndpoint
{
    /**
     * Lists all attribute candidates.
     *
     * @param array $filter
     *
     * @return array Response
     */
    public function listAll(array $filter = [])
    {
        return $this->sendGet(sprintf('/profiles/%s/candidates', $this->userName), $filter);
    }
    /**
     * Creates a new attribute candidate for the given user.
     *
     * @param string $attribute
     * @param string $value
     * @param float  $support
     *
     * @return array Response
     */
    public function createNew($attribute, $value, $support)
    {
        if (! is_string($attribute)) {
            throw new \InvalidArgumentException('Argument $attribute passed to createNew() must be of the type string, ' . (gettype($attribute) == 'object' ? get_class($attribute) : gettype($attribute)) . ' given');
        }
        if (! is_string($value)) {
            throw new \InvalidArgumentException('Argument $value passed to createNew() must be of the type string, ' . (gettype($value) == 'object' ? get_class($value) : gettype($value)) . ' given');
        }
        if (! is_float($support)) {
            throw new \InvalidArgumentException('Argument $support passed to createNew() must be of the type float, ' . (gettype($support) == 'object' ? get_class($support) : gettype($support)) . ' given');
        }
        $ret1585418938445e = $this->sendPost(sprintf('/profiles/%s/candidates', $this->userName), [], ['attribute' => $attribute, 'value' => $value, 'support' => $support]);
        if (! is_array($ret1585418938445e)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938445e) . ' given');
        }

        return $ret1585418938445e;
    }
    /**
     * Deletes all attribute candidates.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = [])
    {
        $ret15854189384dc0 = $this->sendDelete(sprintf('/profiles/%s/candidates', $this->userName), $filters);
        if (! is_array($ret15854189384dc0)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189384dc0) . ' given');
        }

        return $ret15854189384dc0;
    }
}
