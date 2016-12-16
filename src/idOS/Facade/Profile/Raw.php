<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Facade\Profile;

use GuzzleHttp\Client;
use idOS\Auth;
use idOS\Endpoint\Raw as RawEndpoint;

class Raw
{
    /**
     * Returns the raw instance or, creates a new one if it doesn't exists yet and returns it.
     *
     * @param string $userName
     * @param Auth   $auth
     *
     * @return Raw instance
     */
    private static function getInstance($userName, Auth $auth)
    {
        if (! is_string($userName)) {
            throw new \InvalidArgumentException('Argument $userName passed to getInstance() must be of the type string, ' . (gettype($userName) == 'object' ? get_class($userName) : gettype($userName)) . ' given');
        }
        $ret158541893a3b36 = new RawEndpoint($userName, $auth, new Client());
        if (! $ret158541893a3b36 instanceof RawEndpoint) {
            throw new \InvalidArgumentException('Argument returned must be of the type RawEndpoint, ' . (gettype($ret158541893a3b36) == 'object' ? get_class($ret158541893a3b36) : gettype($ret158541893a3b36)) . ' given');
        }

        return $ret158541893a3b36;
    }
    /**
     * Creates a new instance of Raw.
     *
     * @param string $userName
     * @param int    $sourceId
     * @param string $collectionName
     * @param array  $data
     * @param Auth   $auth
     *
     * @return array response
     */
    public static function createNew($userName, $sourceId, $collectionName, array $data, Auth $auth)
    {
        if (! is_string($userName)) {
            throw new \InvalidArgumentException('Argument $userName passed to createNew() must be of the type string, ' . (gettype($userName) == 'object' ? get_class($userName) : gettype($userName)) . ' given');
        }
        if (! is_int($sourceId)) {
            throw new \InvalidArgumentException('Argument $sourceId passed to createNew() must be of the type int, ' . (gettype($sourceId) == 'object' ? get_class($sourceId) : gettype($sourceId)) . ' given');
        }
        if (! is_string($collectionName)) {
            throw new \InvalidArgumentException('Argument $collectionName passed to createNew() must be of the type string, ' . (gettype($collectionName) == 'object' ? get_class($collectionName) : gettype($collectionName)) . ' given');
        }

        return static::getInstance()->createNew($sourceId, $collectionName, $data);
    }
    /**
     * Lists all raws.
     *
     * @param string $userName [description]
     * @param Auth   $auth     [description]
     * @param array  $filters  [description]
     *
     * @return array response
     */
    public static function listAll($userName, Auth $auth, array $filters = [])
    {
        if (! is_string($userName)) {
            throw new \InvalidArgumentException('Argument $userName passed to listAll() must be of the type string, ' . (gettype($userName) == 'object' ? get_class($userName) : gettype($userName)) . ' given');
        }

        return static::getInstance()->listAll($filters);
    }
}
