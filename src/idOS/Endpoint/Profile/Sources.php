<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Profile;

/**
 * Sources Class Endpoint.
 */
class Sources extends AbstractProfileEndpoint
{
    /**
     * Creates a new source for the given username.
     *
     * @param string $name
     * @param string $ipaddr
     * @param array  $tags
     *
     * @return array Response
     */
    public function createNew($name, array $tags)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to createNew() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $array             = ['name' => $name, 'tags' => $tags];
        $ret1585418937c479 = $this->sendPost(sprintf('/profiles/%s/sources', $this->userName), [], $array);
        if (! is_array($ret1585418937c479)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418937c479) . ' given');
        }

        return $ret1585418937c479;
    }
    /**
     * Lists all sources.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret1585418937c854 = $this->sendGet(sprintf('/profiles/%s/sources', $this->userName), $filters);
        if (! is_array($ret1585418937c854)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418937c854) . ' given');
        }

        return $ret1585418937c854;
    }
    /**
     * Retrieves the source given its sourceId.
     *
     * @param int $sourceId
     *
     * @return array Response
     */
    public function getOne($sourceId)
    {
        if (! is_int($sourceId)) {
            throw new \InvalidArgumentException('Argument $sourceId passed to getOne() must be of the type int, ' . (gettype($sourceId) == 'object' ? get_class($sourceId) : gettype($sourceId)) . ' given');
        }
        $ret1585418937ca90 = $this->sendGet(sprintf('/profiles/%s/sources/%s', $this->userName, $sourceId));
        if (! is_array($ret1585418937ca90)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418937ca90) . ' given');
        }

        return $ret1585418937ca90;
    }
    /**
     * Updates a source in the given profile.
     *
     * @param int    $sourceId
     * @param string $ipaddr
     * @param string $tags
     *
     * @return array Response
     */
    public function updateOne($sourceId, array $tags, $otpCode = null, $ipaddr = '')
    {
        if (! is_int($sourceId)) {
            throw new \InvalidArgumentException('Argument $sourceId passed to updateOne() must be of the type int, ' . (gettype($sourceId) == 'object' ? get_class($sourceId) : gettype($sourceId)) . ' given');
        }
        if (! is_int($otpCode) and ! is_null($otpCode)) {
            throw new \InvalidArgumentException('Argument $otpCode passed to updateOne() must be of the type int, ' . (gettype($otpCode) == 'object' ? get_class($otpCode) : gettype($otpCode)) . ' given');
        }
        if (! is_string($ipaddr)) {
            throw new \InvalidArgumentException('Argument $ipaddr passed to updateOne() must be of the type string, ' . (gettype($ipaddr) == 'object' ? get_class($ipaddr) : gettype($ipaddr)) . ' given');
        }
        $array = ['tags' => $tags];
        if ($otpCode !== null) {
            $array['otpCode'] = $otpCode;
        }
        $ret1585418937cec5 = $this->sendPatch(sprintf('/profiles/%s/sources/%s', $this->userName, $sourceId), [], $array);
        if (! is_array($ret1585418937cec5)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418937cec5) . ' given');
        }

        return $ret1585418937cec5;
    }
    /**
     * Deletes a source given its sourceId.
     *
     * @param string $sourceId
     *
     * @return array Response
     */
    public function deleteOne($sourceId)
    {
        if (! is_string($sourceId)) {
            throw new \InvalidArgumentException('Argument $sourceId passed to deleteOne() must be of the type string, ' . (gettype($sourceId) == 'object' ? get_class($sourceId) : gettype($sourceId)) . ' given');
        }
        $ret1585418937d72b = $this->sendDelete(sprintf('/profiles/%s/sources/%s', $this->userName, $sourceId));
        if (! is_array($ret1585418937d72b)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418937d72b) . ' given');
        }

        return $ret1585418937d72b;
    }
    /**
     * Deletes all sources for the given username.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = [])
    {
        $ret1585418937daf2 = $this->sendDelete(sprintf('/profiles/%s/sources', $this->userName), $filters);
        if (! is_array($ret1585418937daf2)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418937daf2) . ' given');
        }

        return $ret1585418937daf2;
    }
}
