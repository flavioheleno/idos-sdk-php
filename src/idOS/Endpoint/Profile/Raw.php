<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Profile;

/**
 * Raw Class Endpoint.
 */
class Raw extends AbstractProfileEndpoint
{
    /**
     * Creates a new raw data for the given source.
     *
     * @param int    $sourceId
     * @param string $collectionName
     * @param array  $data
     *
     * @return array Response
     */
    public function createNew($sourceId, $collectionName, array $data)
    {
        if (! is_int($sourceId)) {
            throw new \InvalidArgumentException('Argument $sourceId passed to createNew() must be of the type int, ' . (gettype($sourceId) == 'object' ? get_class($sourceId) : gettype($sourceId)) . ' given');
        }
        if (! is_string($collectionName)) {
            throw new \InvalidArgumentException('Argument $collectionName passed to createNew() must be of the type string, ' . (gettype($collectionName) == 'object' ? get_class($collectionName) : gettype($collectionName)) . ' given');
        }
        $ret1585418938213b = $this->sendPost(sprintf('/profiles/%s/raw', $this->userName), [], ['source_id' => $sourceId, 'collection' => $collectionName, 'data' => $data]);
        if (! is_array($ret1585418938213b)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418938213b) . ' given');
        }

        return $ret1585418938213b;
    }
    /**
     * Tries to update a raw data and if it doesnt exists, creates a new raw data.
     *
     * @param int    $sourceId
     * @param string $collectionName
     * @param array  $data
     *
     * @return array Response
     */
    public function upsertOne($sourceId, $collectionName, array $data)
    {
        if (! is_int($sourceId)) {
            throw new \InvalidArgumentException('Argument $sourceId passed to upsertOne() must be of the type int, ' . (gettype($sourceId) == 'object' ? get_class($sourceId) : gettype($sourceId)) . ' given');
        }
        if (! is_string($collectionName)) {
            throw new \InvalidArgumentException('Argument $collectionName passed to upsertOne() must be of the type string, ' . (gettype($collectionName) == 'object' ? get_class($collectionName) : gettype($collectionName)) . ' given');
        }
        $ret158541893826d0 = $this->sendPut(sprintf('/profiles/%s/raw', $this->userName), [], ['source_id' => $sourceId, 'collection' => $collectionName, 'data' => $data]);
        if (! is_array($ret158541893826d0)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret158541893826d0) . ' given');
        }

        return $ret158541893826d0;
    }
    /**
     * Lists all raw data.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret15854189382bb4 = $this->sendGet(sprintf('/profiles/%s/raw', $this->userName), $filters);
        if (! is_array($ret15854189382bb4)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189382bb4) . ' given');
        }

        return $ret15854189382bb4;
    }
    public function deleteAll(array $filters = [])
    {
        $ret15854189382da6 = $this->sendDelete(sprintf('/profiles/%s/raw', $this->userName), $filters);
        if (! is_array($ret15854189382da6)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189382da6) . ' given');
        }

        return $ret15854189382da6;
    }
}
