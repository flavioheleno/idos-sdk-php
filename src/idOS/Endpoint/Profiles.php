<?php

declare(strict_types = 1);

namespace idOS\Endpoint;

/**
 * Profiles Class Endpoint.
 */
class Profiles extends AbstractEndpoint {
    /**
     * Retrieves information about one user.
     *
     * @param string $userName the user userName
     * 
     * @return array Response
     */
    public function getOne(string $userName) : array {
        return $this->sendGet(
            sprintf('/profiles/%s', $userName)
        );
    }
}
