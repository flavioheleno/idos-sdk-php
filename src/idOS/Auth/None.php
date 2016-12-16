<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Auth;

/**
 * None Authorization Class.
 */
class None extends AbstractAuth
{
    /**
     *  Constructor Class.
     */
    public function __construct()
    {
    }
    /**
     * Returns an empty string.
     */
    public function getToken()
    {
        $ret15854189393a81 = '';
        if (! is_string($ret15854189393a81)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret15854189393a81) . ' given');
        }

        return $ret15854189393a81;
    }
}
