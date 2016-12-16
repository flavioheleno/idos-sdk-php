<?php

/*
 * This code has been transpiled via TransPHPile. For more information, visit https://github.com/jaytaph/transphpile
 */

namespace idOS\Exception;

class SDKException extends \Exception
{
    protected $type;
    protected $link;
    protected $message;
    public function __construct($message, $type, $link)
    {
        if (! is_string($message)) {
            throw new \InvalidArgumentException('Argument $message passed to __construct() must be of the type string, ' . (gettype($message) == 'object' ? get_class($message) : gettype($message)) . ' given');
        }
        if (! is_string($type)) {
            throw new \InvalidArgumentException('Argument $type passed to __construct() must be of the type string, ' . (gettype($type) == 'object' ? get_class($type) : gettype($type)) . ' given');
        }
        if (! is_string($link)) {
            throw new \InvalidArgumentException('Argument $link passed to __construct() must be of the type string, ' . (gettype($link) == 'object' ? get_class($link) : gettype($link)) . ' given');
        }
        $this->message = $message;
        $this->type    = $type;
        $this->link    = $link;
    }
}
