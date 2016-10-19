<?php

declare(strict_types = 1);

namespace idOS\Auth;

/**
 * Auth Interface implemmented by AbstractAuth.
 */
interface AuthInterface {
    public function getToken() : string;
}
