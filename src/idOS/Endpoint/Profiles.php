<?php

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
    public function getOne($userName)  {
        return $this->sendGet(
            sprintf('/profiles/%s', $userName)
        );
    }
}
