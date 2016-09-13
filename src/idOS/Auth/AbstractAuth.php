<?php

namespace idOS\Auth;

abstract class AbstractAuth implements AuthInterface {

    public function __toString() : string {
        $name = get_class($this);
        $name = substr($name, (strrpos($name, '\\') + 1));

        return sprintf('%s %s', $name, $this->getToken());
    }
}
