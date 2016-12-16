<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Profile;

/**
 * Flags Class Endpoint.
 */
class Flags extends AbstractProfileEndpoint
{
    /**
     * Creates a new flag for the given user.
     *
     * @param string $slug
     * @param string $attribute
     *
     * @return array Response
     */
    public function createNew($slug, $attribute)
    {
        if (! is_string($slug)) {
            throw new \InvalidArgumentException('Argument $slug passed to createNew() must be of the type string, ' . (gettype($slug) == 'object' ? get_class($slug) : gettype($slug)) . ' given');
        }
        if (! is_string($attribute)) {
            throw new \InvalidArgumentException('Argument $attribute passed to createNew() must be of the type string, ' . (gettype($attribute) == 'object' ? get_class($attribute) : gettype($attribute)) . ' given');
        }
        $ret1585418937645e = $this->sendPost(sprintf('/profiles/%s/flags', $this->userName), [], ['slug' => $slug, 'attribute' => $attribute]);
        if (! is_array($ret1585418937645e)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418937645e) . ' given');
        }

        return $ret1585418937645e;
    }
    /**
     * Lists all flags.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret158541893769a1 = $this->sendGet(sprintf('/profiles/%s/flags', $this->userName), $filters);
        if (! is_array($ret158541893769a1)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret158541893769a1) . ' given');
        }

        return $ret158541893769a1;
    }
    /**
     * Retrieves a flag given its slug.
     *
     * @param string $slug
     *
     * @return array Response
     */
    public function getOne($slug)
    {
        if (! is_string($slug)) {
            throw new \InvalidArgumentException('Argument $slug passed to getOne() must be of the type string, ' . (gettype($slug) == 'object' ? get_class($slug) : gettype($slug)) . ' given');
        }
        $ret15854189376b79 = $this->sendGet(sprintf('/profiles/%s/flags/%s', $this->userName, $slug));
        if (! is_array($ret15854189376b79)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189376b79) . ' given');
        }

        return $ret15854189376b79;
    }
    /**
     * Deletes a flag given its slug.
     *
     * @param string $slug
     *
     * @return array Response
     */
    public function deleteOne($slug)
    {
        if (! is_string($slug)) {
            throw new \InvalidArgumentException('Argument $slug passed to deleteOne() must be of the type string, ' . (gettype($slug) == 'object' ? get_class($slug) : gettype($slug)) . ' given');
        }
        $ret15854189376ed9 = $this->sendDelete(sprintf('/profiles/%s/flags/%s', $this->userName, $slug));
        if (! is_array($ret15854189376ed9)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189376ed9) . ' given');
        }

        return $ret15854189376ed9;
    }
    /**
     * Deletes all flags.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = [])
    {
        $ret15854189377235 = $this->sendDelete(sprintf('/profiles/%s/flags', $this->userName), $filters);
        if (! is_array($ret15854189377235)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189377235) . ' given');
        }

        return $ret15854189377235;
    }
}
