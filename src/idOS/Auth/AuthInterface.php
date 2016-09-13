<?php

namespace idOS\Auth;

interface AuthInterface {
    public function getToken() : string;
}
