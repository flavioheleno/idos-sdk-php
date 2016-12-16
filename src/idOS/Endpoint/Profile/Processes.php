<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */
namespace idOS\Endpoint\Profile;

/**
 * Processes Class Endpoint.
 */
class Processes extends AbstractProfileEndpoint
{
    /**
     * Lists all processes.
     *
     * @param array $filters
     *
     * @return array Response
     */
    public function listAll(array $filters = [])
    {
        $ret15854189383658 = $this->sendGet(sprintf('/profiles/%s/processes', $this->userName), $filters);
        if (!is_array($ret15854189383658)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret15854189383658) . " given");
        }
        return $ret15854189383658;
    }
    /**
     * Retrieves a processe given its slug.
     *
     * @param int $processId
     *
     * @return array Response
     */
    public function getOne($processId)
    {
        if (!is_int($processId)) {
            throw new \InvalidArgumentException("Argument \$processId passed to getOne() must be of the type int, " . (gettype($processId) == "object" ? get_class($processId) : gettype($processId)) . " given");
        }
        $ret158541893838a2 = $this->sendGet(sprintf('/profiles/%s/processes/%s', $this->userName, $processId));
        if (!is_array($ret158541893838a2)) {
            throw new \InvalidArgumentException("Argument returned must be of the type array, " . gettype($ret158541893838a2) . " given");
        }
        return $ret158541893838a2;
    }
}