<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace idOS\Endpoint\Profile;

/**
 * References Class Endpoint.
 */
class References extends AbstractProfileEndpoint
{
    /**
     * Creates a new reference for the given user.
     *
     * @param string $name
     * @param string $value
     *
     * @return array Response
     */
    public function createNew($name, $value)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException("Argument \$name passed to createNew() must be of the type string, " . (gettype($name) == "object" ? get_class($name) : gettype($name)) . " given");
        }
        if (!is_string($value)) {
            throw new \InvalidArgumentException("Argument \$value passed to createNew() must be of the type string, " . (gettype($value) == "object" ? get_class($value) : gettype($value)) . " given");
        }
        $ret1585418938baaa = $this->sendPost(sprintf('/profiles/%s/references', $this->userName), [], ['name' => $name, 'value' => $value]);
        if (!is_array($ret1585418938baaa)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418938baaa) . " given");
        }
        return $ret1585418938baaa;
    }
    /**
     * Lists all references.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret1585418938c009 = $this->sendGet(sprintf('/profiles/%s/references', $this->userName), $filters);
        if (!is_array($ret1585418938c009)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418938c009) . " given");
        }
        return $ret1585418938c009;
    }
    /**
     * Retrieves a reference given its slug.
     *
     * @param string $referenceName
     *
     * @return array Response
     */
    public function getOne($referenceName)
    {
        if (!is_string($referenceName)) {
            throw new \InvalidArgumentException("Argument \$referenceName passed to getOne() must be of the type string, " . (gettype($referenceName) == "object" ? get_class($referenceName) : gettype($referenceName)) . " given");
        }
        $ret1585418938c1ed = $this->sendGet(sprintf('/profiles/%s/references/%s', $this->userName, $referenceName));
        if (!is_array($ret1585418938c1ed)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418938c1ed) . " given");
        }
        return $ret1585418938c1ed;
    }
    /**
     * Updates a reference given its slug.
     *
     * @param bool $value
     *
     * @return array Response
     */
    public function updateOne($referenceName, $value)
    {
        if (!is_string($referenceName)) {
            throw new \InvalidArgumentException("Argument \$referenceName passed to updateOne() must be of the type string, " . (gettype($referenceName) == "object" ? get_class($referenceName) : gettype($referenceName)) . " given");
        }
        if (!is_string($value)) {
            throw new \InvalidArgumentException("Argument \$value passed to updateOne() must be of the type string, " . (gettype($value) == "object" ? get_class($value) : gettype($value)) . " given");
        }
        $ret1585418938c559 = $this->sendPatch(sprintf('/profiles/%s/references/%s', $this->userName, $referenceName), [], ['value' => $value]);
        if (!is_array($ret1585418938c559)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418938c559) . " given");
        }
        return $ret1585418938c559;
    }
    /**
     * Deletes a reference given its slug.
     *
     * @param string $referenceName
     *
     * @return array Response
     */
    public function deleteOne($referenceName)
    {
        if (!is_string($referenceName)) {
            throw new \InvalidArgumentException("Argument \$referenceName passed to deleteOne() must be of the type string, " . (gettype($referenceName) == "object" ? get_class($referenceName) : gettype($referenceName)) . " given");
        }
        $ret1585418938ca37 = $this->sendDelete(sprintf('/profiles/%s/references/%s', $this->userName, $referenceName));
        if (!is_array($ret1585418938ca37)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418938ca37) . " given");
        }
        return $ret1585418938ca37;
    }
    /**
     * Deletes all references.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = [])
    {
        $ret1585418938cd93 = $this->sendDelete(sprintf('/profiles/%s/references', $this->userName), $filters);
        if (!is_array($ret1585418938cd93)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418938cd93) . " given");
        }
        return $ret1585418938cd93;
    }
}