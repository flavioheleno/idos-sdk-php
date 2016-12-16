<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace idOS\Endpoint\Profile;

/**
 * Features Class Endpoint.
 */
class Features extends AbstractProfileEndpoint
{
    private function typeInfer($value)
    {
        if (is_float($value)) {
            $ret15854189378545 = 'double';
            if (!is_string($ret15854189378545)) {
                throw new \InvalidArgumentException("Argument returned must be of the type string, " . gettype($ret15854189378545) . " given");
            }
            return $ret15854189378545;
        }
        if (is_integer($value)) {
            $ret15854189378752 = 'integer';
            if (!is_string($ret15854189378752)) {
                throw new \InvalidArgumentException("Argument returned must be of the type string, " . gettype($ret15854189378752) . " given");
            }
            return $ret15854189378752;
        }
        if (is_bool($value)) {
            $ret1585418937891f = 'boolean';
            if (!is_string($ret1585418937891f)) {
                throw new \InvalidArgumentException("Argument returned must be of the type string, " . gettype($ret1585418937891f) . " given");
            }
            return $ret1585418937891f;
        }
        if (is_array($value)) {
            $ret15854189378b22 = 'array';
            if (!is_string($ret15854189378b22)) {
                throw new \InvalidArgumentException("Argument returned must be of the type string, " . gettype($ret15854189378b22) . " given");
            }
            return $ret15854189378b22;
        }
        $ret15854189378cd9 = 'string';
        if (!is_string($ret15854189378cd9)) {
            throw new \InvalidArgumentException("Argument returned must be of the type string, " . gettype($ret15854189378cd9) . " given");
        }
        return $ret15854189378cd9;
    }
    /**
     * Creates a new feature for the given user.
     *
     * @param int        $sourceId
     * @param string     $name
     * @param mixed      $value
     * @param mixed|null $type
     *
     * @return array Response
     */
    public function createNew($sourceId, $name, $value, $type = null)
    {
        if (!is_int($sourceId)) {
            throw new \InvalidArgumentException("Argument \$sourceId passed to createNew() must be of the type int, " . (gettype($sourceId) == "object" ? get_class($sourceId) : gettype($sourceId)) . " given");
        }
        if (!is_string($name)) {
            throw new \InvalidArgumentException("Argument \$name passed to createNew() must be of the type string, " . (gettype($name) == "object" ? get_class($name) : gettype($name)) . " given");
        }
        if ($type === null) {
            $type = $this->typeInfer($value);
        }
        $ret15854189378f3a = $this->sendPost(sprintf('/profiles/%s/features', $this->userName), [], ['source_id' => $sourceId, 'name' => $name, 'value' => $value, 'type' => $type]);
        if (!is_array($ret15854189378f3a)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret15854189378f3a) . " given");
        }
        return $ret15854189378f3a;
    }
    /**
     * Tries to update a feature and if it doesnt exists, creates a new feature.
     *
     * @param int        $sourceId
     * @param string     $name
     * @param mixed      $value
     * @param mixed|null $type
     *
     * @return array Response
     */
    public function upsertOne($sourceId, $name, $value, $type = null)
    {
        if (!is_int($sourceId)) {
            throw new \InvalidArgumentException("Argument \$sourceId passed to upsertOne() must be of the type int, " . (gettype($sourceId) == "object" ? get_class($sourceId) : gettype($sourceId)) . " given");
        }
        if (!is_string($name)) {
            throw new \InvalidArgumentException("Argument \$name passed to upsertOne() must be of the type string, " . (gettype($name) == "object" ? get_class($name) : gettype($name)) . " given");
        }
        if ($type === null) {
            $type = $this->typeInfer($value);
        }
        $ret158541893794ac = $this->sendPut(sprintf('/profiles/%s/features', $this->userName), [], ['source_id' => $sourceId, 'name' => $name, 'value' => $value, 'type' => $type]);
        if (!is_array($ret158541893794ac)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret158541893794ac) . " given");
        }
        return $ret158541893794ac;
    }
    public function upsertBulk(array $features)
    {
        foreach ($features as &$feature) {
            if (empty($feature['type'])) {
                $feature['type'] = $this->typeInfer($feature['value']);
            }
        }
        return $this->sendPut(sprintf('/profiles/%s/features/bulk', $this->userName), [], $features);
    }
    /**
     * Lists all features.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret15854189379c77 = $this->sendGet(sprintf('/profiles/%s/features', $this->userName), $filters);
        if (!is_array($ret15854189379c77)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret15854189379c77) . " given");
        }
        return $ret15854189379c77;
    }
    /**
     * Retrieves a feature given its slug.
     *
     * @param int $featureId
     *
     * @return array Response
     */
    public function getOne($featureId)
    {
        if (!is_int($featureId)) {
            throw new \InvalidArgumentException("Argument \$featureId passed to getOne() must be of the type int, " . (gettype($featureId) == "object" ? get_class($featureId) : gettype($featureId)) . " given");
        }
        $ret15854189379e6a = $this->sendGet(sprintf('/profiles/%s/features/%s', $this->userName, $featureId));
        if (!is_array($ret15854189379e6a)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret15854189379e6a) . " given");
        }
        return $ret15854189379e6a;
    }
    /**
     * Updates a feature given its slug.
     *
     * @param string $featureId
     * @param mixed  $value
     * @param string $type
     *
     * @return array Response
     */
    public function updateOne($featureId, $value, $type)
    {
        if (!is_int($featureId)) {
            throw new \InvalidArgumentException("Argument \$featureId passed to updateOne() must be of the type int, " . (gettype($featureId) == "object" ? get_class($featureId) : gettype($featureId)) . " given");
        }
        if (!is_string($type)) {
            throw new \InvalidArgumentException("Argument \$type passed to updateOne() must be of the type string, " . (gettype($type) == "object" ? get_class($type) : gettype($type)) . " given");
        }
        $ret1585418937a1c7 = $this->sendPatch(sprintf('/profiles/%s/features/%s', $this->userName, $featureId), [], ['value' => $value, 'type' => $type]);
        if (!is_array($ret1585418937a1c7)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418937a1c7) . " given");
        }
        return $ret1585418937a1c7;
    }
    /**
     * Deletes a feature given its slug.
     *
     * @param int $featureId
     *
     * @return array Response
     */
    public function deleteOne($featureId)
    {
        if (!is_int($featureId)) {
            throw new \InvalidArgumentException("Argument \$featureId passed to deleteOne() must be of the type int, " . (gettype($featureId) == "object" ? get_class($featureId) : gettype($featureId)) . " given");
        }
        $ret1585418937a678 = $this->sendDelete(sprintf('/profiles/%s/features/%s', $this->userName, $featureId));
        if (!is_array($ret1585418937a678)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418937a678) . " given");
        }
        return $ret1585418937a678;
    }
    /**
     * Deletes all features.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = [])
    {
        $ret1585418937a9b8 = $this->sendDelete(sprintf('/profiles/%s/features', $this->userName), $filters);
        if (!is_array($ret1585418937a9b8)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret1585418937a9b8) . " given");
        }
        return $ret1585418937a9b8;
    }
}