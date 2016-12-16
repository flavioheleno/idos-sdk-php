<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Endpoint\Profile;

/**
 * Scores Class Endpoint.
 */
class Scores extends AbstractProfileEndpoint
{
    /**
     * Creates a new score for the given source.
     *
     * @param string $attribute
     * @param string $name
     * @param float  $value
     *
     * @return array Response
     */
    public function createNew($attribute, $name, $value)
    {
        if (! is_string($attribute)) {
            throw new \InvalidArgumentException('Argument $attribute passed to createNew() must be of the type string, ' . (gettype($attribute) == 'object' ? get_class($attribute) : gettype($attribute)) . ' given');
        }
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to createNew() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        if (! is_float($value)) {
            throw new \InvalidArgumentException('Argument $value passed to createNew() must be of the type float, ' . (gettype($value) == 'object' ? get_class($value) : gettype($value)) . ' given');
        }
        $ret1585418937f688 = $this->sendPost(sprintf('/profiles/%s/scores', $this->userName), [], ['attribute' => $attribute, 'name' => $name, 'value' => $value]);
        if (! is_array($ret1585418937f688)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418937f688) . ' given');
        }

        return $ret1585418937f688;
    }
    /**
     * Tries to update a score and if it doesnt exists, creates a new score.
     *
     * @param string $attribute
     * @param string $name
     * @param float  $value
     *
     * @return array Response
     */
    public function upsertOne($attribute, $name, $value)
    {
        if (! is_string($attribute)) {
            throw new \InvalidArgumentException('Argument $attribute passed to upsertOne() must be of the type string, ' . (gettype($attribute) == 'object' ? get_class($attribute) : gettype($attribute)) . ' given');
        }
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to upsertOne() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        if (! is_float($value)) {
            throw new \InvalidArgumentException('Argument $value passed to upsertOne() must be of the type float, ' . (gettype($value) == 'object' ? get_class($value) : gettype($value)) . ' given');
        }
        $ret1585418937fd7b = $this->sendPut(sprintf('/profiles/%s/scores', $this->userName), [], ['attribute' => $attribute, 'name' => $name, 'value' => $value]);
        if (! is_array($ret1585418937fd7b)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret1585418937fd7b) . ' given');
        }

        return $ret1585418937fd7b;
    }
    /**
     * Lists all scores.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret158541893803c0 = $this->sendGet(sprintf('/profiles/%s/scores', $this->userName), $filters);
        if (! is_array($ret158541893803c0)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret158541893803c0) . ' given');
        }

        return $ret158541893803c0;
    }
    /**
     * Retrieves the score given its name.
     *
     * @param string $name
     *
     * @return
     */
    public function getOne($name)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to getOne() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $ret15854189380591 = $this->sendGet(sprintf('/profiles/%s/scores/%s', $this->userName, $name));
        if (! is_array($ret15854189380591)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189380591) . ' given');
        }

        return $ret15854189380591;
    }
    /**
     * Updates a score in the given profile.
     *
     * @param string $attribute
     * @param string $name
     * @param float  $value
     *
     * @return array Response
     */
    public function updateOne($attribute, $name, $value)
    {
        if (! is_string($attribute)) {
            throw new \InvalidArgumentException('Argument $attribute passed to updateOne() must be of the type string, ' . (gettype($attribute) == 'object' ? get_class($attribute) : gettype($attribute)) . ' given');
        }
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to updateOne() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        if (! is_float($value)) {
            throw new \InvalidArgumentException('Argument $value passed to updateOne() must be of the type float, ' . (gettype($value) == 'object' ? get_class($value) : gettype($value)) . ' given');
        }
        $ret15854189380924 = $this->sendPatch(sprintf('/profiles/%s/scores/%s', $this->userName, $name), [], ['attribute' => $attribute, 'value' => $value]);
        if (! is_array($ret15854189380924)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189380924) . ' given');
        }

        return $ret15854189380924;
    }
    /**
     * Deletes a score given its name.
     *
     * @param string $name
     *
     * @return array Response
     */
    public function deleteOne($name)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to deleteOne() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        $ret15854189380fc8 = $this->sendDelete(sprintf('/profiles/%s/scores/%s', $this->userName, $name));
        if (! is_array($ret15854189380fc8)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189380fc8) . ' given');
        }

        return $ret15854189380fc8;
    }
    /**
     * Deletes all scores for the given username.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function deleteAll(array $filters = [])
    {
        $ret15854189381388 = $this->sendDelete(sprintf('/profiles/%s/scores', $this->userName), $filters);
        if (! is_array($ret15854189381388)) {
            throw new \InvalidArgumentException('Argument returned must be of the type array, ' . gettype($ret15854189381388) . ' given');
        }

        return $ret15854189381388;
    }
}
