<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Auth;

class StringToken extends AbstractAuth
{
    /**
     * The token name.
     *
     * @var string
     */
    private $name;
    /**
     * The token.
     *
     * @var string
     */
    private $token;
    /**
     * Class constructor.
     *
     * @param string $name
     * @param string $token
     *
     * @return void
     */
    public function __construct($name, $token)
    {
        if (! is_string($name)) {
            throw new \InvalidArgumentException('Argument $name passed to __construct() must be of the type string, ' . (gettype($name) == 'object' ? get_class($name) : gettype($name)) . ' given');
        }
        if (! is_string($token)) {
            throw new \InvalidArgumentException('Argument $token passed to __construct() must be of the type string, ' . (gettype($token) == 'object' ? get_class($token) : gettype($token)) . ' given');
        }
        $this->name  = $name;
        $this->token = $token;
    }
    /**
     * Returns the token.
     *
     * @return string
     */
    public function getToken()
    {
        $ret15854189395c4f = $this->token;
        if (! is_string($ret15854189395c4f)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret15854189395c4f) . ' given');
        }

        return $ret15854189395c4f;
    }
    /**
     * Returns the token string representation.
     *
     * @return string
     */
    public function __toString()
    {
        $ret15854189395f0f = sprintf('%s %s', ucfirst($this->name), $this->getToken());
        if (! is_string($ret15854189395f0f)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret15854189395f0f) . ' given');
        }

        return $ret15854189395f0f;
    }
}
