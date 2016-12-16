<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Auth;

/**
 * Abstract Auth extensible for all Auth Classes.
 */
abstract class AbstractAuth implements AuthInterface
{
    public function __toString()
    {
        $name              = get_class($this);
        $name              = substr($name, strrpos($name, '\\') + 1);
        $ret1585418939430d = sprintf('%s %s', $name, $this->getToken());
        if (! is_string($ret1585418939430d)) {
            throw new \InvalidArgumentException('Argument returned must be of the type string, ' . gettype($ret1585418939430d) . ' given');
        }

        return $ret1585418939430d;
    }
}
