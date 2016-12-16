<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Profile;

/**
 * Gates Class Endpoint.
 */
class Gates extends AbstractProfileEndpoint
{
    /**
     * Creates a new gate for the given user.
     *
     * @param string $name
     * @param bool   $pass
     * @param string $confidenceLevel
     *
     * @return array Response
     */
    public function createNew($name, $pass, $confidenceLevel = '')
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to createNew() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        if (! is_bool($pass)) {
            throw new \InvalidArgumentException('Argument $pass passed to createNew() must be of the type bool, ' . (gettype($pass) == 'object' ? get_class($pass) : gettype($pass)) . ' given');
        }
        if (! is_string($confidenceLevel)) {
            throw new \InvalidArgumentException('Argument $confidenceLevel passed to createNew() must be of the type string, ' . (gettype($confidenceLevel) == 'object' ? get_class($confidenceLevel) : gettype($confidenceLevel)) . ' given');
        }
        $array = ['name' => $name, 'pass' => $pass];
        if (! empty($confidenceLevel)) {
            $array['confidence_level'] = $confidenceLevel;
        }
        $ret15854189389307 = $this->sendPost(sprintf('/profiles/%s/gates', $this->userName), [], $array);
        if (! is_array($ret15854189389307)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189389307) . ' given');
        }

        return $ret15854189389307;
    }
    /**
     * Tries to update a gate and if it doesnt exists, creates a new gate.
     *
     * @param string $name
     * @param bool   $pass
     *
     * @return array Response
     */
    public function upsertOne($name, $pass)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to upsertOne() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        if (! is_bool($pass)) {
            throw new \InvalidArgumentException('Argument $pass passed to upsertOne() must be of the type bool, ' . (gettype($pass) == 'object' ? get_class($pass) : gettype($pass)) . ' given');
        }
        $array = ['name' => $name, 'pass' => $pass];
        if (! empty($confidenceLevel)) {
            $array['confidence_level'] = $confidenceLevel;
        }
        $ret15854189389aa8 = $this->sendPut(sprintf('/profiles/%s/gates', $this->userName), [], $array);
        if (! is_array($ret15854189389aa8)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189389aa8) . ' given');
        }

        return $ret15854189389aa8;
    }
    /**
     * Lists all gates.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret15854189389fcc = $this->sendGet(sprintf('/profiles/%s/gates', $this->userName), $filters);
        if (! is_array($ret15854189389fcc)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189389fcc) . ' given');
        }

        return $ret15854189389fcc;
    }
    /**
     * Retrieves a gate given its slug.
     *
     * @param string $gateSlug
     *
     * @return array Response
     */
    public function getOne($gateSlug)
    {
        if (! is_string($gateSlug)) {
            throw new \InvalidArgumentException('Argument $gateSlug passed to getOne() must be of the type string, ' . (gettype($gateSlug) == 'object' ? get_class($gateSlug) : gettype($gateSlug)) . ' given');
        }
        $ret1585418938a186 = $this->sendGet(sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug));
        if (! is_array($ret1585418938a186)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938a186) . ' given');
        }

        return $ret1585418938a186;
    }
    /**
     * Updates a gate given its slug.
     *
     * @param bool $pass
     *
     * @return array Response
     */
    public function updateOne($gateSlug, $pass)
    {
        if (! is_string($gateSlug)) {
            throw new \InvalidArgumentException('Argument $gateSlug passed to updateOne() must be of the type string, ' . (gettype($gateSlug) == 'object' ? get_class($gateSlug) : gettype($gateSlug)) . ' given');
        }
        if (! is_bool($pass)) {
            throw new \InvalidArgumentException('Argument $pass passed to updateOne() must be of the type bool, ' . (gettype($pass) == 'object' ? get_class($pass) : gettype($pass)) . ' given');
        }
        $ret1585418938a502 = $this->sendPatch(sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug), [], ['pass' => $pass]);
        if (! is_array($ret1585418938a502)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938a502) . ' given');
        }

        return $ret1585418938a502;
    }
    /**
     * Deletes a gate given its slug.
     *
     * @param string $gateSlug
     *
     * @return array Response
     */
    public function deleteOne($gateSlug)
    {
        if (! is_string($gateSlug)) {
            throw new \InvalidArgumentException('Argument $gateSlug passed to deleteOne() must be of the type string, ' . (gettype($gateSlug) == 'object' ? get_class($gateSlug) : gettype($gateSlug)) . ' given');
        }
        $ret1585418938a9a9 = $this->sendDelete(sprintf('/profiles/%s/gates/%s', $this->userName, $gateSlug));
        if (! is_array($ret1585418938a9a9)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938a9a9) . ' given');
        }

        return $ret1585418938a9a9;
    }
    /**
     * Deletes all gates.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = [])
    {
        $ret1585418938accb = $this->sendDelete(sprintf('/profiles/%s/gates', $this->userName), $filters);
        if (! is_array($ret1585418938accb)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938accb) . ' given');
        }

        return $ret1585418938accb;
    }
}
