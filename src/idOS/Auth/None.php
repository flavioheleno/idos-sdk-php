<?php

namespace idOS\Auth;

class None extends AbstractAuth {

    public function __construct() {
    }

    public function getToken() : string {
        return '';
    }
}
