<?php

declare(strict_types = 1);

namespace idOS\Exception;

class SDKException extends \Exception {
    protected $type;

    protected $link;

    protected $message;

    public function __construct(
        String $message,
        String $type,
        String $link
    ) {
        $this->message = $message;
        $this->type    = $type;
        $this->link    = $link;
    }
}
